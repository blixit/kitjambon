<?php
    class PetitionController extends Controller{

        public $models = array(
            'default'=>'membre', 
            );
        public $params = array(
            'default'=>'',
        );

        function __construct($request){
            $this->request = $request;
            $this->layout = 'default';
        }

        function index(){ 
            $variables = array();
            $this->myrender(array(
                'menu' => 'menu',
                'title' => 'Pétition' ,
                'view' => 'index',
                'variables' => $variables,
            )); 
        }

    } 
    phpinfo();