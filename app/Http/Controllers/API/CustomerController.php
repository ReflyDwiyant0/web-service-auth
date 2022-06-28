<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    // menampilkan semua data
    public function index()
    {
        $customer = Customers::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $customer
        ], 200);
    }
    // menampilkan berdasarkan id
    public function show($id)
    {
        $customer = Customers::find($id);
        if (empty($customer)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $customer], 200);
    }
    // menambah data
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id' => 'required|unique:customer',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = Customers::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update data
    public function update(Request $request, $id)
    {
        $customers = Customers::find($id);
        if (empty($customers)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'id' => 'required|unique:customer',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'address' => 'required'
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $customers->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $customers], 200);
        }
    }
    // Hapus data berdasar id
    public function destroy($id)
    {
        $customers = Customers::find($id);
        if (empty($customers)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $customers->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $customers]);
    }
}