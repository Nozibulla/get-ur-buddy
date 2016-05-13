<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WelcomeComtroller extends Controller
{
	public function login()
	{
		return view('auth.login');
	}

    public function welcome()
    {
        return view('welcome');
    }
}
