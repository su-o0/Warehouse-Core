<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Entity\UserEntity;
use WarehouseCore\Payload\Enum\ProviderNameEnum;
use WarehouseCore\Payload\Enum\RoleNameEnum;
use WarehouseCore\Payload\Enum\UserProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\UserStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\VO\UserNameVO;
use WarehouseCore\Repository\Catalog\UserNameRepository;
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Processing\UserProcessingStepRepository;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Security\Lifecycle;
use WarehouseCore\Transaction\User\AddUserIdentityTransaction;
use WarehouseCore\Transaction\User\AddUserNameTransaction;
use WarehouseCore\Transaction\User\AssignUserRoleTransaction;
use WarehouseCore\Transaction\User\DismissUserRoleTransaction;
use WarehouseCore\Transaction\User\RemoveUserIdentityTransaction;
use WarehouseCore\Transaction\User\RemoveUserNameTransaction;
use WarehouseCore\Transaction\User\SetPrimaryUserNameTransaction;

final class UserService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private RoleRepository $role_repository,
        private UserRepository $user_repository,
        private UserNameRepository $user_name_repository,
        private UserProcessingStepRepository $user_processing_step_repository,
        private UserIdentityRepository $user_identity_repository,
        private AssignUserRoleTransaction $assign_user_role_transaction,
        private DismissUserRoleTransaction $dismiss_user_role_transaction,
        private AddUserNameTransaction $add_user_name_transaction,
        private SetPrimaryUserNameTransaction $set_primary_user_name_transaction,
        private RemoveUserNameTransaction $remove_user_name_transaction,
        private AddUserIdentityTransaction $add_user_identity_transaction,
        private RemoveUserIdentityTransaction $remove_user_identity_transaction
    ) { }

    public function activateUser(
        UserEntity $user
    ) {
        if (!$this->authorization->canActivateUser()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canActivateUser($user)) {
            return ServiceResult::failure(
                ErrorMessage::USER_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        $result = $this->user_processing_step_repository->findByUserId(
            $user->id
        );

        $user_processing_steps = $result;
        $user_processing_steps_count = count($user_processing_steps);

        if($user_processing_steps_count === 0) {
            return ServiceResult::failure(
                ErrorMessage::USER_PROCESSING_STEP_NOT_FOUND
            );
        }

        $has_named = false;
        $has_assign_role = false;
        $has_identified = false;

        foreach ($user_processing_steps as $step) {
            match ($step->stage) {
                UserProcessingStepStageEnum::Named =>
                    $has_named = true,

                UserProcessingStepStageEnum::AssignRole =>
                    $has_assign_role = true,

                UserProcessingStepStageEnum::Identified =>
                    $has_identified = true,
            };
        }

        if (!$has_named || !$has_assign_role || !$has_identified) {
            return ServiceResult::failure(
                ErrorMessage::USER_PROCESSING_NOT_COMPLETED
            );
        }

        $this->user_repository->updateStatus(
            id: $user->id,
            status: UserStatusEnum::Active->value
        );

        return ServiceResult::success();
    }

    public function archiveUser(
        UserEntity $user
    ) {
        if (!$this->authorization->canArchiveUser()) {
            throw ServiceException::FORBIDDEN();
        }
        
        if (!Lifecycle::canArchiveUser($user)) {
            return ServiceResult::failure(
                ErrorMessage::USER_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        if ($user->role === RoleNameEnum::Root) {
            return ServiceResult::failure(
                ErrorMessage::FORBIDDEN
            );
        }
       
        $this->user_repository->updateStatus(
            id: $user->id,
            status: UserStatusEnum::Archived->value
        );

        return ServiceResult::success();
    }

    public function createUser( 
    ): ServiceResult {
        if (!$this->authorization->canCreateUser()){
            throw ServiceException::FORBIDDEN();
        }

        try { 
            $this->user_repository->add();
        } catch(RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        return ServiceResult::success();
    }

    public function assignUserRole(
        UserEntity $user,
        RoleNameEnum $role
    ) {
        if (!$this->authorization->canAssignUserRole()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canAssignUserRole($user)) {
            return ServiceResult::failure(
                ErrorMessage::USER_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }
        if ($role === RoleNameEnum::Root) {
            return ServiceResult::failure(
                ErrorMessage::FORBIDDEN
            );
        }        

        if ($user->role !== null) {
            return ServiceResult::failure(
                ErrorMessage::USER_ROLE_ALREADY_SET
            );
        }

        try { 
            $result = $this->role_repository->getByName($role->value);
        } catch(RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        if ($result === null) {
            return ServiceResult::failure(
                ErrorMessage::ROLE_NOT_FOUND
            );
        }

        $role = $result->name;

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            $user->id,
            UserProcessingStepStageEnum::AssignRole->value
        );

        if($result !== null) {
            return ServiceResult::failure(
                ErrorMessage::USER_PROCESSING_STEP_ALREADY_EXISTS
            );
        }

        return $this->assign_user_role_transaction->handle(
            $user->id,
            $role,
            $user->status
        );
    }

    public function dismissUserRole(
        UserEntity $user
    ) {
        if (!$this->authorization->canDismissUserRole()) {
            throw ServiceException::FORBIDDEN();
        }
        
        if (!Lifecycle::canDismissUserRole($user)) {
            return ServiceResult::failure(
                ErrorMessage::USER_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        if ($user->role === RoleNameEnum::Root) {
            return ServiceResult::failure(
                ErrorMessage::FORBIDDEN
            );
        }

      
        if ($user->role === null) {
            return ServiceResult::failure(
                ErrorMessage::USER_ROLE_NOT_FOUND
            );
        }

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            $user->id,
            UserProcessingStepStageEnum::AssignRole->value
        );

        if($result === null) {
            return ServiceResult::failure(
                ErrorMessage::USER_PROCESSING_STEP_NOT_FOUND
            );
        }

        $record_id = $result->record_id;

        return $this->dismiss_user_role_transaction->handle(
            $user->id,
            $record_id,
            $user->status
        );
    }

    public function addUserName(
        UserEntity $user,
        string $name
    ) {
        if(!$this->authorization->canAddUserName()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canAddUserName($user)) {
            return ServiceResult::failure(
                ErrorMessage::USER_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        $result = $this->user_name_repository->findByUserIdAndValue(
            user_id: $user->id,
            value: $name
        );

        if($result !== null) {
            return ServiceResult::failure(
                ErrorMessage::USER_NAME_ALREADY_EXISTS
            );
        }

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            user_id: $user->id,
            stage: UserProcessingStepStageEnum::Named->value
        );

        $record_id = ($result === null)? null: $result->record_id;

        return $this->add_user_name_transaction->handle(
            $user->id,
            $record_id,
            $name,
            $user->status,
            $this->authorization->getUserId()
        );
    }   

    public function setPrimaryUserName(
        UserEntity $user,
        UserNameVO $user_name
    ) {
        if(!$this->authorization->canSetPrimaryUserName()) {
            throw ServiceException::FORBIDDEN();
        }
        
        if (!Lifecycle::canSetPrimaryUserName($user)) {
            return ServiceResult::failure(
                ErrorMessage::USER_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        if ($user->id != $user_name->user_id) {
            return ServiceResult::failure(
                ErrorMessage::USER_NAME_NOT_FOUND
            );
        }

        if ($user_name->is_primary){
            return ServiceResult::failure(
                ErrorMessage::USER_NAME_ALREADY_PRIMARY
            );
        }

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            user_id: $user->id,
            stage: UserProcessingStepStageEnum::Named->value
        );

        $create_processing_step = ($result === null)? true: false;

        return $this->set_primary_user_name_transaction->handle(
            $user_name->record_id,
            $user_name->user_id,
            $create_processing_step
        );
    }

    public function removeUserName(
        UserEntity $user
    ) {
        if(!$this->authorization->canRemoveUserName()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canRemoveUserName($user)) {
            return ServiceResult::failure(
                ErrorMessage::USER_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        if ($user->role === RoleNameEnum::Root) {
            return ServiceResult::failure(
                ErrorMessage::FORBIDDEN
            );
        }

        $user_name = $this->user_name_repository->findPrimaryByUserId(
            $user->id
        );

        if ($user_name === null) {
            return ServiceResult::failure(
                ErrorMessage::USER_NAME_NOT_FOUND
            );
        }

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            user_id: $user->id,
            stage: UserProcessingStepStageEnum::Named->value
        );

        if($result === null) {
            return ServiceResult::failure(
                ErrorMessage::USER_PROCESSING_STEP_NOT_FOUND
            );
        }

        $record_id = $result->record_id;

        return $this->remove_user_name_transaction->handle(
            user_id: $user->id,
            record_id: $record_id,
            user_status: $user->status
        );
    }

    public function addUserIdentity(
        UserEntity $user,
        ProviderNameEnum $provider,
        string $external_id
    ) {
        if(!$this->authorization->canAddUserIdentity()) {
            throw ServiceException::FORBIDDEN();
        }

        if(!Lifecycle::canAddUserIdentity($user)) {
            return ServiceResult::failure(
                ErrorMessage::USER_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        $result = $this->user_identity_repository->findByUserIdAndProvider(
            user_id: $user->id,
            provider: $provider->value
        );

        if($result !== null) {
            return ServiceResult::failure(
                ErrorMessage::USER_IDENTITY_ALREADY_EXISTS
            );
        }

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            user_id: $user->id,
            stage: UserProcessingStepStageEnum::Identified->value
        );

        $identified = ($result !== null) ? true : false;

        return $this->add_user_identity_transaction->handle(
            user_id: $user->id,
            provider: $provider,
            external_id: $external_id,
            identified: $identified,
            user_status: $user->status
        );
    }

    public function removeUserIdentity(
        UserEntity $user,
        ProviderNameEnum $provider
    ): ServiceResult {
        if(!$this->authorization->canRemoveUserIdentity()) {
            throw ServiceException::FORBIDDEN();
        }

        if(!Lifecycle::canRemoveUserIdentity($user)) {
            return ServiceResult::failure(
                ErrorMessage::USER_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        $result = $this->user_identity_repository->findByUserIdAndProvider(
            user_id: $user->id,
            provider: $provider->value
        );

        if($result === null) {
            return ServiceResult::failure(
                ErrorMessage::USER_IDENTITY_NOT_FOUND
            );
        }

        $user_identity = $result;

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            user_id: $user->id,
            stage: UserProcessingStepStageEnum::Identified->value
        );

        if($result === null) {
            return ServiceResult::failure(
                ErrorMessage::USER_PROCESSING_STEP_NOT_FOUND
            );
        }

        $identified_record_id = ($result !== null) ? $result->record_id : null;

        $result = $this->user_identity_repository->findByUserId(
            user_id: $user->id
        );
        
        $change_status = (count($result) === 1) ? true : false;
        
        return $this->remove_user_identity_transaction->handle(
            user_id: $user->id,
            identity_record_id: $user_identity->record_id,
            identified_record_id: $identified_record_id,
            change_status: $change_status
        );
    }
}