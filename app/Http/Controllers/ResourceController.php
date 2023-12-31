<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Resource;
use App\Models\Category;
use App\Models\Voter;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class ResourceController extends Controller
{
    public function index(Request $request){

        return Inertia::render('Resources', [ // Busca la vista de Inertia Resources para renderizarlo
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'resources' => Resource::with('category', 'votes')->latest()->get(), // realiza una consulta Eloquent para obtener todos los recursos con sus relaciones de categoría cargadas.
            'categories' => Category::all(),
            'voterId' => Voter::getOrCreateVoter($request)->code,
        ]);
    }

    public function store(Request $request){
        // dd(Category::first());
        // dd($request->all());
        Resource::create([
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
            // 'category_id' => Category::first()->id,
            'category_id' => $request->category_id,
            'creator_id' => $request->user()->id,
        ]);

        // return to_route('Resources');
    }

    public function search(Request $request){
        // dd($request->all());
        return Resource::query()
            ->when(!empty($request->search), function ($query) use ($request){
                return $query->where('title', 'like', "%$request->search%")
                ->orWhere('description', 'like', "%$request->search%");
            })
            ->when(!empty($request->category), function ($query) use ($request){
                return $query->where('category_id', $request->category);
            })
            ->with('category', 'votes')
            ->get();
    }
}
