<?php

namespace Controllers;

use Classes\Request;
use Models\User;

class HomeController extends Controller
{
    public function index () // $name = 'artur', $anotherUsername = 'gago'
    {

        $userModel = new User();

        $users = $userModel->select()
            ->fetch();

        return view('content/about')->with(compact('users'));
    }

    public function test() // /home/test
    {
        dd($_POST);
//        $request = new Request();
//        $request->method(); // POST  or GET
//        $request->has('email'); // true or false
//        $request->email; // 1995.chilingaryan@gmail.com
//        $request->only(['email', 'name']); // ['email' => '1995.chilingaryan@gmail.com', 'name' => 'Artur']
//        $request->uri(); // vordexica ekel
//        $request->isMethod('post'); // true or false
//        $request->all() petqa veradardzni sax filter@
//        $request->except(['credit_card']) // baci sranic sax veradardzru
    }
}