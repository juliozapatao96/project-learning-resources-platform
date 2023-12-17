<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Resource;
use App\Models\Category;
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

    public function store(Request $request){
        // dd(Category::first());
        Resource::create([
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
            'category_id' => Category::first()->id,
            'creator_id' => $request->user()->id,
        ]);

        // return to_route('Resources');
    }

    public function search(Request $request){
        // dd($request->all());
        return Resource::where('title', 'like', "%$request->search%")
            ->orWhere('description', 'like', "%$request->search%")
            ->with('category')
            ->get();
    }
}
