<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

  
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = collect();
        $page->title    = "Welcome";
        return view('welcome',compact('page'));
    }
}