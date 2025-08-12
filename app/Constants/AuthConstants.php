<?php

namespace App\Constants;

class AuthConstants
{
    public const VALIDATION = 'Email or Password wrong.';
    public const UNAUTHORIZED = 'You must be logged in to perform any transactions.';
    public const REGISTER = 'User register successfully.';
    public const LOGIN = 'User Login successfully.';
    public const REFRESH = 'Refresh Token successfully.';
    public const LOGOUT = 'User Logout successfully.';
    public const PERMISSION = 'You don`t have permission.';
    public const ADMIN_ONLY = 'This action requires admin permissions only.';

    public const APPLE = 'apple';
    public const GOOGLE = 'google';
    public const TIKTOK = 'tiktok';
    public const Twitter = 'twitter'; // for FE only
    public const X = 'twitter-oauth-2';
    public const IG = 'instagram';
    public const FB = 'facebook';
}
