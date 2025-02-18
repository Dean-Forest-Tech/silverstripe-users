<?php

namespace DFT\SilverStripe\Users\Extensions;

use SilverStripe\ORM\DB;
use SilverStripe\Security\Group;
use DFT\SilverStripe\Users\Users;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Core\Config\Config;
use SilverStripe\Security\Permission;

/**
 * Overwrite group object so we can setup some more default groups
 *
 * @package Users
 */
class GroupExtension extends DataExtension
{
    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();

        $frontend_groups = Config::inst()->get(
            Users::class,
            'new_user_groups'
        );

        // Add default author group if no other group exists
        if (is_array($frontend_groups)) {
            foreach ($frontend_groups as $code) {
                $group = Group::get()->find("Code", $code);

                if (empty($group)) {
                    $group = Group::create();
                    $group->Code = $code;
                    $group->Title = Users::convertCodeToName($code);
                    $group->write();
                    Permission::grant($group->ID, 'USERS_MANAGE_ACCOUNT');

                    DB::alteration_message("Front end user group {$code} created", 'created');
                }
            }
        }

        $verification_groups = Config::inst()->get(
            Users::class,
            'verification_groups'
        );

        if (is_array($verification_groups)) {
            foreach ($verification_groups as $code) {
                // Add default author group if no other group exists
                $group = Group::get()->find("Code", $code);

                if (empty($group)) {
                    $group = Group::create();
                    $group->Code = $code;
                    $group->Title = Users::convertCodeToName($code);
                    $group->write();
                    Permission::grant($group->ID, 'USERS_VERIFIED');

                    DB::alteration_message("Verified users group {$code} created", 'created');
                }
            }
        }
    }
}
