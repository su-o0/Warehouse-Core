<?php
namespace WarehouseCore\Payload\Enum;

enum ApiDomainEnum : string {
    case Area = 'area';
    case Container = 'container'; 
    case User = 'user'; 
    case Item = 'item'; 
    case Movement = 'movement'; 
    case Owner = 'owner'; 
    case Part = 'part'; 
    case Photo = 'photo'; 
    case PhysicalTag = 'physical_tag'; 
    case Placement = 'placement'; 
    case Rack = 'rack'; 
    case Sales = 'sales'; 
    case Shelf = 'shelf'; 
    case StorageSlot = 'storage_slot'; 
    case Stock = 'stock'; 
    case Vehicle = 'vehicle'; 
    case Video = 'video'; 
    case Zone = 'zone'; 
    case Find = 'find'; 
}