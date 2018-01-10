<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Mapel;
use App\Siswa;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function __construct(Siswa $siswa, Request $request)
    {
        $this->model   = $siswa;
        $this->request = $request;
    }

    public function index()
    {
        $data['nama_kelas'] = Kelas::pluck('kelas', 'id');
        $data['mapel']      = Mapel::with('kelas')->where('user_id', Auth::id());

        return view('nilai.index', $data);
    }

    public function siswa()
    {
        $this->validate($this->request, [
            'tahun_ajaran' => 'required',
            'kelas'        => 'required',
            'mapel_id'     => 'required',
        ]);

        $siswa = $this->model->perTahunAjaran(
            $this->request['tahun_ajaran'],
            $this->request['kelas'],
            $this->request['mapel_id']
        )->selectRaw('siswas.nis as nis')
            ->addSelect('nama', 'kelas');

        $mapel = Mapel::with('user')->where('user_id', Auth::id())->get();

        $data = [
            'siswa'        => $siswa,
            'mapel'        => $mapel,
            'tahun_ajaran' => $this->request['tahun_ajaran'],
        ];

        return view('nilai.siswa', $data);
    }

    public function store()
    {
        $this->validate($this->request, [
            'harian' => 'between:0,100|required',
            'uts'    => 'between:0,100|required',
            'uas'    => 'between:0,100|required',
        ]);

        $request = $this->request->except('_token');

        foreach ($this->request->get('nis') as $nis) {

            Auth::user()->menilai()->attach([
                $nis => [
                    'harian'       => $request['harian'][$nis],
                    'uts'          => $request['uts'][$nis],
                    'uas'          => $request['uas'][$nis],
                    'tahun_ajaran' => $request['tahun_ajaran'],
                    'mapel_id'     => $request['mapel_id'],
                ],
            ]);
        }

        return redirect()->back()
            ->with('success', 'Nilai berhasil disimpan!');
    }

    public function edit($id)
    {
        $data['nilai'] = DB::table('nilais')->find($id);

        return view('nilai.edit', $data);
    }

    public function update($id)
    {
        $data['harian'] = $this->request['harian'];
        $data['uts']    = $this->request['uts'];
        $data['uas']    = $this->request['uas'];

        DB::table('nilais')->where('id', $id)->update($data);

        return redirect(route('nilai.index'))
            ->with('success', 'Nilai berhasil diupdate');
    }

    public function kelas()
    {
        return Mapel::where('user_id', Auth::id())
            ->where('kelas_id', $this->request['kelas'])
            ->get();
    }
}
