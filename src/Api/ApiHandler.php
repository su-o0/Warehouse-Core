<?php
namespace WarehouseCore\Api;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Registry\ApiRegistry;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ValidationException;
use WarehouseCore\Payload\Request\ActivateLocationRequest;
use WarehouseCore\Payload\Request\AssignPhysicalTagRequest;
use WarehouseCore\Payload\Request\CreateContainerRequest;
use WarehouseCore\Payload\Request\CreateLocationRequest;
use WarehouseCore\Payload\Request\CreatePhysicalTagRequest;
use WarehouseCore\Payload\Request\CreateUserIdentityRequest;
use WarehouseCore\Payload\Request\CreateUserRequest;
use WarehouseCore\Payload\Request\GetLocationRequest;
use WarehouseCore\Payload\Request\ListLocationsRequest;

final class ApiHandler {
    public function __construct(
        private ApiRegistry $api
    ) { }

    public function createUser(
        array $raw
    ): ApiResult{
        try {
            return $this->api->createUser()->handle(
                CreateUserRequest::fromRaw($raw)
            );
        } catch (ValidationException $e) {
            return new ServiceResult(success: false, message: $e->getMessage());
        } catch (\Throwable $e) {
            return new ServiceResult(success: false, message: $e->getMessage() . "\n" . $e->getTraceAsString());
            return new ServiceResult(success: false, message: ErrorMessage::SERVICE_UNAVAILABLE);
        }
    }

    public function createUserIdentity(
        array $raw
    ): ApiResult{
        try {
            return $this->api->createUserIdentity()->handle(
                CreateUserIdentityRequest::fromRaw($raw)
            );
        } catch (ValidationException $e) {
            return new ServiceResult(success: false, message: $e->getMessage());
        } catch (\Throwable $e) {
            return new ServiceResult(success: false, message: $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }

    public function createLocation(
        array $raw
    ): ApiResult{
        try {
            return $this->api->createLocation()->handle(
                CreateLocationRequest::fromRaw($raw)
            );
        } catch (ValidationException $e) {
            return new ServiceResult(success: false, message: $e->getMessage(). "\n" . $e->getTraceAsString());
        } catch (\Throwable $e) {
            return new ServiceResult(success: false, message: $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }

    public function createContainer(
        array $raw
    ): ApiResult{
        try {
            return $this->api->createContainer()->handle(
                CreateContainerRequest::fromRaw($raw)
            );
        } catch (ValidationException $e) {
            return new ServiceResult(success: false, message: $e->getMessage(). "\n" . $e->getTraceAsString());
        } catch (\Throwable $e) {
            return new ServiceResult(success: false, message: $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }

    public function createPhysicalTag(
        array $raw
    ): ApiResult{
        try {
            return $this->api->createPhysicalTag()->handle(
                CreatePhysicalTagRequest::fromRaw($raw)
            );
        } catch (ValidationException $e) {
            return new ServiceResult(success: false, message: $e->getMessage(). "\n" . $e->getTraceAsString());
        } catch (\Throwable $e) {
            return new ServiceResult(success: false, message: $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }
    public function assignPhysicalTag(
        array $raw
    ): ApiResult{
        try {
            return $this->api->assignPhysicalTag()->handle(
                AssignPhysicalTagRequest::fromRaw($raw)
            );
        } catch (ValidationException $e) {
            return new ServiceResult(success: false, message: $e->getMessage(). "\n" . $e->getTraceAsString());
        } catch (\Throwable $e) {
            return new ServiceResult(success: false, message: $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }

    public function activateLocation(
        array $raw
    ): ApiResult{
        try {
            return $this->api->activateLocation()->handle(
                ActivateLocationRequest::fromRaw($raw)
            );
        } catch (ValidationException $e) {
            return new ServiceResult(success: false, message: $e->getMessage(). "\n" . $e->getTraceAsString());
        } catch (\Throwable $e) {
            return new ServiceResult(success: false, message: $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }

    public function archiveLocation(
        array $raw
    ): ApiResult{
        try {
            return $this->api->archiveLocation()->handle(
                ActivateLocationRequest::fromRaw($raw)
            );
        } catch (ValidationException $e) {
            return new ServiceResult(success: false, message: $e->getMessage(). "\n" . $e->getTraceAsString());
        } catch (\Throwable $e) {
            return new ServiceResult(success: false, message: $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }

    public function getLocation(
        array $raw
    ): ApiResult{
        try {
            return $this->api->getLocation()->handle(
                GetLocationRequest::fromRaw($raw)
            );
        } catch (ValidationException $e) {
            return new ServiceResult(success: false, message: $e->getMessage(). "\n" . $e->getTraceAsString());
        } catch (\Throwable $e) {
            return new ServiceResult(success: false, message: $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }

    public function listLocations(
    ): ApiResult{
        try {
            return $this->api->listLocations()->handle();
        } catch (ValidationException $e) {
            return new ServiceResult(success: false, message: $e->getMessage(). "\n" . $e->getTraceAsString());
        } catch (\Throwable $e) {
            return new ServiceResult(success: false, message: $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }
}