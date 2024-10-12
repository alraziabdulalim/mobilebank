<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view("home/index");
    }

    public function login()
    {
        return view("home/login");
    }

    public function register()
    {
        return view("home/register");
    }
}