<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function __construct(Kelas $kelas, Request $request)
    {
        $this->model   = $kelas;
        $this->request = $request;
    }

    public function index()
    {
        $data['kelas'] = $this->model->semuaKelas()->get();

        return view('kelas.index', $data);
    }

    public function create()
    {
        $data['wali_kelas'] = User::daftarGuru();

        return view('kelas.create', $data);
    }

    public function store()
    {
        $this->validate($this->request, [
            'kelas' => 'required|unique:kelas',
            'user_id'   => 'required|unique:kelas',
        ]);

        $kelas = new Kelas($this->request->all());
        $kelas->save();

        return redirect()->back()
            ->with('success', 'Kelas berhasil disimpan!');
    }

    public function edit($id)
    {
        $data['wali_kelas'] = User::daftarGuru();
        $data['kelas']      = $this->model->semua()->find($id);

        return view('kelas.edit', $data);
    }

    public function update($id)
    {
        $kelas = $this->model->find($id);
        $kelas->update($this->request->all());

        return redirect(route('kelas.index'))
            ->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy($id)
    {
        $kelas = $this->model->find($id);
        $kelas->delete();

        return redirect(route('kelas.index'))
            ->with('success', 'Kelas berhasil dihapus');
    }
}
