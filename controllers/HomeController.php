<?php

class HomeController extends Controller{

    public function execute()
    {
        ViewController::summon('home');
    }

    public function dashboard()
    {
        ViewController::summon('home.dashboard');
    }
}