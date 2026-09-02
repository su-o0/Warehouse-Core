<?php
namespace WarehouseCore\Payload\Hydrate;

use WarehouseCore\Contract\Hydrator;
use WarehouseCore\Payload\DTO\UserStageDTO;
use WarehouseCore\Payload\Enum\UserProcessingStepStageEnum;

final class UserStageHydrator implements Hydrator {
    public static function hydrate(
        array $raw
    ): UserStageDTO {
        $dto = new UserStageDTO();

        foreach ($raw as $step) {
            match ($step->stage) {
                UserProcessingStepStageEnum::Named =>
                    $dto->named = true,

                UserProcessingStepStageEnum::AssignRole =>
                    $dto->assign_role = true,

                UserProcessingStepStageEnum::Identify =>
                    $dto->identify = true,
            };
        }

        return $dto;    
    }
}