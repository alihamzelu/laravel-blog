<?php

if (!function_exists('avatarUrl')){
    function avatarUrl()
    {
        return auth()->user()?->avatar
            ? asset('storage/' . auth()->user()->avatar)
            : asset('storage/avatars/images.png');
    }
}