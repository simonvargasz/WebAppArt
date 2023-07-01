<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['login']);
    }

    public function index(){
        return view('session');
    }

    public function login(){
        return view('user.login');
    }
}