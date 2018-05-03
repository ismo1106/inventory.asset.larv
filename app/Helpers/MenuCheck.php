<?php

/*
 * Setting Content Information
 */

namespace App\Helpers;

use App\Models\Menu;

class MenuCheck {

    public static function __haveChild($id)
    {
        $menu = Menu::where('header', $id)->count();
        if ($menu > 0) {
            return TRUE;
        }
        return FALSE;
    }

}
