<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Toss Payments Configuration
    |--------------------------------------------------------------------------
    |
    | 토스페이먼츠 API 연동을 위한 설정입니다.
    | 샌드박스(테스트) 환경과 프로덕션 환경을 구분하여 사용합니다.
    |
    */

    // 샌드박스 모드 (true: 테스트, false: 실제 결제)
    'sandbox' => env('TOSS_SANDBOX', true),

    // 테스트 키 (샌드박스용)
    'test' => [
        'client_key' => env('TOSS_TEST_CLIENT_KEY', ''),
        'secret_key' => env('TOSS_TEST_SECRET_KEY', ''),
    ],

    // 실제 키 (프로덕션용)
    'live' => [
        'client_key' => env('TOSS_LIVE_CLIENT_KEY', ''),
        'secret_key' => env('TOSS_LIVE_SECRET_KEY', ''),
    ],

    // API 엔드포인트
    'api_url' => 'https://api.tosspayments.com/v1',

    // 결제 성공/실패 리다이렉트 URL
    'success_url' => env('APP_URL') . '/payment/success',
    'fail_url' => env('APP_URL') . '/payment/fail',
];
