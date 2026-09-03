<?php 
namespace WarehouseCore\Payload\Enum;

enum PartProcessingStepStageEnum : string {
    case Identified = 'Identified';
    case Capture = 'Capture';
}