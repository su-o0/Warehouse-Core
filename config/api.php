<?php

return [
    'Area' => [
        'AddAreaName' => [
            'name' => 'add_area_name',
            'type' => 'command',
            'parameters' => [
                'area_id' => 'int',
                'name' => 'string'
            ]
        ],
        'SetPrimaryAreaName' => [
            'name' => 'set_primary_area_name',
            'type' => 'command',
            'parameters' => [
                'area_id' => 'int',
                'record_id' => 'int'
            ]
        ],
        'RemoveAreaName' => [
            'name' => 'remove_area_name',
            'type' => 'command',
            'parameters' => [
                'area_id' => 'int'
            ]
        ],
        'GrantAreaAccess' => [
            'name' => 'grant_area_access',
            'type' => 'command',
            'parameters' => [
                'area_id' => 'int',
                'user_id' => 'int'
            ]
        ],
        'RevokeAreaAccess' => [
            'name' => 'revoke_area_access',
            'type' => 'command',
            'parameters' => [
                'area_id' => 'int',
                'user_id' => 'int'
            ]
        ],
        'CreateArea' => [
            'name' => 'create_area',
            'type' => 'command',
            'parameters' => []
        ],
        'ActivateArea' => [
            'name' => 'activate_area',
            'type' => 'command',
            'parameters' => [
                'area_id' => 'int'
            ]
        ],
        'MarkAreaAsCrowded' => [
            'name' => 'mark_area_as_crowded',
            'type' => 'command',
            'parameters' => [
                'area_id' => 'int'
            ]
        ],
        'ArchiveArea' => [
            'name' => 'archive_area',
            'type' => 'command',
            'parameters' => [
                'area_id' => 'int',
            ],
        ],
        'ListArea' => [
            'name' => 'list_area',
             'type' => 'query',
            'parameters' => [],
        ],
        'ListAreaNames' => [
            'name' => 'list_area_names',
            'type' => 'query',
            'parameters' => [
                'area_id' => 'int',
            ],
        ],
    ],

    'Container' => [

    ],
    
    'Item' => [

    ],
   
    'Owner' => [

    ],

    'Part' => [

    ],
      
    'PhysicalTag' => [

    ],
    
    'Rack' => [
        'RegisterRack' => [
            'name' => 'register_rack',
            'type' => 'command',
            'parameters' => [
                'rack_type' => 'string'
            ]
        ],
        'ActivateRack' => [
            'name' => 'activate_rack',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int'
            ]
        ],
        'ArchiveRack' => [
            'name' => 'archive_rack',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int'
            ]
        ],
        'PopulateRack' => [
            'name' => 'populate_rack',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int',
                'count' => 'int'
            ]
        ],
        'AddRackName' => [
            'name' => 'add_rack_name',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int',
                'name' => 'string'
            ]
        ],
        'SetPrimaryRackName' => [
            'name' => 'set_primary_rack_name',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int',
                'record_id' => 'int'
            ]
        ],
        'RemoveRackName' => [
            'name' => 'remove_rack_name',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int'
            ]
        ],
        'ListRack' => [
            'name' => 'list_rack',
            'type' => 'query',
            'parameters' => []
        ],
        'ListRackNames' => [
            'name' => 'list_rack_names',
            'type' => 'query',
            'parameters' => [
                'rack_id' => 'int'
            ]
        ],
        'ListRackByArea' => [
            'name' => 'list_rack_by_area',
            'type' => 'query',
            'parameters' => [
                'area_id' => 'int'
            ]
        ],
        'ListRackByZone' => [
            'name' => 'list_rack_by_zone',
            'type' => 'query',
            'parameters' => [
                'zone_id' => 'int'
            ]
        ]
    ],

    'Sales' => [

    ],

    'Shelf' => [
        'RegisterShelf' => [
            'name' => 'register_shelf',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int'
            ]
        ],
        'MarkShelfAsCrowded' => [
            'name' => 'mark_shelf_as_crowded',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int',
                'shelf_level' => 'int'
            ]
        ],
        'RemoveShelf' => [
            'name' => 'remove_shelf',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int',
                'shelf_level' => 'int'
            ]
        ]
    ],

    'StorageSlot' => [
        'RegisterStorageSlot' => [
            'name' => 'register_storage_slot',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int'
            ]
        ],
        'MarkStorageSlotAsCrowded' => [
            'name' => 'mark_storage_slot_as_crowded',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int',
                'slot_position' => 'int'
            ]
        ],
        'RemoveStorageSlot' => [
            'name' => 'remove_storage_slot',
            'type' => 'command',
            'parameters' => [
                'rack_id' => 'int',
                'slot_position' => 'int'
            ]
        ]
    ],

    'Stock' => [

    ],

    'User' => [
        'CreateUser' => [
            'name' => 'create_user',
            'type' => 'command',
            'parameters' => []
        ],
        'ActivateUser' => [
            'name' => 'activate_user',
            'type' => 'command',
            'parameters' => [
                'user_id' => 'int'
            ]
        ],
        'ArchiveUser' => [
            'name' => 'archive_user',
            'type' => 'command',
            'parameters' => [
                'user_id' => 'int',
            ]
        ],
        'AssignUserRole' => [
            'name' => 'assign_user_role',
            'type' => 'command',
            'parameters' => [
                'user_id' => 'int',
                'role' => 'string'
            ]
        ],
        'DismissUserRole' => [
            'name' => 'dismiss_user_role',
            'type' => 'command',
            'parameters' => [
                'user_id' => 'int'
            ],
        ],
        'AddUserIdentity' => [
            'name' => 'add_user_identity',
            'type' => 'command',
            'parameters' => [
                'user_id' => 'int',
                'provider' => 'string',
                'external_id' => 'string'
            ]
        ],
        'RemoveUserIdentity' => [
            'name' => 'remove_user_identity',
            'type' => 'command',
            'parameters' => [
                'user_id' => 'int',
                'provider' => 'string',
            ]
        ],
        'AddUserName' => [
            'name' => 'add_user_name',
            'type' => 'command',
            'parameters' => [
                'user_id' => 'int',
                'name' => 'string',
            ]
        ],
        'SetPrimaryUserName' => [
            'name' => 'set_primary_user_name',
            'type' => 'command',
            'parameters' => [
                'user_id' => 'int',
                'record_id' => 'int',
            ]
        ],
        'RemoveUserName' => [
            'name' => 'remove_user_name',
            'type' => 'command',
            'parameters' => [
                'user_id' => 'int',
            ]
        ],
        'ListUser' => [
            'name' => 'list_user',
            'type' => 'query',
            'parameters' => []
        ],
        'ListUserNames' => [
            'name' => 'list_user_names',
            'type' => 'query',
            'parameters' => [
                'user_id' => 'int'
            ],
        ],
        'ListUserIdentities' => [
            'name' => 'list_user_identities',
            'type' => 'query',
            'parameters' => [
                'user_id' => 'int'
            ]
        ]
    ],

    'Vehicle' => [

    ],

    'Zone' => [
        'AddZoneName' => [
            'name' => 'add_zone_name',
            'type' => 'command',
            'parameters' => [
                'zone_id' => 'int',
                'name' => 'string',
            ]
        ],
        'SetPrimaryZoneName' => [
            'name' => 'set_primary_zone_name',
            'type' => 'command',
            'parameters' => [
                'zone_id' => 'int',
                'record_id' => 'int'
            ]
        ],
        'RemoveZoneName' => [
            'name' => 'remove_zone_name',
            'type' => 'command',
            'parameters' => [
                'zone_id' => 'int'
            ]
        ],
        'CreateZone' => [
            'name' => 'create_zone',
            'type' => 'command',
            'parameters' => [],
        ],
        'ActivateZone' => [
            'name' => 'activate_zone',
            'type' => 'command',
            'parameters' => [
                'zone_id' => 'int'
            ]
        ],
        'MarkZoneAsCrowded' => [
            'name' => 'mark_zone_as_crowded',
            'type' => 'command',
            'parameters' => [
                'zone_id' => 'int'
            ]
        ],
        'ArchiveZone' => [
            'name' => 'archive_zone',
            'type' => 'command',
            'parameters' => [
                'zone_id' => 'int'
            ]
        ],
        'PlaceZoneToArea' => [
            'name' => 'place_zone_to_area',
            'type' => 'command',
            'parameters' => [
                'zone_id' => 'int',
                'area_id' => 'int'
            ]
        ],
        'MoveZoneToArea' => [
            'name' => 'move_zone_to_area',
            'type' => 'command',
            'parameters' => [
                'zone_id' => 'int',
                'area_id' => 'int'
            ],
        ],
        'RemoveZoneToArea' => [
            'name' => 'remove_zone_to_area',
            'type' => 'command',
            'parameters' => [
                'zone_id' => 'int'
            ]
        ],
        'ListZone' => [
            'name' => 'list_zone',
            'type' => 'query',
            'parameters' => []
        ],
        'ListZoneByArea' => [
            'name' => 'list_zone_by_area',
            'type' => 'query',
            'parameters' => [
                'area_id' => 'int'
            ]
        ],
        'ListZoneNames' => [
            'name' => 'list_zone_names',
            'type' => 'query',
            'parameters' => [
                'zone_id' => 'int'
            ]
        ]
    ]
];