<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie; 

class Voter extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
    ];

    public function resources(){
        return $this->belongsToMany(Resource::class, 'votes');
    }

    public static function getOrCreateVoter(Request $request){
        // buscar o crear al votante
        $voterId = $request->cookie('voter_code');
        $voter = Voter::where('code', $voterId)->first();

        if(!$voter){
            $voter = Voter:: create([
                'code' => Str::random(30),
            ]);
            Cookie::queue('voter_code', $voter->code, 60*24*30); // se guarda por un mes
        }

        return $voter;
    }
}
