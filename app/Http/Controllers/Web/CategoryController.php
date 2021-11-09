<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Http;

class CategoryController extends Controller
{
    
    public function index() {
        return view('categories.index');
    }

}
