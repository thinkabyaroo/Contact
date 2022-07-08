<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class LanguageController extends Controller
{
    public function change($locale){
        \Illuminate\Support\Facades\Session::put("locale","$locale");
        return redirect()->back();
    }
}
