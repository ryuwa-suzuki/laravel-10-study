<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPShopify\ShopifySDK;
use PHPShopify\AuthHelper;
use App\Models\ShopifyToken;

class CallbackController extends Controller
{
    public function index()
    {
        ShopifySDK::config([
            'ShopUrl' => config('shopify.shop_url'),
            'ApiKey' => config('shopify.client_key'),
            'SharedSecret' => config('shopify.secret_key')
        ]);

        $accessToken = AuthHelper::getAccessToken();


        if (!isset($accessToken))
        {
            exit;
        }

        ShopifyToken::create([
            'token' => $accessToken
        ]);

        $config = ShopifySDK::$config;
        // ShopifySDKオブジェクト 取得
        $shopify = new ShopifySDK([
            'ShopUrl' => $config['ShopUrl'],
            'AccessToken' => $accessToken
        ]);

        // app handle 取得
        $graphQL =
            <<<Query
query {
  app {
    handle
  }
}
Query;
        $appResponse = $shopify->GraphQL->post($graphQL);
        header('Location: '.$config['AdminUrl'].'apps/'.$appResponse['data']['app']['handle']);

        exit;
    }

    public function test(Request $request)
    {
        var_dump($request->get('shopifySession'));exit;
    }
}
