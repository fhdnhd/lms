<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class KppsUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'kpps')->paginate(10);
        return view('users.kpps.index', compact('users'));
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('role','kpps')->select(['id','name','nik','email','role','no_wa','tps','desa','kecamatan']);
            return DataTables::of($users)
                ->addColumn('aksi', function($row) {
                    $editUrl = route('kpps-users.edit', $row->id);
                    $deleteUrl = route('kpps-users.destroy', $row->id);
                    return '
                        <div class="flex justify-center space-x-2">
                            <a href="'.$editUrl.'" class="px-3 py-1 text-xs font-medium rounded bg-yellow-400 text-white hover:bg-yellow-500">Edit</a>
                            <form action="'.$deleteUrl.'" method="POST" onsubmit="return confirm(\'Hapus user ini?\')">
                                '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="px-3 py-1 text-xs font-medium rounded bg-red-500 text-white hover:bg-red-600">Hapus</button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('users.kpps.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'nik'       => 'required|numeric|unique:users,nik',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
            'no_wa'     => 'nullable|string',
        ]);

        User::create([
            'name'      => $request->name,
            'nik'       => $request->nik,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'kpps',
            'alamat'    => $request->alamat,
            'tps'       => $request->tps,
            'desa'      => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi'  => $request->provinsi,
            'no_wa'     => $request->no_wa,
        ]);

        return redirect()->route('kpps-users.index')->with('success', 'User berhasil dibuat');
    }

    public function edit(User $user)
    {
        // return view('users.kpps.edit', compact('user'));
        return view('users.kpps.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'nik'       => 'required|numeric|unique:users,nik,' . $user->id,
            'email'     => 'required|email|unique:users,email,' . $user->id,
        ]);

        $data = $request->only([
            'name','nik','email','alamat','tps','desa',
            'kecamatan','kabupaten','provinsi','no_wa'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('kpps-users.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('kpps-users.index')->with('success', 'User berhasil dihapus');
    }
}
