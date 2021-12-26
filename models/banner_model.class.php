<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/26/2021
 * File: banner_model.class.php
 * Description:
 */
class BannerModel
{
    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblBanner;


    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getGameModel method must be called.
    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblBanner = $this->db->getBannerTable();


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

    public static function getBannerModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new BannerModel();
        }
        return self::$_instance;
    }


    public function make_slide_indicators()
    {
        $sql = "SELECT * FROM banner ORDER BY banner_id ASC";


        //execute the query
        $query = $this->dbConnection->query($sql);


        if (!$query) {
            $message = "Something went wrong!";
            $error = new GameError();
            $error->display($message);
        }

        //if query succeeded and games are found
        $output = '';
        $count = 0;

        //loop through all rows in the returned set
        while ($row = $query->fetch_array()) {
            if ($count == 0) {
                $output .= "<li data-target='#dynamic_slide_show' data-slide-to='" . $count . "' class='active'></li>";

            } else {
                $output .= "<li data-target='#dynamic_slide_show' data-slide-to='" . $count . "'></li>";
            }
            $count = $count + 1;
        }
        echo $output;


    }

    public function make_slides()
    {
        $output = '';
        $count = 0;

        $sql = "SELECT * FROM banner ORDER BY banner_id ASC";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query) {
            $message = "Something went wrong!";
            $error = new GameError();
            $error->display($message);
        }

        while($row = $query->fetch_array())
        {
            if ($count == 0)
            {
                $output .= '<div class="item active" data-interval="20000">';
            }
            else
            {
                $output .= '<div class="item">';
            }
            $output .= "<img src='" . BASE_URL . "/www/img/" . $row['image'] . "' alt='" . $row['banner_title'] . "'/><div class='carousel-caption'></div></div>";

            $count = $count + 1;
        }
        echo $output;
    }

}