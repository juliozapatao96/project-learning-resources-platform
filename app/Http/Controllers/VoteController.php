<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie; 

use App\Models\Resource;
use App\Models\Voter;

class VoteController extends Controller
{
    public function __invoke(Request $request, Resource $resource){
        // buscar o crear al votante
        $voterId = $request->cookie('voter_code');
        $voter = Voter::where('code', $voterId)->first();

        if(!$voter){
            $voter = Voter:: create([
                'code' => Str::random(30),
            ]);
            Cookie::queue('voter_code', $voter->code, 60*24*30); // se guarda por un mes
        }
        // toggle del voto
        $resource->votes()->toggle($voter->id); //toggle hace un query donde encuentra la relacion entre resources y voter sea este id. Deshacela y sino agregala

        // devolverle al resource actualizado con su recuento de votos
        return $resource->load('votes', 'category');
    }
}
