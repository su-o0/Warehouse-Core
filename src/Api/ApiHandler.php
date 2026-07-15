<?php
namespace WarehouseCore\Api;

use DomainException;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ValidationException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Registry\ApiRegistry;
use WarehouseCore\Validation\CreateUserValidator;

final class ApiHandler {
    public function __construct(
        private ApiRegistry $api
    ) { }

    public function createUser(
        array $arguments
    ): ServiceResult{
        try {
            $request = CreateUserValidator::validate($arguments);

            return $this->api->createUser()->handle(
                $request->name,
                $request->role
            );
        } catch (ValidationException $e) {
            return new ServiceResult(success: false, message: $e->getMessage());
        } catch (\Throwable $e) {
            return new ServiceResult(success: false, message: $e->getMessage() . "\n" . $e->getTraceAsString());

            return new ServiceResult(success: false, message: ErrorMessage::SERVICE_UNAVALIBLE);
        }
    }
}