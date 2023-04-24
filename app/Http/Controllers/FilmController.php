<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public  $films;
    public function __construct()
    {
        $this->films = Film::latest()->paginate(5);
    }
    public function index()
    {
        return view('admin.film.index', ['films' =>  $this->films]);
    }
    public function create()
    {
        return view('admin.film.create');
    }
    public function store(Request $request)
    {
        $rule = [
            'name' => 'required',
            'type' => 'required',
            'director' => 'required',
            'actor' => 'required',
            'year' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ];
        $message = [
            'required' => 'Trường bắt buộc phải nhập',
        ];
        $film = $request->validate($rule, $message);
        if ($request->hasFile('image')) {
            $file = $request->image;
            $fileExtension = $file->getClientOriginalExtension();
            $fileName =  Str::random(10) . "." . $fileExtension;
            $file->move("uploads/film", $fileName);
        }
        $film['image'] = "uploads/film/" . $fileName;
        Film::create($film);
        return redirect()->route('film.show')->with('message', 'Đã thêm mới thành công');
    }
    public function delete(Request $request)
    {
        $film = Film::find($request->id);
        $film->delete();
        return redirect()->back()->with('message', 'Xoá thành công');
    }
    public function edit(Request $request)
    {
        $film = Film::find($request->id);
        return view('admin.film.edit', compact('film'));
    }
    public function update(Request $request)
    {
        $rule = [
            'id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'director' => 'required',
            'actor' => 'required',
            'year' => 'required',
        ];
        $message = [
            'required' => 'Trường bắt buộc phải nhập',
        ];
        $film = $request->validate($rule, $message);
        $fm = Film::find($film['id']);
        if ($request->hasFile('image')) {
            $file = $request->image;
            $fileExtension = $file->getClientOriginalExtension();
            $fileName =  Str::random(10) . "." . $fileExtension;
            $file->move("uploads/film", $fileName);
            $fm->image = "uploads/film/" . $fileName;
        }
        $fm->name = $film['name'];
        $fm->type = $film['type'];
        $fm->director = $film['director'];
        $fm->actor = $film['actor'];
        $fm->year = $film['year'];
        $fm->save();
        return redirect()->route('film.show')->with('message', 'Đã sửa thành công');
    }
}
