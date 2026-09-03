<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Enum\ProviderNameEnum;
use WarehouseCore\Payload\Enum\RoleNameEnum;
use WarehouseCore\Payload\Enum\UserProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\UserStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\UserNameRepository;
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Processing\UserProcessingStepRepository;
use WarehouseCore\Security\Authorization;
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
    
    private function existsUser(
        int $id
    ): ServiceResult {
        try { 
            $result = $this->user_repository->getById($id);
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if ($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

    private function existsUserName(
        int $record_id
    ): ServiceResult {
        try { 
            $result = $this->user_name_repository->findByRecordId($record_id);
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if ($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_NAME_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

    public function activateUser(
        int $user_id
    ) {
        if (!$this->authorization->canActivateUser()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsUser($user_id);

        if (!$result->success) {
            return $result;
        }

        $user = $result->entity;

        if (!in_array(
            $user->status,
            [
                UserStatusEnum::Processing,
                UserStatusEnum::Archived
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_INVALID_STATUS_TRANSITION
            );
        }

        $result = $this->user_processing_step_repository->findByUserId(
            $user_id
        );

        $user_processing_steps = $result;
        $user_processing_steps_count = count($user_processing_steps);

        if($user_processing_steps_count === 0) {
                return new ServiceResult(
                    success: false,
                    message: ErrorMessage::USER_PROCESSING_STEP_NOT_FOUND
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
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_PROCESSING_NOT_COMPLETED
            );
        }

        $this->user_repository->updateStatus(
            id: $user->id,
            status: UserStatusEnum::Active->value
        );

        return new ServiceResult(
            success: true
        );
    }

    public function archiveUser(
        int $user_id
    ) {
        if (!$this->authorization->canArchiveUser()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsUser($user_id);

        if (!$result->success) {
            return $result;
        }

        $user = $result->entity;

        if ($user->role === RoleNameEnum::Root) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::FORBIDDEN
            );
        }


        if (!in_array(
            $user->status,
            [
                UserStatusEnum::Active
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_INVALID_STATUS_TRANSITION
            );
        }

        $this->user_repository->updateStatus(
            id: $user->id,
            status: UserStatusEnum::Archived->value
        );

        return new ServiceResult(
            success: true
        );
    }

    public function createUser( 
    ): ServiceResult {
        if (!$this->authorization->canCreateUser()){
            return new ServiceResult(
                success: false,
                message: ServiceException::Forbidden()->getMessage()
            );
        }

        try { 
            $this->user_repository->add();
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: true
        );
    }

    public function assignUserRole(
        int $user_id,
        RoleNameEnum $role
    ) {
        if (!$this->authorization->canAssignUserRole()) {
            throw ServiceException::FORBIDDEN();
        }

        if ($role === RoleNameEnum::Root) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::FORBIDDEN
            );
        }

        $result = $this->existsUser($user_id);

        if (!$result->success) {
            return $result;
        }

        $user = $result->entity;

        if (!in_array(
            $user->status,
            [
                UserStatusEnum::Created,
                UserStatusEnum::Processing,
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_INVALID_STATUS_TRANSITION
            );
        }

        if ($user->role !== null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_ROLE_ALREADY_SET
            );
        }

        try { 
            $result = $this->role_repository->getByName($role->value);
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if ($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ROLE_NOT_FOUND
            );
        }

        $role = $result->name;

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            $user_id,
            UserProcessingStepStageEnum::AssignRole->value
        );

        if($result !== null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_PROCESSING_STEP_ALREADY_EXISTS
            );
        }

        return $this->assign_user_role_transaction->handle(
            $user->id,
            $role,
            $user->status
        );
    }

    public function dismissUserRole(
        int $user_id
    ) {
        if (!$this->authorization->canDismissUserRole()) {
            throw ServiceException::FORBIDDEN();
        }
        
        $result = $this->existsUser($user_id);

        if(!$result->success) {
            return $result;
        }

        $user = $result->entity;

        if ($user->role === RoleNameEnum::Root) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::FORBIDDEN
            );
        }

        if (!in_array(
            $user->status,
            [
                UserStatusEnum::Processing,
                UserStatusEnum::Active,
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_INVALID_STATUS_TRANSITION
            );
        }

        if ($user->role === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_ROLE_NOT_FOUND
            );
        }

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            $user_id,
            UserProcessingStepStageEnum::AssignRole->value
        );

        if($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_PROCESSING_STEP_NOT_FOUND
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
        int $user_id,
        string $name
    ) {
        if(!$this->authorization->canAddUserName()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsUser($user_id);

        if(!$result->success) {
            return $result;
        }

        $user = $result->entity;

        if (!in_array(
            $user->status,
            [
                UserStatusEnum::Created,
                UserStatusEnum::Processing,
                UserStatusEnum::Active
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_INVALID_STATUS_TRANSITION
            );
        }

        $result = $this->user_name_repository->findByUserIdAndValue(
            user_id: $user_id,
            value: $name
        );

        if($result !== null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_NAME_ALREADY_EXISTS
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
            $this->authorization->user->id
        );
    }   

    public function setPrimaryUserName(
        int $user_id,
        int $record_id
    ) {
        if(!$this->authorization->canSetPrimaryUserName()) {
            throw ServiceException::FORBIDDEN();
        }
        
        $result = $this->existsUser($user_id);

        if(!$result->success) {
            return $result;
        }

        $user = $result->entity;

        if (!in_array(
            $user->status,
            [
                UserStatusEnum::Processing,
                UserStatusEnum::Active
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_INVALID_STATUS_TRANSITION
            );
        }

        $result = $this->existsUserName($record_id);

        if(!$result->success) {
            return $result;
        }

        $user_name = $result->entity;

        if ($user->id != $user_name->user_id) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_NAME_NOT_FOUND
            );
        }

        if ($user_name->is_primary){
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_NAME_ALREADY_PRIMARY
            );
        }

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            user_id: $user->id,
            stage: UserProcessingStepStageEnum::Named->value
        );

        $create_processing_step = ($result === null)? true: false;

        return $this->set_primary_user_name_transaction->handle(
            $record_id,
            $user_name->user_id,
            $create_processing_step
        );
    }

    public function removeUserName(
        int $user_id
    ) {
        if(!$this->authorization->canRemoveUserName()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsUser($user_id);

        if(!$result->success) {
            return $result;
        }   

        $user = $result->entity;

        if ($user->role === RoleNameEnum::Root) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::FORBIDDEN
            );
        }

        if (!in_array(
            $user->status,
            [
                UserStatusEnum::Processing,
                UserStatusEnum::Active
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_INVALID_STATUS_TRANSITION
            );
        }

        $user_name = $this->user_name_repository->findPrimaryByUserId($user_id);

        if ($user_name === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_NAME_NOT_FOUND
            );
        }

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            user_id: $user_id,
            stage: UserProcessingStepStageEnum::Named->value
        );

        if($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_PROCESSING_STEP_NOT_FOUND
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
        int $user_id,
        ProviderNameEnum $provider,
        string $external_id
    ) {
        if(!$this->authorization->canAddUserIdentity()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsUser($user_id);

        if(!$result->success) {
            return $result;
        }   

        $user = $result->entity;

        if (!in_array(
            $user->status,
            [
                UserStatusEnum::Created,
                UserStatusEnum::Processing,
                UserStatusEnum::Active
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_INVALID_STATUS_TRANSITION
            );
        }

        $result = $this->user_identity_repository->findByUserIdAndProvider(
            user_id: $user->id,
            provider: $provider->value
        );

        if($result !== null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_IDENTITY_ALREADY_EXISTS
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
        int $user_id,
        ProviderNameEnum $provider
    ) {
        if(!$this->authorization->canRemoveUserIdentity()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsUser($user_id);

        if(!$result->success) {
            return $result;
        }   

        $user = $result->entity;

        $result = $this->user_identity_repository->findByUserIdAndProvider(
            user_id: $user->id,
            provider: $provider->value
        );

        if($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_IDENTITY_NOT_FOUND
            );
        }

        $user_identity = $result;

        if (!in_array(
            $user->status,
            [
                UserStatusEnum::Created,
                UserStatusEnum::Processing,
                UserStatusEnum::Active
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_INVALID_STATUS_TRANSITION
            );
        }

        $result = $this->user_processing_step_repository->findByUserIdAndStage(
            user_id: $user->id,
            stage: UserProcessingStepStageEnum::Identified->value
        );

        if($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_PROCESSING_STEP_NOT_FOUND
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