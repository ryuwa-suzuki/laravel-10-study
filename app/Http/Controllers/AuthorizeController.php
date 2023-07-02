<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPShopify\ShopifySDK;
use PHPShopify\AuthHelper;

class AuthorizeController extends Controller
{
    public function index()
    {
        ShopifySDK::config([
            'ShopUrl' => config('shopify.shop_url'),
            'ApiKey' => config('shopify.client_key'),
            'SharedSecret' => config('shopify.secret_key')
        ]);

        $scopes = 'read_products,write_products,read_script_tags,write_script_tags';
        $redirectUrl = config('shopify.callback_url');

        AuthHelper::createAuthRequest($scopes, $redirectUrl);

        exit;
    }
}
