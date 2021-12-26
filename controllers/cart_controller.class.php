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

    public function empty_cart() {

    }

    public function holding()
    {
        $rows = $this->cart_model->view_cart();

        $view = new ViewCart();
        $view->display($rows);
    }

    public function remove()
    {
        $rows = $this->cart_model->view_cart();
        $remove = $this->cart_model->remove_from_cart();

        $view = new ViewCart();
        $view->display($rows, $remove);
    }

    public function empty_items()
    {

    }

    public function Checkout()
    {

    }
}