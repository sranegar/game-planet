<?php

/**
 * Author: Melissa Boyer and Stephanie Ranegar
 * Date: 11/10/2021
 * File: game_model.class.php
 * Description: This script contains the application Model anmed GameModel class
 */
class GameModel
{
    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblGame;
    private $tblRatings;
    private $tblPublisher;
    private $tblTopGames;

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
        $this->tblTopGames = $this->db->getTopGamesTable();

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

    }

    //static method to ensure there is just one GameModel instance
    public static function getGameModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new GameModel();
        }
        return self::$_instance;
    }


    //method for listing all games
    public function list_game()
    {
        try {
            $sql = "SELECT " . $this->tblGame . ".games_id, " . $this->tblGame . ".title, " . $this->tblGame . ".price, " . $this->tblSystem . ".name, " . $this->tblPublisher . ".publisher, " . $this->tblGame . ".publish_year, " . $this->tblRatings . ".rating, " . $this->tblGame . ".genre, " . $this->tblGame . ".image, " . $this->tblGame . ".description " .
                " FROM " . $this->tblGame . "," . $this->tblSystem . "," . $this->tblRatings . "," . $this->tblPublisher .
                " WHERE " . $this->tblGame . ".rating_id=" . $this->tblRatings . ".rating_id" . " AND " . $this->tblGame . ".publisher_id=" . $this->tblPublisher . ".publisher_id" . " AND " . $this->tblGame . ".system_id=" . $this->tblSystem . ".system_id";

//            print_r($sql);
            //execute the query
            $query = $this->dbConnection->query($sql);

            //if query succeeded and games are found
            if ($query && $query->num_rows > 0) {

                //handle the result
                //create an array to store all returned games
                $games = array();

                //loop through all rows in the returned set
                while ($obj = $query->fetch_object()) {
                    $game = new Game(stripslashes($obj->title), stripslashes($obj->price), stripslashes($obj->name), stripslashes($obj->publisher), stripslashes($obj->publish_year), stripslashes($obj->genre), stripslashes($obj->rating), stripslashes($obj->image), stripslashes($obj->description));

                    //set the id for the game
                    $game->setId($obj->games_id);

                    //add the game into the array
                    $games[] = $game;
                }
                return $games;
            }
            throw new DatabaseException("There was a problem connecting to the database.");
        } catch (DatabaseException $e) {
            $error = new GameError();
            $error->display($e->getMesssage());
            return false;
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem listing games.");
            return false;
        }
    }

    public function display_top_games()
    {
        try {
            $sql = "SELECT " . $this->tblTopGames . ".top_games_id, " . $this->tblGame . ".games_id, " . $this->tblGame . ".title, " . $this->tblGame . ".price, " . $this->tblSystem . ".name, " . $this->tblGame . ".publish_year, " .  $this->tblGame . ".image " .
                " FROM " . $this->tblTopGames . "," . $this->tblGame . "," . $this->tblSystem .
                " WHERE " . $this->tblTopGames. ".games_id=" . $this->tblGame . ".games_id" . " AND " . $this->tblGame . ".system_id=" . $this->tblSystem . ".system_id";
            //execute the query
            $query = $this->dbConnection->query($sql);


            //if query succeeded and games are found
            if ($query && $query->num_rows > 0) {

                //handle the result
                //create an array to store all returned games
                $top_games = array();

                //loop through all rows in the returned set
                while ($obj = $query->fetch_object()) {
                    $top_game = new TopGame(stripslashes($obj->games_id), stripslashes($obj->title), stripslashes($obj->price), stripslashes($obj->name), stripslashes($obj->publish_year), stripslashes($obj->image));

                    //set the id for the game
                    $top_game->setId($obj->top_games_id);

                    //add the game into the array
                    $top_games[] = $top_game;
                }
                return $top_games;
            }
            throw new DatabaseException("There was a problem connecting to the database.");
        } catch (DatabaseException $e) {
            $error = new GameError();
            $error->display($e->getMesssage());
            return false;
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem listing games.");
            return false;
        }
    }


    //method for viewing game details
    public function view_game($games_id)
    {
        try {
            //the select sql statement
            $sql = "SELECT " . $this->tblGame . ".games_id, " . $this->tblGame . ".title, " . $this->tblGame . ".price, " . $this->tblSystem . ".name, " . $this->tblPublisher . ".publisher, " . $this->tblGame . ".publish_year, " . $this->tblRatings . ".rating, " . $this->tblGame . ".genre, " . $this->tblGame . ".image, " . $this->tblGame . ".description " .
                " FROM " . $this->tblGame . "," . $this->tblSystem . "," .  $this->tblRatings . "," . $this->tblPublisher .
                " WHERE " . $this->tblGame . ".rating_id=" . $this->tblRatings . ".rating_id" . " AND " . $this->tblGame . ".publisher_id=" . $this->tblPublisher . ".publisher_id"  . " AND " . $this->tblGame . ".system_id=" . $this->tblSystem . ".system_id" . " AND " .  $this->tblGame . ".games_id=" . $games_id;

//            print_r($sql);
            //execute the query
            $query = $this->dbConnection->query($sql);

            if ($query && $query->num_rows > 0) {
                $obj = $query->fetch_object();

                //create a game object
                $game = new Game(stripslashes($obj->title), stripslashes($obj->price), stripslashes($obj->name), stripslashes($obj->publisher), stripslashes($obj->publish_year), stripslashes($obj->genre), stripslashes($obj->rating), stripslashes($obj->image), stripslashes($obj->description));

                //set the id for the game
                $game->setId($obj->games_id);

                return $game;
            }
            throw new DatabaseException("There was a problem connecting to the database.");
        } catch (DatabaseException $e) {
            $error = new GameError();
            $error->display($e->getMesssage());
            return false;
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem viewing game details.");
            return false;
        }
    }

    //search the database for games that match words in titles. Return an array of games if succeeded; false otherwise.
    public function search_games($terms)
    {
        try {
            //explode multiple terms into an array
            $terms = explode(" ", $terms);

            //select statement for AND search
            $sql = "SELECT " . $this->tblGame . ".games_id, " . $this->tblGame . ".title, " . $this->tblGame . ".price, " . $this->tblSystem . ".name, " . $this->tblPublisher . ".publisher, " . $this->tblGame . ".publish_year, " . $this->tblRatings . ".rating, " . $this->tblGame . ".genre, " . $this->tblGame . ".image, " . $this->tblGame . ".description " .
                " FROM " . $this->tblGame . "," . $this->tblSystem . "," . $this->tblRatings . "," . $this->tblPublisher .
                " WHERE " . $this->tblGame . ".rating_id=" . $this->tblRatings . ".rating_id" . " AND " . $this->tblGame . ".publisher_id=" . $this->tblPublisher . ".publisher_id" . " AND " . $this->tblGame . ".system_id=" . $this->tblSystem . ".system_id";


            foreach ($terms as $term) {
                $sql .= " AND games.title LIKE '%" . $term . "%'";
            }

            $query = $this->dbConnection->query($sql);
            //execute the query and return true if successful or false if failed

            if ($query === FALSE) {
                throw new DatabaseException("We are sorry, but we can't search for games at the moment. Please try again later.");
            }

            //search succeeded, and found at least 1 game
            //create an array to store all the returned games
            $games = array();

            //loop through all rows in the returned record sets
            while ($obj = $query->fetch_object()) {
                $game = new Game(stripslashes($obj->title), stripslashes($obj->price), stripslashes($obj->name), stripslashes($obj->publisher), stripslashes($obj->publish_year), stripslashes($obj->genre), stripslashes($obj->rating), stripslashes($obj->image), stripslashes($obj->description));
                //set the id for the movie
                $game->setId($obj->games_id);
                //add game into game array
                $games[] = $game;
            }
            return $games;
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem searching games.");
            return false;
        }
    }

    //method for updating game into the database
    public function update_game($id)
    {
        //retrieve data for the new game; data are sanitized and escaped for security.
        $title = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
        $price = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'price', FILTER_DEFAULT));
        $system = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'system', FILTER_SANITIZE_STRING)));
        $rating = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_STRING)));
        $publish_year = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'publish_year', FILTER_DEFAULT));
        $publisher = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING)));
        $genre = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $description = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));


        try {
            //if any of the fields were left empty
            if (empty($title) || empty($price) || empty($system) || empty($rating) || empty($publish_year) || empty($publisher) || empty($genre) || empty($description)) {
                throw new DataMissingException ("UPDATE FAILED: Values are missing in one or more fields. All fields must be filled.");
            }
            //handle if publish year is not numeric
            if (!is_numeric($publish_year) || strlen($publish_year) < 4 || strlen($publish_year) > 4) {
                throw new DataFormatException("UPDATE FAILED: Publish year must be a four year integer.");
            }

            //query string for update
            $sql = "UPDATE " . $this->tblGame .
                " SET title='$title', price='$price', system_id='$system', publisher_id='$publisher', publish_year='$publish_year', genre='$genre', rating_id='$rating', image='$image', description='$description' "
                . "WHERE games_id=" . $id;

            //execute the query and return true if successful or false if failed
            if ($this->dbConnection->query($sql) === FALSE) {
                throw new DatabaseException("We are sorry, but we can't update your game at the moment. Please try again later.");
            }
            return "Your game has successfully been updated.";
        } catch (DataFormatException $e) {
            return $e->getMessage();
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem updating the game.");
            return false;
        }
    }


    public function add_game()
    {
        //retrieve data for the new game; data are sanitized and escaped for security.
        $title = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
        $price = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'price', FILTER_DEFAULT));
        $system = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)));
        $rating = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'rating_id', FILTER_SANITIZE_STRING)));
        $publish_year = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'publish_year', FILTER_DEFAULT));
        $publisher = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'publisher_id', FILTER_SANITIZE_STRING)));
        $genre = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $description = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));

        try {
            //handle if any of hte fields were left empty
            if (empty($title) || empty($price) || empty($system) || empty($rating) || empty($publish_year) || empty($publisher) || empty($genre) || empty($image) || empty($description)) {
                throw new DataMissingException ("Values are missing in one or more fields. All fields must be filled.");
            }

            //handle if publish year was not numeric
            if (!is_numeric($publish_year) || strlen($publish_year) < 4 || strlen($publish_year) > 4) {
                throw new DataFormatException("Publish year must be a four year integer.");
            }

            //query string for update
            $sql = "INSERT INTO $this->tblGame VALUES (NULL, '$title', '$price', '$system', '$publisher', '$publish_year', '$genre', '$rating', '$image', '$description')";


            //execute the query and return true if successful or false if failed
            if ($this->dbConnection->query($sql) === FALSE) {
                throw new DatabaseException("We are sorry, but we can't add your game at the moment. Please try again later.");
            }
            return "Your game has successfully been added.";
        } catch (DataFormatException $e) {
            return $e->getMessage();
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem adding the game.");
            return false;
        }
    }

    public function add_to_cart($games_id) {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        } else {
            $cart = array();
        }

        if (filter_has_var(INPUT_GET, 'games_id')) {
            $games_id = filter_input(INPUT_GET, 'games_id'); //define variable for id input
            $games_id = json_encode($games_id);
        }


        if (!$games_id) {
            $error = new GameError();
            $error->display('Invalid game id detected. Operation cannot proceed.');
        }

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        } else {
            $cart = array();
        }

        if (array_key_exists($games_id, $cart)) {
            $cart[$games_id] = $cart[$games_id] + 1;
        } else {
            $cart[$games_id] = 1;
        }

        //update the session variable
        $_SESSION['cart'] = $cart;
    }
}
