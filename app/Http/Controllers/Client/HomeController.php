<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Searchable\ModelSearchAspect;
use App\Models\Film;
use Spatie\Searchable\Search;

class HomeController extends Controller
{
    public function Index()
    {
        $film = Film::inRandomOrder()->limit(10)->get();
        $count = $film->count();
        return view('client.page.home', compact('film','count'));
    }

    public function Search(Request $request)
    {

        $searchterm = $request->input('q');

        if (!empty($searchterm)) :
            $film = (new Search())->registerModel(Film::class, function (ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('name') // only return results that exactly match
                    ->addSearchableAttribute('note'); // return results for partial matches
            })->perform($searchterm);
        else :
            $film = false;
        endif;

        return view('client.page.search', compact('film', 'searchterm'));
    }
    
    public function account()
    {
        return view('client.page.account');
    }
    
}
