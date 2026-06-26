<?php

if (!function_exists('avatarUrl')){
    function avatarUrl()
    {
        return auth()->user()?->avatar
            ? asset('storage/' . auth()->user()->profile?->avatar)
            : asset('storage/images/default-avatar.png');
    }
}