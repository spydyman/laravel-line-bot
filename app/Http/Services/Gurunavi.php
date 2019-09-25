<?php

namespace App\Services;

use GuzzleHttp\Client;

class Gurunavi
{
    private const RESTAURANTS_SEARCH_API_URL = 'https://api.gnavi.co.jp/RestSearchAPI/v3/';

    // public function searchRestaurants($word)
    public function searchRestaurants(string $word): array
    {
        $client = new Client();
        $response = $client
            ->get(self::RESTAURANTS_SEARCH_API_URL, [
                'query' => [
                    'keyid' => env('GURUNAVI_ACCESS_KEY'),
                    'freeword' => str_replace(' ', ',', $word),
                ],
                'http_errors' => false,
                // getメソッドについて
                // 第一引数には、リクエスト先のURLを渡す。
                // 第二引数には、オプションとなる情報を連想配列で渡す。
                // その連想配列の中で、'query'をキーとする連想配列でリクエストパラメータを指定する事ができる。
            ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
