<?php
namespace WarehouseCore\Payload\Type;

enum ItemProcessingStage: string {
    case Photo      = "Photo";
    case Condition  = "Condition";
    case Vision     = "Vision";
    case Placement  = "Placement";
}