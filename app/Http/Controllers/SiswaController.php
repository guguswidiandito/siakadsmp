<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct(Siswa $siswa, Request $request)
    {
        $this->model   = $siswa;
        $this->request = $request;
    }

    public function index()
    {
        $q           = $this->request['q'];
        $tahun_masuk = $this->request['tahun_masuk'];
        $kelas_id    = $this->request['kelas_id'];

        $kelas = Kelas::pluck('kelas', 'id');
        $siswa = $this->model->semuaSiswa()
            ->where('kelas_id', 'LIKE', "%{$kelas_id}%")
            ->where('tahun_masuk', 'LIKE', "%{$tahun_masuk}%")
            ->where(function ($query) use ($q) {
                $query->where('siswas.nis', 'LIKE', "%{$q}%")
                    ->orWhere('siswas.nama', 'LIKE', "%{$q}%");
            })
            ->selectRaw('siswas.nis as nis, siswas.nama as nama_siswa, gurus.nama as nama_guru, kelas as nama_kelas')
            ->paginate(10);

        $data = [
            'q'           => $q,
            'tahun_masuk' => $tahun_masuk,
            'kelas_id'    => $kelas_id,
            'kelas'       => $kelas,
            'siswa'       => $siswa,
        ];
        
        return view('siswa.index', $data);
    }

    public function create()
    {
        $data['kelas'] = Kelas::pluck('kelas', 'id');

        return view('siswa.create', $data);
    }

    public function store()
    {
        $this->validate($this->request, [
            'nis'           => 'required|unique:siswas',
            'nama'          => 'required',
            'agama'         => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir'     => 'required',
            'alamat'        => 'required',
            'tahun_masuk'   => 'required',
            'kelas_id'      => 'required',
        ]);

        $data  = $this->request->all();
        $siswa = new Siswa($data);
        $siswa->save();

        return redirect()->back()
            ->with('success', 'Siswa berhasil disimpan!');
    }

    public function edit($id)
    {
        $data['kelas'] = Kelas::pluck('kelas', 'id');
        $data['siswa'] = $this->model->findOrFail($id);

        return view('siswa.edit', $data);
    }

    public function update($id)
    {
        $this->validate($this->request, [
            'nama'          => 'required',
            'agama'         => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir'     => 'required',
            'alamat'        => 'required',
            'tahun_masuk'   => 'required',
            'kelas_id'      => 'required',
        ]);

        $siswa = $this->model->findOrFail($id);
        $siswa->update($this->request->all());

        return redirect(route('siswa.index'))
            ->with('success', 'Siswa berhasil diupdate');
    }

    public function destroy($id)
    {
        $siswa = $this->model->find($id);
        $siswa->delete();

        return redirect(route('siswa.index'))
            ->with('success', 'Siswa berhasil dihapus');
    }

}
