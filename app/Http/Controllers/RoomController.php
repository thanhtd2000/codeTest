<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{


    public function index()
    {
        $rooms = Room::latest()->paginate(5);
        return view('admin.room.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.room.create');
    }
    public function store(Request $request)
    {
        $rule = [
            'name' => 'required',
            'row' => 'required',
            'seat_number' => 'required',
        ];
        $message = [
            'required' => 'Trường bắt buộc phải nhập',
        ];
        $room = $request->validate($rule, $message);
        Room::create($room);
        return redirect()->route('room.show')->with('message', 'Đã thêm mới thành công');
    }

    public function edit(string $id)
    {
        $room = Room::find($id);
        return view('admin.room.edit', compact('room'));
    }


    public function update(Request $request)
    {
        $room = Room::find($request->id);
        $rule = [
            'name' => 'required',
            'row' => 'required',
            'seat_number' => 'required',
        ];
        $message = [
            'required' => 'Trường bắt buộc phải nhập',
        ];
        $rm = $request->validate($rule, $message);
        $room->name = $rm['name'];
        $room->row = $rm['row'];
        $room->seat_number = $rm['seat_number'];
        $room->save();
        return redirect()->route('room.show')->with('message', 'Đã Sửa thành công');
    }


    public function destroy(Request $request)
    {
        $room = Room::find($request->id);
        $room->delete();
        return redirect()->back()->with('message', 'Xoá thành công');
    }
}
