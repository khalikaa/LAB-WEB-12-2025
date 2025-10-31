<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller{
    function home(){
        return view("home");    
    }

    function destinasi(){
        return view("destinasi");
    }

    function kuliner(){
        return view("kuliner");  
    }

    function galeri(){
        return view("galeri");
    }

    function kontak(){
        return view("kontak");  
    }
}
