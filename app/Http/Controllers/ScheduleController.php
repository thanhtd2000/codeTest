<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Film;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public $films;
    public $rooms;
    public function __construct()
    {
        $this->films = Film::all();
        $this->rooms = Room::all();
    }
    public function index()
    {
        $schedules = Schedule::latest()->paginate(5);
        return view('admin.schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.schedule.create', [
            'films' => $this->films,
            'rooms' => $this->rooms
        ]);
    }
    public function store(Request $request)
    {
        $rule = [
            'date' => 'required',
            'film_id' => 'required',
            'room_id' => 'required',
        ];
        $message = [
            'required' => 'Trường bắt buộc phải nhập',
        ];
        $schedule = $request->validate($rule, $message);
        if (Schedule::where('date', '>=', $schedule['date'])->where('room_id', $schedule['room_id'])->get()) {
            return redirect()->route('schedule.show')->with('message', 'Đã thêm mới không thành công do lịch đã tồn tại');
        } else {
            Schedule::create($schedule);
            return redirect()->route('schedule.show')->with('message', 'Đã thêm mới thành công');
        }
    }

    public function edit(string $id)
    {
        $schedule = Schedule::find($id);
        return view('admin.schedule.edit', [
            'films' => $this->films,
            'rooms' => $this->rooms,
            'schedule' => $schedule
        ]);
    }


    public function update(Request $request)
    {
        $schedule = Schedule::find($request->id);
        $rule = [
            'date' => 'required',
            'film_id' => 'required',
            'room_id' => 'required',
        ];
        $message = [
            'required' => 'Trường bắt buộc phải nhập',
        ];
        $rm = $request->validate($rule, $message);
        $schedule->date = $rm['date'];
        $schedule->film_id = $rm['film_id'];
        $schedule->room_id = $rm['room_id'];
        $schedule->updated_at = Carbon::now();
        $schedule->save();
        return redirect()->route('schedule.show')->with('message', 'Đã Sửa thành công');
    }


    public function destroy(Request $request)
    {
        $Schedule = Schedule::find($request->id);
        $Schedule->delete();
        return redirect()->back()->with('message', 'Xoá thành công');
    }
    
}
