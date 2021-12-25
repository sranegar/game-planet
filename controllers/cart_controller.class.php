<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/20/2021
 * File: cart_controller.class.php
 * Description:
 */
class CartController
{

    //default constructor
    public function __construct()
    {

        //create an instance of the GameModel class
        $this->game_model = GameModel::getGameModel();

        //create an instance of the GameModel class
        $this->cart_model = CartModel::getCartModel();

        //retrieve query-terms using GET method
        if (isset($_GET['query-terms'])) {
            //retrieve query terms
            $query_terms = trim($_GET['query-terms']);
        }

    }


    public function holding()
    {
        $remove = '';
        $rows = $this->cart_model->view_cart();

        $view = new ViewCart();
        $view->display($remove, $rows);
    }

    public function remove()
    {
        $rows = $this->cart_model->view_cart();
        $remove = $this->cart_model->remove_from_cart();

        $view = new ViewCart();
        $view->display($remove, $rows);
    }

    public function empty_items()
    {
        ShoppingCartSession::RemoveShoppingCartFromSession();

        $v = new WelcomeIndex();
        $v->display();

    }

    public function Checkout()
    {
        $cart = ShoppingCartSession::GetShoppingCart();
        $model = $cart->game_model->list_games();


    }
}