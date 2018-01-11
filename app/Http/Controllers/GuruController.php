<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{

    public function __construct(Role $role, Guru $guru, Request $request)
    {
        $this->role    = $role;
        $this->model   = $guru;
        $this->request = $request;
    }

    public function index()
    {
        $data['guru'] = Role::where('name', 'guru')->first()->users()->with('guru')->get();

        return view('guru.index', $data);
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store()
    {
        $this->validate($this->request, [
            'nbm'      => 'required|unique:gurus',
            'nama'     => 'required',
            'agama'    => 'required',
            'alamat'   => 'required',
            'no_hp'    => 'required|unique:gurus',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        $user           = new User;
        $user->username = $this->request['username'];
        $user->password = bcrypt($this->request['password']);
        $user->save();

        $role = $this->role->where('name', 'guru')->first();
        $user->attachRole($role);

        $guru          = new Guru($this->request->all());
        $guru->user_id = $user->id;
        $guru->save();

        return redirect()->back()
            ->with('success', $guru->nama . ' berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data['guru'] = $this->model->where('nbm', $id)->first();

        return view('guru.edit', $data);
    }

    public function update($id)
    {
        $this->validate($this->request, [
            'nbm'    => 'required',
            'nama'   => 'required',
            'agama'  => 'required',
            'alamat' => 'required',
            'no_hp'  => 'required',
        ]);

        $guru = $this->model->where('nbm', $id)->first();
        $guru->update($this->request->all());

        return redirect(route('guru.index'))
            ->with('success', $guru->nama . ' berhasil diupdate!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->guru()->delete();
        $user->delete();

        return redirect()->back()
            ->with('success', 'Guru berhasil dihapus.');
    }
}
