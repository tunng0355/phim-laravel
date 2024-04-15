<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Film;


class HomeController extends Controller
{
    public function Index()
    {
        $film = Film::inRandomOrder()->limit(10)->get();
        $count = $film->count();
        return view('admin.page.home', compact('film','count'));
    }

    
}
