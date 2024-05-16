<?php

class HomeController extends Controller{

    public function execute()
    {
        ViewController::summon('home');
    }

    public function admin()
    {
        ViewController::summon('admin/home');
    }
    
}