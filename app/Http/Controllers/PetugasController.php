<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetugasController extends Controller
{
    function index()
    {
        return view('petugas.dashboard');
    }
}
