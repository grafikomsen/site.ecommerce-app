<?php

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),

    'meta' => [
        'defaults' => [
            'title'       => env('SEO_DEFAULT_TITLE', env('APP_NAME', 'eshop')),
            'titleBefore' => false,
            'description' => env('SEO_DEFAULT_DESCRIPTION', 'Découvrez notre boutique en ligne et nos meilleurs produits.'),
            'separator'   => ' - ',
            'keywords'    => explode(',', env('SEO_DEFAULT_KEYWORDS', 'ecommerce,shopping,produits,eshop')),
            'canonical'   => null,
            'robots'      => 'all',
        ],
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],
        'add_notranslate_class' => false,
    ],

    'opengraph' => [
        'defaults' => [
            'title'       => env('SEO_DEFAULT_TITLE', env('APP_NAME', 'eshop')),
            'description' => env('SEO_DEFAULT_DESCRIPTION', 'Découvrez notre boutique en ligne et nos meilleurs produits.'),
            'url'         => null,
            'type'        => 'website',
            'site_name'   => env('APP_NAME', 'eshop'),
            'images'      => [],
        ],
    ],

    'twitter' => [
        'defaults' => [
            // 'card' => 'summary',
            // 'site' => '@YourTwitterHandle',
        ],
    ],

    'json-ld' => [
        'defaults' => [
            'title'       => env('SEO_DEFAULT_TITLE', env('APP_NAME', 'eshop')),
            'description' => env('SEO_DEFAULT_DESCRIPTION', 'Découvrez notre boutique en ligne et nos meilleurs produits.'),
            'url'         => null,
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
