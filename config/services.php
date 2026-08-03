<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
        // Newsletter list. Confirmed subscribers sync here for broadcasts; the
        // sync no-ops when the key or audience id are absent (e.g. local dev).
        'audience_id' => env('RESEND_AUDIENCE_ID'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
            // Forward error-level logs (and unhandled exceptions) to Slack. On by
            // default; SLACK_ALERT_ON_ERROR=false is the kill switch. Success pings
            // are unaffected.
            'alert_on_error' => env('SLACK_ALERT_ON_ERROR', true),
        ],
    ],

    'github' => [
        // Token is only used by the LOCAL `github:pins:refresh` command (and only
        // if you prefer the GraphQL API over the authed `gh` CLI, which needs no
        // token). Production serves the committed pins file and never calls GitHub,
        // so no token is needed there.
        'token' => env('GITHUB_TOKEN'),
        'user' => env('GITHUB_USER', 'albertorsesc'),
        // Committed pins file: generated locally by the refresh command, read at
        // request time. Same "index locally, commit, serve" flow as the blog.
        'pins_file' => database_path('github-pins.json'),
    ],

];
