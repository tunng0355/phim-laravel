<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Part;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class FilmController extends Controller
{
    public function video(Request $request)
    {

        $ispage = empty($request->currentpage) ? 1 : $request->currentpage;

        Paginator::currentPageResolver(function () use ($ispage) {
            return $ispage;
        });

        $list = video::paginate(5);
        $count = video::all()->count();
        $page = $list->lastPage();

        return view('admin.page.video', compact('list', 'count', 'page', 'ispage'));

    }

    public function edit_video(Request $request, $idVideo)
    {
        $check = Video::where('idVideo', $idVideo)->count();

        if (empty($check)):
            return redirect()->back();
        endif;

        $video = Video::where('idVideo', $idVideo)->first();

        return view('admin.page.edit-video', compact('video'));

    }

    public function upload()
    {
        return view('admin.page.upload');
    }

    public function edit_danh_sach_phim(Request $request, $idFilm)
    {
        $check = Film::where('idFilm', $idFilm)->count();

        if (empty($check)):
            return redirect()->route('admin.danh_sach_phim');
        endif;

        $film = Film::where('idFilm', $idFilm)->first();

        return view('admin.page.edit-film', compact('film'));

    }

    public function danh_sach_phim(Request $request)
    {

        $ispage = empty($request->currentpage) ? 1 : $request->currentpage;

        Paginator::currentPageResolver(function () use ($ispage) {
            return $ispage;
        });

        $list = Film::paginate(5);
        $count = Film::all()->count();
        $page = $list->lastPage();

        return view('admin.page.film', compact('list', 'count', 'page', 'ispage'));
    }

    public function phan_phim(Request $request, $idFilm)
    {

        $check = Film::where('idFilm', $idFilm)->count();

        $ispage = empty($request->currentpage) ? 1 : $request->currentpage;

        Paginator::currentPageResolver(function () use ($ispage) {
            return $ispage;
        });

        if (empty($check)):
            return redirect()->route('admin.danh_sach_phim');
        endif;

        $list = Part::where('idFilm', $idFilm)->paginate(10);
        $count = Part::where('idFilm', $idFilm)->count();
        $page = $list->lastPage();

        $film = Film::where('idFilm', $idFilm)->first();

        return view('admin.page.part', compact('list', 'count', 'page', 'ispage', 'film'));
    }

    public function edit_phan_phim(Request $request, $idFilm, $idPart)
    {
        $check = Film::where('idFilm', $idFilm)->count();
        $check2 = Part::where('idFilm', $idFilm)->where('idPart', $idPart)->count();

        if (empty($check)):
            return redirect()->back();
        elseif (empty($check)):
            return redirect()->back();
        endif;

        $part = Part::where('idFilm', $idFilm)->where('idPart', $idPart)->first();

        return view('admin.page.edit-part', compact('part'));

    }


    public function them_phim(Request $request, $idFilm, $idPart)
    {
        $check = Film::where('idFilm', $idFilm)->count();
        $check2 = Part::where('idFilm', $idFilm)->where('idPart', $idPart)->count();

        if (empty($check)):
            return redirect()->back();
        elseif (empty($check)):
            return redirect()->back();
        endif;

        $part = Part::where('idFilm', $idFilm)->where('idPart', $idPart)->first();

        return view('admin.page.edit-part', compact('part'));

    }
}
