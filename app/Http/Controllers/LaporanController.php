<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'nama_pelapor' => $request->nama_pelapor,
            'kontak_pelapor' => $request->kontak_pelapor,
            'kronologi' => $request->kronologi,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'bukti_kejadian' => $buktiPath,
        ]);

        return redirect()->route('laporan.create')->with('success', 'Laporan berhasil dikirim!');
    }

    public function index()
    {
        $laporan = Laporan::all();
        $currentUser = (object)[
            'user_id' => 1, // Hardcoded untuk sementara
            'role_id' => 1, // Hardcoded sebagai admin
        ];

        return view('laporan.laporanList', compact('laporan', 'currentUser'));
    }

    /**
     * Menampilkan halaman form tambah laporan
     */
    public function create()
    {
        return view('laporan.form_pelaporan');
    }


    /**
     * Menampilkan halaman edit laporan
     */
    public function edit(Laporan $laporan)
    {
        return view('laporan.editLaporan', compact('laporan'));
    }

    /**
     * Memperbarui laporan yang sudah ada
     */
    public function update(Request $request, Laporan $laporan)
    {
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
        $request->validate([
            'status' => 'required|in:Di Proses,Selesai',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Status laporan berhasil diperbarui.');
    }


    /**
     * Menghapus laporan
     */
    public function destroy(Laporan $laporan)
    {
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }

}
