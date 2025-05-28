<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Pest\ArchPresets\Custom;

class OrderItemController extends Controller
{
    public function index()
    {
        return response()->json(OrderItem::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
            'order_id' => 'required|string',
            'product_id' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|integer'
        ]);
        
        OrderItem::create($request->all());

        return response()->json(['message' => 'Data telah berhasil ditambahkan'], 201);
    }

    public function show($id)
    {
        $orderitem = OrderItem::find($id);
        if (!$orderitem) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($orderitem, 200);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'id' => 'required|string',
            'order_id' => 'required|string',
            'product_id' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|integer'
        ]);


        $orderitem = OrderItem::find($id);
        if (!$orderitem) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $orderitem->update($request->all());

        return response()->json(['message' => 'Data telah berhasil diupdate']);
    }

    public function destroy($id)
    {
        $orderitem = OrderItem::find($id);
        if (!$orderitem) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $orderitem->delete();

        return response()->json(['message' => 'Data telah berhasil dihapus']);
    }
}