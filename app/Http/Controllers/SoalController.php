<?php

namespace App\Http\Controllers;
use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index()
    {
        $data = Soal::all();
        return view('soal/index', compact('data'));
    }
    public function create()
    {
        return view('soal/add');
    }
    public function ambilData(Request $request)
    {
   
        $this->validate($request, [
        'id' => 'required|numeric|unique:soal|min:4',
        'nama_mk' => 'required|min:4',
        'dosen' => 'required|min:4',
        'jumlah_soal' => 'required|numeric',
        'keterangan' => 'required|min:4',

        ]);
        $data = Soal::create($request->all());
        return redirect('data-soal');
}
public function destroy(Soal $id) {
    $id->delete();
    return redirect(url('data-soal'));
}
public function edit($id){
    $data = Soal::find($id);
    return view('soal/edit', compact('data'));
}
public function update($id, Request $request){
    $data = Soal::find($id);
    $soalvalid = [
        'nama_mk' => 'required|min:4',
        'dosen' => 'required|min:4',
        'jumlah_soal' => 'required|numeric',
        'keterangan' => 'required|min:4'
    ];
    if($request->id != $data->id) {
        $soalvalid['id'] = 'required|unique:soal';
    }
    $validatedData = $request->validate($soalvalid);
    $data->update($request->all());
    return redirect(url('data-soal'));
    }
}
