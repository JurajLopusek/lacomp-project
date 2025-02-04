<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ID for all Model creator and updater when application create model (CRON, FACTORY, ...)
    |--------------------------------------------------------------------------
    */
    'error_notification_user' => env('ERROR_NOTIFICATION_USER', 1),

    'master_user_id' => env('MASTER_USER_ID', 1),
    'cron_user_id' => env('CRON_USER_ID', 2),
];
