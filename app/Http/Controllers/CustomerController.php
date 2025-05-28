<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Pest\ArchPresets\Custom;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(Customer::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|unique:customers,customer_id',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6',
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        $request['password'] = bcrypt($request->password);

        
        Customer::create($request->all());

        return response()->json(['message' => 'Data telah berhasil ditambahkan'], 201);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($customer, 200);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $customer->update($request->all());

        return response()->json(['message' => 'Data telah berhasil diupdate']);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Data telah berhasil dihapus']);
    }
}