<?php 
namespace WarehouseCore\Payload;

final class HistoryAction
{
    ## Setup
    public const ADD_ADDRESS = 'ADD_ADDRESS';
    public const ADD_CONTAINER = 'ADD_CONTAINER';
    public const ADD_PHYSICAL_TAG = 'ADD_PHYSICAL_TAG';
    public const ADD_OWNER = 'ADD_OWNER';
    public const ADD_CAR = 'ADD_CAR';
    public const ADD_ITEM = 'ADD_ITEM';
    public const ADD_STOCK = 'ADD_STOCK';

    ## Placement
    public const SET_PLACEMENT = 'SET_PLACEMENT';

    ## Movement
    public const MOVE_ITEM = 'MOVE_ITEM';
    public const MOVE_CONTAINER = 'MOVE_CONTAINER';
    public const PUT_ITEM_INTO_CONTAINER = 'PUT_ITEM_INTO_CONTAINER';
    public const REMOVE_ITEM_FROM_CONTAINER = 'REMOVE_ITEM_FROM_CONTAINER';

    ## Inventory
    public const INCREMENT_STOCK_QTY = 'INCREMENT_STOCK_QTY';
    public const DECREMENT_STOCK_QTY = 'DECREMENT_STOCK_QTY';
    public const DELETE_STOCK = 'DELETE_STOCK';
    public const SET_ITEM_CONDITION = 'SET_ITEM_CONDITION';
    public const MARK_ITEM_SOLD = 'MARK_ITEM_SOLD';
    public const ARCHIVE_ITEM = 'ARCHIVE_ITEM';
    public const RETURN_ITEM = 'RETURN_ITEM';

    ## Query
    public const GET_ALL_LOCATIONS = 'GET_ALL_LOCATIONS';
    public const GET_ALL_CARS = 'GET_ALL_CARS';
    public const GET_LOCATION_CONTENT = 'GET_LOCATION_CONTENT';
    public const GET_CONTAINER_CONTENT = 'GET_CONTAINER_CONTENT';
    public const FIND_PHYSICAL_TAG = 'FIND_PHYSICAL_TAG';
    public const FIND_STOCK = 'FIND_STOCK';
    public const FIND_BY_TAG = 'FIND_BY_TAG';

    ## Media
    public const ADD_PHOTO = 'ADD_PHOTO';
    public const DELETE_PHOTO = 'DELETE_PHOTO';

    ## Audit
    public const SET_OWNER_PERMISSIONS = 'SET_OWNER_PERMISSIONS';
    public const DELETE_OWNER = 'DELETE_OWNER';
    public const GET_HISTORY = 'GET_HISTORY';
    public const GET_SALES = 'GET_SALES';
}