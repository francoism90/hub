<?php

use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Search Engine
    |--------------------------------------------------------------------------
    |
    | This option controls the default search connection that gets used while
    | using Laravel Scout. This connection is used when syncing all models
    | to the search service. You should adjust this based on your needs.
    |
    | Supported: "algolia", "meilisearch", "database", "collection", "null"
    |
    */

    'driver' => env('SCOUT_DRIVER', 'algolia'),

    /*
    |--------------------------------------------------------------------------
    | Index Prefix
    |--------------------------------------------------------------------------
    |
    | Here you may specify a prefix that will be applied to all search index
    | names used by Scout. This prefix may be useful if you have multiple
    | "tenants" or applications sharing the same search infrastructure.
    |
    */

    'prefix' => env('SCOUT_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Queue Data Syncing
    |--------------------------------------------------------------------------
    |
    | This option allows you to control if the operations that sync your data
    | with your search engines are queued. When this is set to "true" then
    | all automatic data syncing will get queued for better performance.
    |
    */

    'queue' => env('SCOUT_QUEUE', false),

    /*
    |--------------------------------------------------------------------------
    | Database Transactions
    |--------------------------------------------------------------------------
    |
    | This configuration option determines if your data will only be synced
    | with your search indexes after every open database transaction has
    | been committed, thus preventing any discarded data from syncing.
    |
    */

    'after_commit' => true,

    /*
    |--------------------------------------------------------------------------
    | Chunk Sizes
    |--------------------------------------------------------------------------
    |
    | These options allow you to control the maximum chunk size when you are
    | mass importing data into the search engine. This allows you to fine
    | tune each of these chunk sizes based on the power of the servers.
    |
    */

    'chunk' => [
        'searchable' => 500,
        'unsearchable' => 500,
    ],

    /*
    |--------------------------------------------------------------------------
    | Soft Deletes
    |--------------------------------------------------------------------------
    |
    | This option allows to control whether to keep soft deleted records in
    | the search indexes. Maintaining soft deleted records can be useful
    | if your application still needs to search for the records later.
    |
    */

    'soft_delete' => true,

    /*
    |--------------------------------------------------------------------------
    | Identify User
    |--------------------------------------------------------------------------
    |
    | This option allows you to control whether to notify the search engine
    | of the user performing the search. This is sometimes useful if the
    | engine supports any analytics based on this application's users.
    |
    | Supported engines: "algolia"
    |
    */

    'identify' => env('SCOUT_IDENTIFY', false),

    /*
    |--------------------------------------------------------------------------
    | Algolia Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Algolia settings. Algolia is a cloud hosted
    | search engine which works great with Scout out of the box. Just plug
    | in your application ID and admin API key to get started searching.
    |
    */

    'algolia' => [
        'id' => env('ALGOLIA_APP_ID', ''),
        'secret' => env('ALGOLIA_SECRET', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Meilisearch Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Meilisearch settings. Meilisearch is an open
    | source search engine with minimal configuration. Below, you can state
    | the host and key information for your own Meilisearch installation.
    |
    | See: https://docs.meilisearch.com/guides/advanced_guides/configuration.html
    |
    */

    'meilisearch' => [
        'host' => env('MEILISEARCH_HOST', 'http://localhost:7700'),
        'key' => env('MEILISEARCH_KEY', null),
        'index-settings' => [
            User::class => [
                'filterableAttributes' => [
                    'id',
                    'email',
                    'state',
                    'created_at',
                    'updated_at',
                    '__soft_deleted',
                ],

                'searchableAttributes' => [
                    'name',
                    'email',
                ],

                'sortableAttributes' => [
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
            ],

            Video::class => [
                'filterableAttributes' => [
                    'id',
                    'studios',
                    'genres',
                    'languages',
                    'people',
                    'adult',
                    'state',
                    'status',
                    'created_at',
                    'updated_at',
                    '__soft_deleted',
                ],

                'searchableAttributes' => [
                    'name',
                    'titles',
                    'episode',
                    'season',
                    'people',
                    'studios',
                    'genres',
                    'released_at',
                    'content',
                    'summary',
                    'languages',
                ],

                'sortableAttributes' => [
                    'name',
                    'season',
                    'episode',
                    'released_at',
                    'created_at',
                    'updated_at',
                ],

                'synonyms' => [
                    '1' => ['01'],
                    '2' => ['02'],
                    '3' => ['03'],
                    '4' => ['04'],
                    '5' => ['05'],
                    '6' => ['06'],
                    '7' => ['07'],
                    '8' => ['08'],
                    '9' => ['09'],
                    '01' => ['1'],
                    '02' => ['2'],
                    '03' => ['3'],
                    '04' => ['4'],
                    '05' => ['5'],
                    '06' => ['6'],
                    '07' => ['7'],
                    '08' => ['8'],
                    '09' => ['9'],
                    '&' => ['and'],
                    '@' => ['at'],
                    '#' => ['hash', 'hashtag'],
                ],

                'stopWords' => [
                    '.',
                    ',',
                    '-',
                    '_',
                    '-',
                    '|',
                    '(',
                    ')',
                    '[',
                    ']',
                ],

                'typoTolerance' => [
                    'minWordSizeForTypos' => [
                        'oneTypo' => 3,
                        'twoTypos' => 4,
                    ],
                ],

                'pagination' => [
                    'maxTotalHits' => 10000,
                ],
            ],

            Tag::class => [
                'filterableAttributes' => [
                    'id',
                    'type',
                    'adult',
                    'created_at',
                    'updated_at',
                    '__soft_deleted',
                ],

                'searchableAttributes' => [
                    'name',
                    'description',
                    'type',
                ],

                'sortableAttributes' => [
                    'name',
                    'type',
                    'created_at',
                    'updated_at',
                ],

                'synonyms' => [
                    '&' => ['and'],
                    '@' => ['at'],
                ],

                'stopWords' => [
                    '.',
                    ',',
                    '-',
                    '_',
                    '-',
                    '|',
                    '(',
                    ')',
                    '[',
                    ']',
                ],

                'typoTolerance' => [
                    'minWordSizeForTypos' => [
                        'oneTypo' => 3,
                        'twoTypos' => 4,
                    ],
                ],

                'pagination' => [
                    'maxTotalHits' => 10000,
                ],
            ],
        ],
    ],

];
