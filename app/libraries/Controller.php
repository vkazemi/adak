<?php
/*
 *Base controller
 *This loads the models and views
 */

 class Controller {

    //load model
    public function model($model){

        // Require model file
        require_once '../app/models/'. $model. '.php';

        // Instantiate model
        return new $model();

    }

    //load view
    public function view($view, $data = []){

        if(file_exists('../app/views/'. $view. '.php')){
            // Require view file
            require_once '../app/views/'. $view. '.php';
        }
        else{
            //View dosnt exist
            die('View dose not exist!');
        }

    }

 }
?>