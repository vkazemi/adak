<?php

class Main extends Controller{ 

    public function __construct()
    {
       
    }

    public function index(){
        // if(isLoggedIn()){
        //     redirect('main');
        // }

        $data = [

        ];


        $this->view('main/index', $data);
    }

}

?>