<?php

return [
  'api' => [

    'weather' => [
      'key' =>  env('WEATHER_CAST_API_KEY'),
    ],

    'twitter' => [
      'settings' => [
        'getNum' => 12, //環境ごとに変わるなら
      ],
      'key' =>  env('TWITTER_API_KEY'),
      'key_secret' =>  env('TWITTER_API_KEY_SECRET'),
      'access_token' =>  env('TWITTER_API_ACCESS_TOKEN'),
      'access_token_secret' =>  env('TWITTER_API_ACCESS_TOKEN_SECRET'),
    ],
  ],

  'positions' => [
    '札幌' => [
      'lat' => 43.061936,
      'lon' => 141.3542924,
    ],
    '東京' => [
      'lat' => 5.7968777,
      'lon' => 142.8381612,
    ],
    '大阪' => [
      'lat' => 35.2524044,
      'lon' => 140.0419644,
    ],
    '沖縄' => [
      'lat' => 3.6888671,
      'lon' => 125.5353146,
    ],
  ],
];
