<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/19/2021
 * File: system_controller.class.php
 * Description:
 */
class SystemController
{
    private $system_model;

    //default constructor
    public function __construct()
    {
        //create an instance of the GameModel class
        $this->system_model = SystemModel::getSystemModel();

        //retrieve query-terms using GET method
        if (isset($_GET['query-terms'])) {
            //retrieve query terms
            $query_terms = trim($_GET['query-terms']);
        }

    }

    //index action that displays all systems
    public function index()
    {
        //retrieve all systems and store them in an array
        $systems = $this->system_model->list_system();

        // details all systems
        $view = new SystemIndex();
        $view->display($systems);
    }

    public function details($system_id)
    {
        $result = '';
        //call the verify_user method of the GameModel object
        $system = $this->system_model->view_system($system_id);

        //details result
        $view = new SystemDetails();
        $view->display($system, $result);
    }

    //view edit form for admin
    public function edit($id)
    {
        try {
            if (!Utilities::is_admin()) {
                throw new Exception();
                return false;
            }
            //retrieve the individual game details
            $system = $this->system_model->view_system($id);


            $view = new EditSystem();
            $view->display($system);

        } catch (Exception $e) {
            $error = new GameError();
            $error->display("Administrator access only.");
            return false;
        }
    }


    //update a system in the database
    public function update($id)
    {
        try {
            if (!Utilities::is_admin()) {
                throw new Exception();
                return false;
            }
            //update the system
            $result = $this->system_model->update_system($id);
            //view system details
            $system = $this->system_model->view_system($id);
            //create instance of SystemDetails View class and display
            $view = new SystemDetails();
            $view->display($system, $result);
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("Administrator access only.");
            return false;
        }
    }

    public function add_form()
    {
        try {
            if (!Utilities::is_admin()) {
                throw new Exception();
                return false;
            }
            $view = new AddSystem();
            $view->display($view);
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("Administrator access only.");
            return false;
        }
    }

    public function add()
    {
        try {
            if (!Utilities::is_admin()) {
                throw new Exception();
                return false;
            }
            $result = $this->system_model->add_system();

            $view = new AddSystemConfirmation();
            $view->display($result);
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("Administrator access only.");
            return false;
        }
    }

    //method for deleting a system in the database (admin only)
    public function delete($system_id)
    {
        try {
            if (!Utilities::is_admin()) {
                throw new Exception();
            }
            $result = $this->system_model->delete_system($system_id);

            $view = new AddGameConfirmation();
            $view->display($result);
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("Administrator access only.");
        }
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
        $systems = $this->system_model->search_systems($query_terms);

        // details all games
        $view = new SearchSystemIndex();
        $view->display($query_terms, $systems);
    }

    //autosuggestion function using AJAX
    public function suggest($terms)
    {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));

        //search all games
        $systems = $this->system_model->search_systems($query_terms);

        //retrieve all game titles and store them in an array
        $titles = array();
        if ($systems) {
            foreach ($systems as $system) {
                $titles[] = $system->getName();
            }
        }

        //details titles
        echo json_encode($titles);
    }

}