<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Resource;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class ResourceController extends Controller
{
    public function index(Request $request){
        return Inertia::render('Resources', [ // Busca la vista de Inertia Resources para renderizarlo
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'resources' => Resource::with('category')->get(), // realiza una consulta Eloquent para obtener todos los recursos con sus relaciones de categoría cargadas.
        ]);
    }
}
