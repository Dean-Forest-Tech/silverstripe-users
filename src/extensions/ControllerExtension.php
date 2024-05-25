<?php

namespace DFT\SilverStripe\Users\Extensions;

use SilverStripe\Core\Extension;

/**
 * Extension for Controller that provide methods such as member management
 * interface to templates
 *
 * @package Users
 */
class ControllerExtension extends Extension
{
    /**
     * Render current user account nav
     *
     * @return string
     */
    public function getUserAccountNav()
    {
        return $this->owner->renderWith("DFT\\SilverStripe\\Users\\Includes\\UserAccountNav");
    }
}