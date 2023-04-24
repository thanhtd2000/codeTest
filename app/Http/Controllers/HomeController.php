<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Schedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public  function index()
    {
        $films = Film::latest()->paginate(3);
        return view('client.home', compact('films'));
    }

    public function schedule(Request $request)
    {
        $alphabet = range('A', 'Z');
        $schedule =  Schedule::find($request->id);
        $ticket = Ticket::where('schedule_id', $request->id)->get();
        $num_of_elements = $schedule->room->row;
        $elements = array_slice($alphabet, 0, $num_of_elements);
        return view('client.schedule', compact('schedule', 'elements', 'ticket'));
    }
    public function order(Request $request)
    {
        $price = 10000;
        $order['price'] = $price  * count($request->seat_name);
        $order1 = Order::create($order);
        foreach ($request->seat_name as $seat) {
            $ticket['seat_name'] = $seat;
            $ticket['schedule_id'] = $request->schedule_id;
            $ticket['order_cinema_id'] =  $order1->id;
            Ticket::create($ticket);
        }
        return redirect()->back()->with('message', 'Order thành công');
    }
}
