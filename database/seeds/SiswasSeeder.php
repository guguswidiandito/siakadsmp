<?php

use App\Siswa;
use Illuminate\Database\Seeder;

class SiswasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(13115001, 13115030) as $r) {
            $siswa                = new Siswa;
            $siswa->nis           = $r;
            $siswa->nama          = $faker->name;
            $siswa->agama         = "Islam";
            $siswa->jenis_kelamin = 'Laki-laki';
            $siswa->tgl_lahir     = '1996-11-18';
            $siswa->alamat        = $faker->address;
            $siswa->tahun_masuk   = '2016';
            $siswa->kelas_id      = 2;
            $siswa->save();
        }
    }
}
