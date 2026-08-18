<?php
namespace WarehouseCore\Payload\Enum;

enum ItemProcessingStepStageEnum: string {
    case Identify   = "Identify";
    case Photo      = "Photo";
    case Inspection = "Inspection";
    case Placement  = "Placement";
}