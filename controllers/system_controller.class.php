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
        //retrieve all games and store them in an array
        $systems = $this->system_model->list_system();

        // details all games
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

}