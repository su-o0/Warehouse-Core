<?php 
namespace WarehouseCore\Payload\Enum;

enum UserProcessingStepStageEnum : string {
    case Named = 'Named';
    case AssignRole = 'AssignRole';
    case Identified = 'Identified';
}