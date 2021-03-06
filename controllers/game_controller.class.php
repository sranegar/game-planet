<?php

/**
 * Author: Stephanie Ranegar
 * Date: 11/10/2021
 * File: game_controller.class.php
 * Description:  This file defines a class named GameController. It defines a method for all application logic and organization.
 */
class GameController
{
    private $game_model;

    //default constructor
    public function __construct()
    {
        //create an instance of the GameModel class
        $this->game_model = GameModel::getGameModel();

        //retrieve query-terms using GET method
        if (isset($_GET['query-terms'])) {
            //retrieve query terms
            $query_terms = trim($_GET['query-terms']);
        }

    }

    //index action that displays all games
    public function index()
    {
        //retrieve all games and store them in an array
        $games = $this->game_model->list_game();

        // details all games
        $view = new GameIndex();
        $view->display($games);
    }

    public function filter() {
        $games = $this->game_model->list_by_system();
        $view = new FilterGames();
        $view->display($games);
    }

    //handle an error
    public function error()
    {
        $message = "";
        //create an object of the Error class
        $error = new GameError();
        //details the error page
        $error->display($message);
    }

    //search games
    public function search()
    {
        //retrieve query-terms using GET method
        if (isset($_GET['query-terms'])) {
            //retrieve query terms
            $query_terms = trim($_GET['query-terms']);
        }

        //search all games
        $games = $this->game_model->search_games($query_terms);

        // details all games
        $view = new SearchIndex();
        $view->display($query_terms, $games);
    }

    //autosuggestion function using AJAX
    public function suggest($terms)
    {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));

        //search all games
        $games = $this->game_model->search_games($query_terms);

        //retrieve all game titles and store them in an array
        $titles = array();
        if ($games) {
            foreach ($games as $game) {
                $titles[] = $game->getTitle();
            }
        }

        //details titles
        echo json_encode($titles);
    }

    public function details($games_id)
    {
        $result = '';
        //call the verify_user method of the GameModel object
        $game = $this->game_model->view_game($games_id);

        //details result
        $view = new GameDetails();
        $view->display($game, $result);
    }

    public function edit($id)
    {
        try {
            if (!Utilities::is_admin()) {
                throw new Exception();
            }
            //retrieve the individual game details
            $game = $this->game_model->view_game($id);


            $view = new EditGame();
            $view->display($game);

        } catch (Exception $e) {
            $error = new GameError();
            $error->display("Administrator access only.");
        }
    }

    //method to update a game in the database (admin only)
    public function update($id)
    {
        try {
            if (!Utilities::is_admin()) {
                throw new Exception();
            }
            //update the game
            $result = $this->game_model->update_game($id);
            //view game details
            $game = $this->game_model->view_game($id);
            //create instance of GameDetails View class and display
            $view = new GameDetails();
            $view->display($game, $result);
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("Administrator access only.");
        }
    }

    //method to display add form for adding a game to the database
    public function add_form()
    {
        try {
            if (!Utilities::is_admin()) {
                throw new Exception();
            }
            $view = new AddGame();
            $view->display($view);
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("Administrator access only.");
        }
    }

    //method for adding a game in the database (admin only)
    public function add()
    {
        try {
            if (!Utilities::is_admin()) {
                throw new Exception();
            }
            $result = $this->game_model->add_game();

            $view = new AddGameConfirmation();
            $view->display($result);
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("Administrator access only.");
        }
    }

    //method for deleting a game in the database (admin only)
    public function delete($games_id)
    {
        try {
            if (!Utilities::is_admin()) {
                throw new Exception();
            }
            $result = $this->game_model->delete_game($games_id);

            $view = new AddGameConfirmation();
            $view->display($result);
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("Administrator access only.");
        }
    }

    //method for adding a game to the shopping cart
    public function buy($id)
    {
        //add game to cart
        $this->game_model->add_to_cart($id);
    }
}