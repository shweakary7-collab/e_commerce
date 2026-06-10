<?php

use Spatie\Permission\Models\Role;

if (!function_exists('getUserRole')) {
    function getUserRole($user = null)
    {
        $user = $user ?? auth()->user();
        if (!$user) return null;
        
        $roles = $user->getRoleNames();
        return $roles->first();
    }
}

if (!function_exists('userHasRole')) {
    function userHasRole($role, $user = null)
    {
        $user = $user ?? auth()->user();
        if (!$user) return false;
        
        return $user->hasRole($role);
    }
}
