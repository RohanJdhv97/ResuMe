<?php

// config for Icetalker/FilamentChatgptBot
return [
    'enable' => env('OPENAI_API_ENABLE'),

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
        'organization' => env('OPENAI_ORGANIZATION'),
    ],
    
    'proxy'=> env('OPENAI_PROXY'),

];