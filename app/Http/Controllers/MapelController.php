<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Mapel;
use App\User;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function __construct(Mapel $mapel, Request $request)
    {
        $this->model   = $mapel;
        $this->request = $request;
    }

    public function index()
    {
        $data['mapel'] = $this->model->orderBy('mapel')->get();

        return view('mapel.index', $data);
    }

    public function create()
    {
        $data['kelas'] = Kelas::pluck('kelas', 'id');
        $data['guru']  = User::daftarGuru();

        return view('mapel.create', $data);
    }

    public function store()
    {
        $this->validate($this->request, [
            'mapel'    => 'required',
            'kelas_id' => 'required',
            'user_id'  => 'required',
        ]);

        $mapel = new Mapel($this->request->all());
        $mapel->save();

        return redirect()->back()
            ->with('success', 'Mapel berhasil disimpan!');
    }

    public function edit($id)
    {
        $data['kelas'] = Kelas::pluck('kelas', 'id');
        $data['guru']  = User::daftarGuru();
        $data['mapel'] = $this->model->find($id);

        return view('mapel.edit', $data);
    }

    public function update($id)
    {
        $this->validate($this->request, [
            'mapel'   => 'required',
            'kelas'   => 'required',
            'user_id' => 'required',
        ]);

        $mapel = $this->model->find($id);
        $mapel->update($this->request->all());

        return redirect()->back()
            ->with('success', 'Mapel berhasil diupdate');
    }

    public function destroy($id)
    {
        $mapel = $this->model->find($id);
        $mapel->delete();

        return redirect(route('mapel.index'))
            ->with('success', 'Mapel berhasil dihapus');
    }
}
