<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    public function index()
    {
        if (! session()->has('login_user')) {
            return redirect()->route('admin.login');
        }

        $users = DB::table('user')->orderBy('no')->get();
        $kontaks = DB::table('kontak')->orderBy('no')->get();
        $sekretaris = DB::table('pejabat')->where('posisi', 'sekretaris')->first();
        $bendahara = DB::table('pejabat')->where('posisi', 'bendahara')->first();
        $gedungs = DB::table('gedung')->orderBy('gedung')->get();
        $fasilitas = DB::table('fasilitas')->first();

        return view('auth.pengaturan', compact(
            'users', 'kontaks', 'sekretaris', 'bendahara', 'gedungs', 'fasilitas'
        ));
    }

    // ===== MANAGE USER =====

    public function storeUser(Request $request)
    {
        $request->validate([
            'user' => 'required|string|max:24',
            'password' => 'required|string|min:4',
        ]);

        DB::table('user')->insert([
            'user' => $request->user,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'User baru berhasil ditambahkan.');
    }

    public function updateUser(Request $request, $no)
    {
        $request->validate([
            'user' => 'required|string|max:24',
        ]);

        $data = ['user' => $request->user];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('user')->where('no', $no)->update($data);

        return back()->with('success', 'User berhasil diperbarui.');
    }

    public function destroyUser($no)
    {
        DB::table('user')->where('no', $no)->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }

    // ===== CONTACT PERSON =====

    public function storeKontak(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:32',
            'telepon' => 'required|string|max:14',
            'alamat' => 'required|string|max:60',
            'email' => 'nullable|email|max:100',
        ]);

        DB::table('kontak')->insert(
            $request->only('nama', 'telepon', 'alamat', 'email')
        );

        return back()->with('success', 'Contact person baru berhasil ditambahkan.');
    }

    public function updateKontak(Request $request, $no)
    {
        $request->validate([
            'nama' => 'required|string|max:32',
            'telepon' => 'required|string|max:14',
            'alamat' => 'required|string|max:60',
            'email' => 'nullable|email|max:100',
        ]);

        DB::table('kontak')->where('no', $no)->update(
            $request->only('nama', 'telepon', 'alamat', 'email')
        );

        return back()->with('success', 'Contact person berhasil diperbarui.');
    }

    public function destroyKontak($no)
    {
        DB::table('kontak')->where('no', $no)->delete();

        return back()->with('success', 'Contact person berhasil dihapus.');
    }

    // ===== SEKRETARIS / BENDAHARA =====

    public function updatePejabat(Request $request, $posisi)
    {
        $request->validate([
            'nama' => 'required|string|max:60',
            'nip' => 'required|numeric',
        ]);

        DB::table('pejabat')->where('posisi', $posisi)->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
        ]);

        return back()->with('success', ucfirst($posisi).' berhasil diperbarui.');
    }

    // ===== TARIF GEDUNG =====

    public function updateGedung(Request $request, $kode)
    {
        $request->validate([
            'hargasiang' => 'required|numeric',
            'hargamalam' => 'required|numeric',
            'hargahari' => 'required|numeric',
        ]);

        DB::table('gedung')->where('kode', $kode)->update(
            $request->only('hargasiang', 'hargamalam', 'hargahari')
        );

        return back()->with('success', 'Tarif gedung berhasil diperbarui.');
    }

    // ===== FASILITAS =====

    public function updateFasilitas(Request $request, $id)
    {
        $request->validate([
            'deskripsi_fasilitas' => 'required|string',
        ]);

        DB::table('fasilitas')->where('id_fasilitas', $id)->update([
            'deskripsi_fasilitas' => $request->deskripsi_fasilitas,
        ]);

        return back()->with('success', 'Fasilitas berhasil diperbarui.');
    }
}