<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Pest\ArchPresets\Custom;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
            'customer_id' => 'required|string',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'status' => 'required|string'
        ]);
        
        Order::create($request->all());

        return response()->json(['message' => 'Data telah berhasil ditambahkan'], 201);
    }

    public function show($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($order, 200);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'order_id' => 'required|string',
            'customer_id' => 'required|string',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'status' => 'required|string'
        ]);


        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $order->update($request->all());

        return response()->json(['message' => 'Data telah berhasil diupdate']);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Data telah berhasil dihapus']);
    }
}