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

    //method for shopping cart
    public function holding()
    {
        $rows = $this->cart_model->view_cart();

        $view = new ViewCart();
        $view->display($rows);

    }

    //method for removing 1 from the qty
    public function remove($games_id)
    {
        $this->cart_model->remove_from_cart($games_id);
    }

    //delete all qty of game
    public function delete($id)
    {
        $this->cart_model->remove_game($id);
    }

    //empty cart //delete all items
    public function reset()
    {
        $rows = $this->cart_model->empty_cart();

        $view = new ViewCart();
        $view->display($rows);
    }
}