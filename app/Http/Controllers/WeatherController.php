<?php

namespace App\Http\Controllers;

class WeatherController extends Controller
{
    // private $getTweetNum;

    // public function __construct()
    // {
    //     $this->getTweetNum = 10; //初期値。変わる可能性がある
    // }

    public function index(Type $var = null)
    {
        return view('weather.index');
    }

    // public function axiosIndex()
    // {
    //     return view('weather.axios-index');
    // }
}
