<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\QrCode;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    public function done_order($id)
    {
        $order = Order::find($id);
        $order->delivery_status = "done";
        $order->save();

        return redirect()->back();
    }

    public function all_shipper_orders($id)
    {
        $orders = Order::where('shipper_id', $id)->get();
        return view('shipper.all_shipper_orders', compact('orders', 'qrCode'));
    }
}
