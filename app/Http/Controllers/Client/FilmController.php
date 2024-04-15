<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Part;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    public function Index($path, $phan = null, $tap = null)
    {
        $film = Film::where('path', $path)->get()->first();

        if ($phan != null || $tap != null) :

            $part = Part::where('idFilm', $film->idFilm)->get();
            $part2 = Part::where('idFilm', $film->idFilm)->where('idPart', $phan)->first();

            if (empty(Film::where('path', $path)->count())) :
                return redirect()->back();
            elseif (empty(Part::where('idFilm', $film->idFilm)->where('idPart', $phan)->count())) :
                return back()->with("error","chưa cập nhập phần phim");
            elseif (empty(Video::where('idFilm', $film->idFilm)->where('idVideo', $tap)->where('idPart', $phan)->count())) :
                return back()->with("error","chưa cập nhập tập phim");
            else :

                $video = Video::where('idFilm', $film->idFilm)->where('idVideo', $tap)->where('idPart', $phan)->get();
                $video2 = Video::where('idFilm', $film->idFilm)->where('idPart', $phan)->distinct()->get();

            endif;

        else :

            $part = Part::where('idFilm', $film->idFilm)->get();

            $part2 = Part::where('idFilm', $film->idFilm)->first();

            if (empty(Film::where('path', $path)->count())) :
                return redirect()->back();
            elseif (empty(Part::where('idFilm', $film->idFilm)->count())) :
                return back()->with("error","chưa cập nhập phần phim");
            elseif (empty(Video::where('idFilm', $film->idFilm)->where('idPart', $part2->idPart)->count())) :
                return back()->with("error","chưa cập nhập tập phim");
            else :
                $video = Video::where('idFilm', $film->idFilm)->where('idPart', $part2->idPart)->get();
                $video2 = Video::where('idFilm', $film->idFilm)->where('idPart', $part2->idPart)->distinct()->get();
            endif;

        endif;

        $episode = $tap;

        return view('client.page.film', compact('film', 'part', 'video', 'video2', 'part2', 'episode'));
    }

}
