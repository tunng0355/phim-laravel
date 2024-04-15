<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Part;
use App\Models\Video;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cmt;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{

    public function getCmt(Request $request, $idVideo)
    {
        
        if (empty(Video::where('idVideo', $idVideo)->count())) :
            return response()->json(['status' => 'error', 'message' => 'Video không tồn tại'])->withCallback($request->input('callback'));
        else :

            $cmt = Cmt::where('idVideo', $idVideo)->orderBy('id', 'DESC')->get();
            $data = [];
            $i =0;
            foreach($cmt as $comment):
                $data[$i++] = [
                    'name'=>User::find($comment->idUser)->name,
                    'comment'=>$comment->content,
                    'date'=>explode(" ",$comment->updated_at)[0],
                ];
            endforeach;

            return response()->json([
                'status' => 'success', 'message' => 'lấy thông tin bình luận thành công','comment'=>$data])->withCallback($request->input('callback'));
        endif;
    }


    public function getVideo(Request $request, $idFilm)
    {
        $validate = Validator::make($request->all(), [
            'episode' => ['required'],
            'idPart' => ['required'],
        ], [
            'episode.required' => 'Tập phim không được bỏ trống',
            'idPart.required' => 'Phần phim không được bỏ trống',
        ]);

        if ($validate->fails()) :
            return response()->json(['status' => 'error', 'message' => $validate->errors()->first()], 400)->withCallback($request->input('callback'));
        elseif (empty(Film::where('idFilm', $idFilm)->count())) :
            return response()->json(['status' => 'error', 'message' => 'Phim không tồn tại'])->withCallback($request->input('callback'));
        elseif (empty(Part::where('idPart', $request->idPart)->where('idFilm', $idFilm)->count())) :
            return response()->json(['status' => 'error', 'message' => 'Phần phim không tồn tại'])->withCallback($request->input('callback'));
        elseif (empty(Video::where('idFilm', $idFilm)->where('idPart', $request->idPart)->where('idVideo', $request->episode)->count())) :
            return response()->json(['status' => 'error', 'message' => 'Tập phim không tồn tại'])->withCallback($request->input('callback'));
        else :
            Film::where('idFilm', $idFilm)->update([
                'views' => Film::where('idFilm', $idFilm)->first()->views + 1
            ]);
            $video = Video::where('idFilm', $idFilm)->where('idPart', $request->idPart)->where('idVideo', $request->episode)->first();
            return response()->json([
                'status' => 'success', 'message' => [
                    'media' => $video->media,
                    'thumbnail' => $video->thumbnail
                ]

            ])->withCallback($request->input('callback'));
        endif;
    }

    public function sendCmt(Request $request, $idVideo)
    {

        $validate = Validator::make($request->all(), [
            'content' => ['required'],
        ], [
            'content.required' => 'Nội dung không được bỏ trống',
        ]);
        if (!Auth::check()) :
            return response()->json(['status' => 'error', 'message' => 'Bạn chưa đăng nhập'])->withCallback($request->input('callback'));
        elseif ($validate->fails()) :
            return response()->json(['status' => 'error', 'message' => $validate->errors()->first()], 400)->withCallback($request->input('callback'));
        elseif (empty(Video::where('idVideo', $idVideo)->count())) :
            return response()->json(['status' => 'error', 'message' => 'Video không tồn tại'])->withCallback($request->input('callback'));
        else :

            $save = Cmt::create([
                'idUser'    => Auth::user()->id,
                'idVideo' => $request->idVideo,
                'content' => $request->content,
            ]);

            if ($save) {
                return response()->json(['status' => 'success', 'message' => 'Bình luận video thành công','comment'=>[
                    'name'=>Auth::user()->name,
                    'comment'=>$request->content
                ]]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Bình luận video thất bại']);
            }

        endif;
    }

    public function check()
    {
        return Auth::user();
    }
}
