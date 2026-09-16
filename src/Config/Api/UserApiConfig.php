<?php
namespace WarehouseCore\Config\Api;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\DTO\ApiConfigDTO;

final class UserApiConfig {
    use ConfigHelper;

    public function __construct(
        public ApiConfigDTO $create_user,
        public ApiConfigDTO $activate_user,
        public ApiConfigDTO $archive_user,
        public ApiConfigDTO $assign_user_role,
        public ApiConfigDTO $dismiss_user_role,
        public ApiConfigDTO $add_user_identity,
        public ApiConfigDTO $remove_user_identity,
        public ApiConfigDTO $add_user_name,
        public ApiConfigDTO $set_primary_user_name,
        public ApiConfigDTO $remove_user_name,
        public ApiConfigDTO $list_user,
        public ApiConfigDTO $list_user_names,
        public ApiConfigDTO $list_user_identities
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            create_user: ApiConfigDTO::fromRaw(
                self::required($raw, 'CreateUser')
            ),
            activate_user: ApiConfigDTO::fromRaw(
                self::required($raw, 'ActivateUser')
            ),
            archive_user: ApiConfigDTO::fromRaw(
                self::required($raw, 'ArchiveUser')
            ),
            assign_user_role: ApiConfigDTO::fromRaw(
                self::required($raw, 'AssignUserRole')
            ),
            dismiss_user_role: ApiConfigDTO::fromRaw(
                self::required($raw, 'DismissUserRole')
            ),
            add_user_identity: ApiConfigDTO::fromRaw(
                self::required($raw, 'AddUserIdentity')
            ),
            remove_user_identity: ApiConfigDTO::fromRaw(
                self::required($raw, 'RemoveUserIdentity')
            ),
            add_user_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'AddUserName')
            ),
            set_primary_user_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'SetPrimaryUserName')
            ),
            remove_user_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'RemoveUserName')
            ),
            list_user: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListUser')
            ),
            list_user_names: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListUserNames')
            ),
            list_user_identities: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListUserIdentities')
            ),
        );
    }
}