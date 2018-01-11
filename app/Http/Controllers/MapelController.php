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
        $data['kelas'] = Kelas::pluck('kelas', 'id');
        $data['mapel'] = $this->model->where('kelas_id', array($this->request['kelas_id']))
            ->orderBy('mapel')
            ->get();

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

        if ($this->existsMapel($this->request) == 1) {
            return $this->redirect($this->request['mapel']);
        } elseif ($this->existsGuru($this->request) == 1) {
            return $this->redirect($this->request['mapel']);
        } else {
            $mapel->save();

            return redirect()->back()
                ->with('success', 'Mapel berhasil disimpan!');
        }
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

        return redirect()->back()
            ->with('success', 'Mapel berhasil dihapus');
    }

    protected function existsMapel($request)
    {
        return $this->model->where('mapel', $request['mapel'])
            ->where('kelas_id', $request['kelas_id'])
            ->where('user_id', $request['user_id'])
            ->count();
    }

    protected function existsGuru($request)
    {
        return $this->model->where('mapel', $request['mapel'])
            ->where('kelas_id', $request['kelas_id'])
            ->count();
    }

    protected function redirect($data)
    {
        return redirect()->back()
            ->with('fail', 'Mapel ' . $data . ' dengan guru dan kelas yang anda input sudah ada');
    }
}
