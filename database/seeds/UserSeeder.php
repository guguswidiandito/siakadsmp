<?php

use App\Guru;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole               = new Role;
        $adminRole->name         = "admin";
        $adminRole->display_name = "Admin";
        $adminRole->save();

        $guruRole               = new Role;
        $guruRole->name         = "guru";
        $guruRole->display_name = "Guru";
        $guruRole->save();

        $admin           = new User;
        $admin->email    = 'administrator@gmail.com';
        $admin->password = bcrypt('rahasia');
        $admin->save();
        $admin->attachRole($adminRole);

        $user           = new User;
        $user->email    = 'guguswidiandito@gmail.com';
        $user->password = bcrypt('rahasia');
        $user->save();
        $user->attachRole($guruRole);

        $guru          = new Guru;
        $guru->nbm     = '3328091811960002';
        $guru->nama    = 'Gugus Widiandito';
        $guru->alamat  = 'Dermasandi RT11/03 Kec. Pangkah, Kab. Tegal';
        $guru->no_hp   = '083837151148';
        $guru->agama   = 'Islam';
        $guru->user_id = $user->id;
        $guru->save();
    }
}
