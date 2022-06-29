<?php

namespace Controllers;

class HomeController extends Controller
{
    public function index()
    {
      return view("index")
        ->with(["test" => "Gexec"])
        ->layout("layouts.main");
    }
}