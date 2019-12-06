<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('pages.welcome');
    }

    public function index()
    {
        return view('pages.home');
    }

    public function myPrograms()
    {
        $programs = Program::all();
        return view('pages.novartis',compact('programs'));
    }
}
