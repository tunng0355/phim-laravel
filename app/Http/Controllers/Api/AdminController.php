<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Part;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function add_video(Request $request)
    {

        if (!$request->isMethod("POST")) :
            return response()->json(['status' => 'error', 'message' => 'Phương thức truy cập không hơp lệ'])->withCallback($request->input('callback'));
        endif;

        $validate = Validator::make($request->all(), [
            'idFilm' => ['required'],
            'idPart' => ['required'],
            'thumbnail' => ['required'],
            'thumbnail' => ['required', 'file', 'mimetypes:image/jpeg,image/png'],
            'media' => ['required', 'file', 'mimetypes:video/mp4'],
            'episode' => ['required'],
        ], [
            'idFilm.required' => 'Phim không được bỏ trống',           
            'idPart.required' => 'Phần phim không được bỏ trống',
            'thumbnail.required' => 'Thumbnail không được bỏ trống',
            'thumbnail.file' => 'Thumbnail không hợp lệ',
            'thumbnail.mimetypes' => 'Thumbnail không hợp lệ',
            'media.required' => 'Video không được bỏ trống',
            'media.file' => 'Video không hợp lệ',
            'media.mimetypes' => 'Video không hợp lệ',
            'episode.required' => 'Tập phim không được bỏ trống',
        ]);

        $film = Film::where('idFilm', $request->idFilm)->count();

        $part = Part::where('idPart', $request->idPart)->count();
        if (empty($part)) :
            $part = false;
        else :
            $part = true;
            $_part = $request->idPart;
        endif;

        if ($validate->fails()) :
            return response()->json(['status' => 'error', 'message' => $validate->errors()->first()], 400)->withCallback($request->input('callback'));
        elseif (empty($film)) :
            return response()->json(['status' => 'error', 'message' => "Phim không tồn tại"], 200)->withCallback($request->input('callback'));
        elseif (!$part) :
            return response()->json(['status' => 'error', 'message' => "Phần phim không tồn tại"], 200)->withCallback($request->input('callback'));
        else :

            $fileName = $request->file('media')->getClientOriginalName();
            $fileName2 = $request->file('thumbnail')->getClientOriginalName();

            $filePath = 'videos/' . date('d', time()) . '/' . date('m', time()) . '/' . date('Y', time());
            $filePath2 = 'images/' . date('d', time()) . '/' . date('m', time()) . '/' . date('Y', time());

            $url = $request->file('media')->move($filePath, time() . $fileName);
            $url2 = $request->file('thumbnail')->move($filePath2, time() . $fileName2);

            $save = Video::create([
                'idFilm' => $request->idFilm,
                'idPart' => $_part,
                'thumbnail' => $url2,
                'media' => $url,
                'episode' => $request->episode,
            ]);

            if ($save) :
                return response()->json(['status' => 'success', 'message' => "Thêm video thành công"], 200)->withCallback($request->input('callback'));
            else :
                return response()->json(['status' => 'error', 'message' => "Thêm video thất bại"], 400)->withCallback($request->input('callback'));
            endif;

        endif;
    }

    public function delete_video(Request $request, $idVideo)
    {
        $check = Video::where('idVideo', $idVideo)->count();

        if (empty($check)) :
            return redirect()->back();
        elseif (Video::where('idVideo', $idVideo)->delete()) :
            return redirect()->back();
        else :
            return redirect()->back();
        endif;
    }

    public function edit_video(Request $request, $idVideo)
    {
        $check = Video::where('idVideo', $idVideo)->count();

        if (empty($check)) :
            return redirect()->back();
        elseif (!$request->isMethod("POST")) :
            return response()->json(['status' => 'error', 'message' => 'Phương thức truy cập không hơp lệ'])->withCallback($request->input('callback'));
        endif;

        $validate = Validator::make($request->all(), [
            'idFilm' => ['required'],
            'episode' => ['required'],
            'idPart' => ['required'],
        ], [
            'idFilm.required' => 'Phim không được bỏ trống',
            'episode.required' => 'Tập phim không được bỏ trống',
            'idPart.required' => 'Phần phim không được bỏ trống',
        ]);

        $film = Film::where('idFilm', $request->idFilm)->count();


        $part = Part::where('idPart', $request->idPart)->count();
        if (empty($part)) :
            $part = false;
        else :
            $part = true;
            $_part = $request->idPart;
        endif;

        if ($validate->fails()) :
            return response()->json(['status' => 'error', 'message' => $validate->errors()->first()], 400)->withCallback($request->input('callback'));
        elseif (empty($film)) :
            return response()->json(['status' => 'error', 'message' => "Phim không tồn tại"], 200)->withCallback($request->input('callback'));
        elseif (!$part) :
            return response()->json(['status' => 'error', 'message' => "Phần phim không tồn tại"], 200)->withCallback($request->input('callback'));
        else :

            $save = Video::where('idVideo', $idVideo)->update([
                'idFilm' => $request->idFilm,
                'idPart' => $request->idPart,
                'episode' => $request->episode,
            ]);

            if ($save) :
                return response()->json(['status' => 'success', 'message' => "Cập nhập video thành công"], 200)->withCallback($request->input('callback'));
            else :
                return response()->json(['status' => 'error', 'message' => "Cập nhập video thất bại"], 400)->withCallback($request->input('callback'));
            endif;

        endif;
    }

    public function create_album(Request $request)
    {

        if (!$request->isMethod("POST")) :
            return response()->json(['status' => 'error', 'message' => 'Phương thức truy cập không hơp lệ'])->withCallback($request->input('callback'));
        endif;

        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'poster' => ['required'],
            'note' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category' => ['required', 'string'],
            'path' => ['required', 'string'],
        ], [
            'name.required' => 'Tên phim không được bỏ trống',
            'name.string' => 'Tên phim không hợp lệ',
            'poster.required' => 'Poster không được bỏ trống',
            'note.required' => 'Nội dung ngắn không được bỏ trống',
            'note.string' => 'Nội dung ngắn không hợp lệ',
            'content.required' => 'Cốt truyện không được bỏ trống',
            'content.string' => 'Cốt truyện không hợp lệ',
            'category.required' => 'Thể loại không được bỏ trống',
            'category.string' => 'Thể loại không hợp lệ',
        ]);

        if ($validate->fails()) :
            return response()->json(['status' => 'error', 'message' => $validate->errors()->first()], 400)->withCallback($request->input('callback'));
        else :

            $save = Film::create([
                'name' => $request->name,
                'poster' => $request->poster,
                'note' => $request->note,
                'content' => $request->content,
                'category' => $request->category,
                'path' => $request->path,
            ]);

            if ($save) :
                return response()->json(['status' => 'success', 'message' => "Thêm phim thành công"], 200)->withCallback($request->input('callback'));
            else :
                return response()->json(['status' => 'error', 'message' => "Thêm phim thất bại"], 400)->withCallback($request->input('callback'));
            endif;

        endif;
    }

    public function delete_album($idFilm)
    {

        $check = Film::where('idFilm', $idFilm)->count();

        if (empty($check)) :
            return redirect()->route('admin.danh_sach_phim');
        elseif (Film::where('idFilm', $idFilm)->delete()) :
            return redirect()->route('admin.danh_sach_phim');
        else :
            return redirect()->route('admin.danh_sach_phim');
        endif;
    }

    public function edit_album(Request $request, $idFilm)
    {

        $check = Film::where('idFilm', $idFilm)->count();

        if (!$request->isMethod("POST")) :
            return response()->json(['status' => 'error', 'message' => 'Phương thức truy cập không hơp lệ'], 400)->withCallback($request->input('callback'));
        elseif (empty($check)) :
            return response()->json(['status' => 'error', 'message' => 'Phim không tồn tại'], 400)->withCallback($request->input('callback'));
        endif;

        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'poster' => ['required'],
            'note' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category' => ['required', 'string'],
            'path' => ['required', 'string'],
        ], [
            'name.required' => 'Tên phim không được bỏ trống',
            'name.string' => 'Tên phim không hợp lệ',
            'poster.required' => 'Poster không được bỏ trống',
            'note.required' => 'Nội dung ngắn không được bỏ trống',
            'note.string' => 'Nội dung ngắn không hợp lệ',
            'content.required' => 'Cốt truyện không được bỏ trống',
            'content.string' => 'Cốt truyện không hợp lệ',
            'category.required' => 'Thể loại không được bỏ trống',
            'category.string' => 'Thể loại không hợp lệ',
        ]);

        if ($validate->fails()) :
            return response()->json(['status' => 'error', 'message' => $validate->errors()->first()], 400)->withCallback($request->input('callback'));
        else :

            $save = Film::where('idFilm', $idFilm)->update([
                'name' => $request->name,
                'poster' => $request->poster,
                'note' => $request->note,
                'content' => $request->content,
                'category' => $request->category,
                'path' => $request->path,
            ]);

            if ($save) :
                return response()->json(['status' => 'success', 'message' => "Cập nhập phim thành công"], 200)->withCallback($request->input('callback'));
            else :
                return response()->json(['status' => 'error', 'message' => "Cập nhập phim thất bại"], 400)->withCallback($request->input('callback'));
            endif;

        endif;
    }

    public function create_part(Request $request, $idFilm)
    {

        $check = Film::where('idFilm', $idFilm)->count();

        if (!$request->isMethod("POST")) :
            return response()->json(['status' => 'error', 'message' => 'Phương thức truy cập không hơp lệ'], 400)->withCallback($request->input('callback'));
        elseif (empty($check)) :
            return response()->json(['status' => 'error', 'message' => 'Phim không tồn tại'], 400)->withCallback($request->input('callback'));
        endif;

        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ], [
            'name.required' => 'Tên phần không được bỏ trống',
            'name.string' => 'Tên phần không hợp lệ',
        ]);

        if ($validate->fails()) :
            return response()->json(['status' => 'error', 'message' => $validate->errors()->first()], 400)->withCallback($request->input('callback'));
        else :

            $save = Part::create([
                'idFilm' => $idFilm,
                'name' => $request->name,
            ]);

            if ($save) :
                return response()->json(['status' => 'success', 'message' => "Thêm phần phim thành công"], 200)->withCallback($request->input('callback'));
            else :
                return response()->json(['status' => 'error', 'message' => "Thêm phần phim thất bại"], 400)->withCallback($request->input('callback'));
            endif;

        endif;
    }

    public function delete_part($idFilm, $idPart)
    {

        $check = Film::where('idFilm', $idFilm)->count();
        $check2 = Part::where('idFilm', $idFilm)->where('idPart', $idPart)->count();

        if (empty($check)) :
            return redirect()->back();
        elseif (empty($check2)) :
            return redirect()->back();
        elseif (Part::where('idFilm', $idFilm)->where('idPart', $idPart)->delete()) :
            return redirect()->back();
        else :
            return redirect()->back();
        endif;
    }

    public function list_part(Request $request, $idFilm)
    {

        $check = Film::where('idFilm', $idFilm)->count();
        if (empty($check)) :
            return '<option disabled hidden readonly selected>Không tìm thấy phần phim</option>';
        else :
            $Part = Part::all()->where('idFilm', $idFilm);
            foreach ($Part as $list) :
                echo '<option value="' . $list->idPart . '">' . $list->name . '</option>';
            endforeach;
        endif;
    }

    public function edit_part(Request $request, $idFilm, $idPart)
    {

        $check = Film::where('idFilm', $idFilm)->count();
        $check2 = Part::where('idFilm', $idFilm)->where('idPart', $idPart)->count();

        if (!$request->isMethod("POST")) :
            return response()->json(['status' => 'error', 'message' => 'Phương thức truy cập không hơp lệ'], 400)->withCallback($request->input('callback'));
        elseif (empty($check)) :
            return response()->json(['status' => 'error', 'message' => 'Phim không tồn tại'], 400)->withCallback($request->input('callback'));
        elseif (empty($check2)) :
            return response()->json(['status' => 'error', 'message' => 'Phần không tồn tại'], 400)->withCallback($request->input('callback'));
        endif;

        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ], [
            'name.required' => 'Tên phần không được bỏ trống',
            'name.string' => 'Tên phần không hợp lệ',
        ]);

        if ($validate->fails()) :
            return response()->json(['status' => 'error', 'message' => $validate->errors()->first()], 400)->withCallback($request->input('callback'));
        else :

            $save = Part::where('idFilm', $idFilm)->where('idPart', $idPart)->update([
                'name' => $request->name,
            ]);

            if ($save) :
                return response()->json(['status' => 'success', 'message' => "Cập nhập phần phim thành công"], 200)->withCallback($request->input('callback'));
            else :
                return response()->json(['status' => 'error', 'message' => "Cập nhập phần phim thất bại"], 400)->withCallback($request->input('callback'));
            endif;

        endif;
    }
}
