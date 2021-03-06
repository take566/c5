<?php

/**
 * -----------------------------------------------------------------------------
 * Generated 2021-03-26T16:48:20+09:00
 *
 * DO NOT EDIT THIS FILE DIRECTLY
 *
 * @item      maintenance.version_job_page_num
 * @group     concrete
 * @namespace null
 * -----------------------------------------------------------------------------
 */
return [
    'locale' => 'ja_JP',
    'version_installed' => '8.5.5',
    'version_db_installed' => '20201116182100',
    'misc' => [
        'login_redirect' => 'DESKTOP',
        'access_entity_updated' => 1521600988,
        'do_page_reindex_check' => false,
        'latest_version' => '8.5.5',
    ],
    'calendar' => [
        'topic_attribute' => 'event_categories',
    ],
    'accessibility' => [
        'toolbar_titles' => false,
        'toolbar_tooltips' => false,
        'toolbar_large_font' => false,
        'display_help_system' => false,
    ],
    'cache' => [
        'blocks' => true,
        'assets' => true,
        'theme_css' => true,
        'overrides' => true,
        'pages' => 'all',
        'full_page_lifetime' => 'default',
        'full_page_lifetime_value' => null,
        'clear' => [
            'thumbnails' => true,
        ],
    ],
    'theme' => [
        'compress_preprocessor_output' => true,
        'generate_less_sourcemap' => false,
    ],
    'seo' => [
        'redirect_to_canonical_url' => 0,
        'url_rewriting' => true,
    ],
    'maintenance' => [
        'version_job_page_num' => 224,
    ],
    'api' => [
        'enabled' => true,
        'grant_types' => [
            'client_credentials' => false,
            'authorization_code' => false,
            'password_credentials' => false,
            'refresh_token' => true,
        ],
    ],
];
