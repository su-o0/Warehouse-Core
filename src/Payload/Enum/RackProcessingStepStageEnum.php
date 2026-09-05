<?php 
namespace WarehouseCore\Payload\Enum;

enum RackProcessingStepStageEnum : string {
    case Populate = 'Populate';
    case Placement = 'Placement';
}