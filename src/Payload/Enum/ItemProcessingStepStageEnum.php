<?php
namespace WarehouseCore\Payload\Enum;

enum ItemProcessingStepStageEnum: string {
    case Identified   = "Identified";
    case Photo      = "Photo";
    case Inspection = "Inspection";
    case Placement  = "Placement";
}