<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // menampilkan semua data
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $product
        ], 200);
    }
    // menampilkan berdasarkan id
    public function show($id)
    {
        $product = Product::find($id);
        if (empty($product)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $product], 200);
    }
    // menambah data
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id' => 'required|numeric|unique:products',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = Product::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update data
    public function update(Request $request, $id)
    {
        $productss = Product::find($id);
        if (empty($productss)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'id' => 'required|numeric|unique:products',
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
                'category_id' => 'required|numeric'
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $productss->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $productss], 200);
        }
    }
    
    // Hapus data berdasar id
    public function destroy($id)
    {
        $productss = Product::find($id);
        if (empty($productss)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $productss->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $productss]);
       
    }
        public function indexRelasi()
        {
            $products = Product::with('category')->get();
            return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $products], 200);
        }

    }
