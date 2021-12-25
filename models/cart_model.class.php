<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/20/2021
 * File: cart_model.class.php
 * Description:
 */
class CartModel
{
    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblGame;
    private $tblRatings;
    private $tblPublisher;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getGameModel method must be called.
    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblGame = $this->db->getGameTable();
        $this->tblRatings = $this->db->getRatingsTable();
        $this->tblPublisher = $this->db->getPublisherTable();
        $this->tblGameSystem = $this->db->getGameSystemTable();
        $this->tblSystem = $this->db->getSystemTable();

        //start session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

        //initialize game titles
        if (!isset($_SESSION['titles'])) {
            $titles = $this->get_games();
            $_SESSION['titles'] = $titles;
        }

        //initialize game price
        if (!isset($_SESSION['price'])) {
            $price = $this->get_games();
            $_SESSION['price'] = $price;
        }

    }

    //static method to ensure there is just one GameModel instance
    public static function getCartModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new CartModel();
        }
        return self::$_instance;
    }

    public function view_cart()
    {
        try {
            //handle if shopping cart session has not started or one does not exist
            if (!isset($_SESSION['cart']) || !$_SESSION['cart']) {
                throw new DataNotFoundException("Your shopping cart is empty.");
            }
            //proceed if session exists
            $cart = $_SESSION['cart'];

            $sql = "SELECT " . $this->tblGame . ".games_id, " . $this->tblGame . ".title, " . $this->tblGame . ".price, " . $this->tblSystem . ".name, " . $this->tblGame . ".publish_year, " . $this->tblGame . ".image " .
                " FROM " . $this->tblGame . "," . $this->tblSystem .
                " WHERE " . 0;

            foreach (array_keys($cart) as $games_id) {
                $sql .= " OR games_id=$games_id";
                $sql .= " AND " . $this->tblGame . ".system_id=" . $this->tblSystem . ".system_id";
            }

            //create an array to store all returned rows
            $rows = array();

            //execute the query
            if ($query = $this->dbConnection->query($sql) === FALSE) {
                throw new DatabaseException("We are sorry, but we can't view your cart at the moment. Please try again later.");
            }
            $query = $this->dbConnection->query($sql);
            //loop through all rows in the returned set
            while ($row = $query->fetch_assoc()) {
                $games_id = $row['games_id'];
                $title = $row['title'];
                $price = $row['price'];
                $image = $row['image'];
                $system_id = $row['name'];
                $publish_year = $row['publish_year'];
                $qty = $cart[$games_id];
                $subtotal = $qty * $price;

                //add rows into an array
                $rows[] = $row;
            }
            return ($rows);
        } catch (DataNotFoundException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem viewing cart.");
            return false;
        }
    }

    public function remove_from_cart()
    {

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        } else {
            $cart = array();
        }


        //retrieve item id
        $games_id = '';
        if (filter_has_var(INPUT_GET, 'games_id')) {
            $games_id = filter_input(INPUT_GET, 'games_id', FILTER_SANITIZE_NUMBER_INT);
        }


        // If game id is empty, it is invalid.
        if (!$games_id) {
            echo "Something went wrong.<br><br>";
        }


        if ($cart[$games_id] > 1) {
            $cart[$games_id] = $cart[$games_id] - 1;
        } else {  // If the number is 1, remove entire item completely
            unset($cart[$games_id]);
        }


        //update the session variable
        $_SESSION['cart'] = $cart;
    }


    //get games
    private function get_games()
    {
        try {
            $sql = "SELECT " . $this->tblGame . ".games_id, " . $this->tblGame . ".title, " . $this->tblGame . ".price, " . $this->tblSystem . ".name, " . $this->tblPublisher . ".publisher, " . $this->tblGame . ".publish_year, " . $this->tblRatings . ".rating, " . $this->tblGame . ".genre, " . $this->tblGame . ".image, " . $this->tblGame . ".description " .
                " FROM " . $this->tblGame . "," . $this->tblSystem . "," . $this->tblRatings . "," . $this->tblPublisher .
                " WHERE " . $this->tblGame . ".rating_id=" . $this->tblRatings . ".rating_id" . " AND " . $this->tblGame . ".publisher_id=" . $this->tblPublisher . ".publisher_id" . " AND " . $this->tblGame . ".system_id=" . $this->tblSystem . ".system_id";


            //execute the query
            $query = $this->dbConnection->query($sql);

            //if query is successful
            if ($query) {

                //create an array and loop through all rows
                $games = array();
                while ($obj = $query->fetch_object()) {
                    $games[$obj->title] = $obj->games_id;
                    $games[$obj->price] = $obj->games_id;
                }
                return $games;
            }
            $errmsg = $this->dbConnection->error();
            throw new DatabaseException($e->getMessage());
        } catch (DatabaseException $e) {
            $error = new GameError();
            $error->display($e->getMesssage());
            return false;
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("An unexpected error has occurred.");
            return false;
        }
    }
}