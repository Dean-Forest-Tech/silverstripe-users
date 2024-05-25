<?php

namespace DFT\SilverStripe\Users\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Core\Injector\Injector;
use DFT\SilverStripe\Users\Control\AccountController;
use DFT\SilverStripe\Users\Control\RegisterController;

/**
 * Extension for Controller that provide methods such as member management
 * interface to templates
 *
 * @package Users
 */
class ControllerExtension extends Extension
{
    public function getUserAccountNav()
    {
        return $this->owner->renderWith("DFT\\SilverStripe\\Users\\Includes\\UserAccountNav");
    }

    public function UsersAccountLink(string $action = 'index'): string
    {
        $controller = Injector::inst()
            ->get(AccountController::class, true);
        
        return $controller->Link($action);
    }

    public function UsersRegisterLink(string $action = 'index'): string
    {
        $controller = Injector::inst()
            ->get(RegisterController::class, true);
        
        return $controller->Link($action);
    }
}