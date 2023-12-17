<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request){
        // esto es un endpoint en Laravel simple que devuelve todas las categorias
        return Category::all();
    }
}
