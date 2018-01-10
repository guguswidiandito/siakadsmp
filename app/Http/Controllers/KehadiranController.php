<?php

namespace App\Http\Controllers;

use App\User;
use App\Kelas;
use App\Siswa;
use Auth;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function __construct(Siswa $siswa, Request $request)
    {
        $this->model   = $siswa;
        $this->request = $request;
    }

    public function index()
    {
        $data['nama_kelas'] = Kelas::pluck('kelas', 'kelas');

        return view('kehadiran.index', $data);
    }

    public function siswa()
    {
        $this->validate($this->request, [
            'tgl_absen' => 'required',
            'jam_ke'    => 'required',
            'kelas'     => 'required',
        ]);

        $siswa = $this->model->perKelas(
            $this->request['tgl_absen'],
            $this->request['jam_ke'],
            $this->request['kelas']
        )->selectRaw('siswas.nis as nis')
            ->addSelect('nama', 'kelas');

        $data = [
            'siswa'     => $siswa,
            'jam_ke'    => $this->request['jam_ke'],
            'tgl_absen' => $this->request['tgl_absen'],
        ];

        return view('kehadiran.siswa', $data);
    }

    public function store()
    {
        $this->validate($this->request, [
            'absen' => 'required',
        ], [
            'absen.required' => 'Silahkan isi semua absen siswa pada Jam Ke: '.$this->request['jam_ke'].' dan Tanggal: '.$this->request['tgl_absen'].' sebelum di simpan'
        ]);

        $request = $this->request->except('_token');

        foreach ($this->request->get('nis') as $nis) {

            $absen = $request['absen'][$nis];

            if ($absen == 'A') {
                $keterangan = 'Tidak Masuk Tanpa Ada Keterangan atau Pemberitahuan';
            } elseif ($absen == 'I') {
                $keterangan = 'Tidak Masuk Ada Keterangan atau Pemberitahuan';
            } elseif ($absen == 'S') {
                $keterangan = 'Tidak Masuk Ada Surat Dokter atau Pemberitahuan';
            } else {
                $keterangan = 'Hadir';
            }

            Auth::user()->mengabsen()->attach([
                $nis => [
                    'tgl_absen'  => $request['tgl_absen'],
                    'absen'      => $absen,
                    'jam_ke'     => $request['jam_ke'],
                    'keterangan' => $keterangan,
                ],
            ]);
        }

        return redirect()->back()
            ->with('success', 'Kehadiran berhasil disimpan!');
    }
}
