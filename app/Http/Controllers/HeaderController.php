<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Models\Header;
class HeaderController extends Controller
{
    public function index(){
       
        
            $headers = Header::get();

            return Inertia::render('Content/Content', compact('headers'));
     
    }
}
