<?php

class HomeController extends Controller{

    public function execute()
    {
        ViewController::summon('home');
    }
    
}