<?php
namespace WarehouseCore\Payload\Type;

enum ItemProcessingStage: string {
    case Identify   = "Identify";
    case Photo      = "Photo";
    case Inspection = "Inspection";
    case Placement  = "Placement";
}