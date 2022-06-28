<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::all();
        return view('mahasiswa/index', compact('data'));
    }

    public function create()
    {
        return view('mahasiswa/add');
    }
    public function ambilData(Request $request)
    {
        $this->validate($request, [
        'nim' => 'required|unique:mahasiswa|min:4',
        'nama_mahasiswa' => 'required|min:4',
        'semester' => 'required|numeric',
        ]);
        $data = Mahasiswa::create($request->all());
        return redirect('data-mahasiswa');
    }
    public function destroy(Mahasiswa $id) {
        $id->delete();
        return redirect(url('data-mahasiswa'));
    }
    public function edit($id){
        $data = Mahasiswa::find($id);
        return view('mahasiswa/edit', compact('data'));
    }
    public function update($id, Request $request){
        $data = Mahasiswa::find($id);
        $rules = [
            'nama_mahasiswa' => 'required|min:4',
            'semester' => 'required|numeric'
        ];
        if($request->nim != $data->nim) {
            $rules['nim'] = 'required|unique:mahasiswa';
        }
        $validatedData = $request->validate($rules);
        $data->update($request->all());
        return redirect(url('data-mahasiswa'));
    }
}

