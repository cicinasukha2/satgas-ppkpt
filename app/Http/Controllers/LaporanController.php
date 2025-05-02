<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function showFormPelaporan()
    {
        return view('form_pelaporan.form_pelaporan');
    }

    public function inputLaporan(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'nullable|string|max:255',
            'kontak_pelapor' => 'nullable|string|max:255',
            'kronologi' => 'required|string',
            'lokasi_kejadian' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'bukti_kejadian' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Simpan file bukti jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti_kejadian')) {
            $buktiPath = $request->file('bukti_kejadian')->store('bukti', 'public');
        }

        // Simpan data laporan
        Laporan::create([
            'user_id' => Auth::id(),
            'nama_pelapor' => $request->nama_pelapor,
            'kontak_pelapor' => $request->kontak_pelapor,
            'kronologi' => $request->kronologi,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'bukti_kejadian' => $buktiPath,
        ]);

        // Redirect kembali ke halaman form dengan pesan sukses
        return back()->with('success', 'Laporan berhasil dikirim!');
    }

    public function index()
    {
        // Semua user dengan role 1 dan 2 dapat melihat daftar laporan
        if (!in_array(Auth::user()->role_id, [1, 2])) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        $laporan = Laporan::all();
        return view('laporan.laporanList', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        // Hanya role 1 yang bisa mengedit laporan
        if (Auth::user()->role_id != 1) {
            return redirect()->route('laporan.index')->with('error', 'Anda tidak memiliki izin untuk mengedit laporan.');
        }

        return view('laporan.laporanForm', compact('laporan'));
    }

    public function create()
    {
        // Hanya role 1 yang bisa membuat laporan
        if (Auth::user()->role_id != 1) {
            return redirect()->route('laporan.index')->with('error', 'Anda tidak memiliki izin untuk membuat laporan.');
        }

        return view('laporan.laporanForm');
    }

    public function store(Request $request)
    {
        // Hanya role 1 yang bisa menyimpan laporan
        if (Auth::user()->role_id != 1) {
            return redirect()->route('laporan.index')->with('error', 'Anda tidak memiliki izin untuk menyimpan laporan.');
        }

        $request->validate([
            'nama_pelapor' => 'nullable|string|max:255',
            'kontak_pelapor' => 'nullable|string|max:255',
            'kronologi' => 'required|string',
            'lokasi_kejadian' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'bukti_kejadian' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Simpan file bukti jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti_kejadian')) {
            $buktiPath = $request->file('bukti_kejadian')->store('bukti', 'public');
        }

        // Simpan data laporan
        Laporan::create([
            'user_id' => Auth::id(),
            'nama_pelapor' => $request->nama_pelapor,
            'kontak_pelapor' => $request->kontak_pelapor,
            'kronologi' => $request->kronologi,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'bukti_kejadian' => $buktiPath,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil disimpan!');
    }

    public function update(Request $request, Laporan $laporan)
    {
        // Hanya role 1 yang bisa mengedit laporan
        if (Auth::user()->role_id != 1) {
            return redirect()->route('laporan.index')->with('error', 'Anda tidak memiliki izin untuk memperbarui laporan.');
        }

        $request->validate([
            'nama_pelapor' => 'nullable|string|max:255',
            'kontak_pelapor' => 'nullable|string|max:255',
            'kronologi' => 'required|string',
            'lokasi_kejadian' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'bukti_kejadian' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Simpan file bukti jika ada perubahan
        if ($request->hasFile('bukti_kejadian')) {
            $buktiPath = $request->file('bukti_kejadian')->store('bukti', 'public');
            $laporan->bukti_kejadian = $buktiPath;
        }

        // Perbarui laporan
        $laporan->update([
            'nama_pelapor' => $request->nama_pelapor,
            'kontak_pelapor' => $request->kontak_pelapor,
            'kronologi' => $request->kronologi,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'tanggal_kejadian' => $request->tanggal_kejadian,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function updateStatus(Request $request, $id)
    {
        // Hanya role 1 yang bisa mengubah status laporan
        if (Auth::user()->role_id != 1) {
            return redirect()->route('laporan.index')->with('error', 'Anda tidak memiliki izin untuk mengubah status laporan.');
        }

        $request->validate([
            'status' => 'required|in:Di Proses,Selesai',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        // Hanya role 1 yang bisa menghapus laporan
        if (Auth::user()->role_id != 1) {
            return redirect()->route('laporan.index')->with('error', 'Anda tidak memiliki izin untuk menghapus laporan.');
        }

        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}