<?php

namespace App\Http\Controllers\Api;

use App\Models\Hobbie;
use App\Http\Controllers\Controller;

class HobbyistsController extends Controller
{
    public function __invoke(Hobbie $hobbie)
    {
        $hobbie->load('customers');
        return response()->json($hobbie->customers->pluck('name'));
    }
}
