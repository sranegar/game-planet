<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/22/2021
 * File: cart_session.class.php
 * Description:
 */
class CartSession
{

    const kShoppingCartSessionKey = 'SHOPPINGCART';

    public static function StoreShoppingCartInSession ($shoppingCart) {
        if (!isset($_SESSION)) { session_start(); }
        $_SESSION[CartSession::kShoppingCartSessionKey] = $shoppingCart;
    }

    public static function ShoppingCartExists () {
        if (!isset($_SESSION)) { session_start(); }
        return isset($_SESSION[CartSession::kShoppingCartSessionKey]);
    }

    public static function GetShoppingCart () {
        if (CartSession::ShoppingCartExists()) {
            if (!isset($_SESSION)) { session_start(); }
            return $_SESSION[CartSession::kShoppingCartSessionKey];
        } else {
            return null;
        }
    }

    public static function RemoveShoppingCartFromSession () {
        if (ShoppingCartSession::ShoppingCartExists()) {
            if (!isset($_SESSION)) { session_start(); }
            if (isset($_SESSION[ShoppingCartSession::kShoppingCartSessionKey])) {
                unset($_SESSION[ShoppingCartSession::kShoppingCartSessionKey]);
            }
        }
    }

}
