<?php

/*
 * This file is part of Laravel Parse.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Parse App Id
    |--------------------------------------------------------------------------
    |
    | Here you may specify your parse app id.
    |
    */

    'app_id' => getenv('PARSE_APP_ID'),

    /*
    |--------------------------------------------------------------------------
    | Parse Rest Key
    |--------------------------------------------------------------------------
    |
    | Here you may specify your parse rest key.
    |
    */

    'rest_key' => getenv('PARSE_REST_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Parse Master Key
    |--------------------------------------------------------------------------
    |
    | Here you may specify your parse master key.
    |
    */

    'master_key' => getenv('PARSE_MASTER_KEY'),

];
