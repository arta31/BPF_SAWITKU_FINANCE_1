<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CatatanKeuangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CatatanKeuanganController extends Controller
{
    // 1. LIHAT DATA (Read)
    public function index()
    {
        $userId = Auth::id();
        // Ambil data milik user yang login saja
        // Dari ->get() menjadi ->paginate(10)
        $catatans = CatatanKeuangan::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->paginate(2); // <--- GANTI DISINI (Angka 10 artinya 10 data per halaman)

        return view('pages.guest.keuangan.index', compact('catatans'));
    }

    // 2. HALAMAN TAMBAH (Form)
    public function create()
    {
        return view('pages.guest.keuangan.create');
    }

    // 3. PROSES SIMPAN (Create)
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:255',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'nominal' => 'required|numeric|min:0',
            'bukti' => 'nullable|file|mimes:jpg,png,jpeg,pdf|max:2048'
        ]);

        $data = $request->all();

        // Upload Bukti
        if ($request->hasFile('bukti')) {
            $fileName = time() . '_' . $request->file('bukti')->getClientOriginalName();
            $path = $request->file('bukti')->storeAs('uploads', $fileName, 'public');
            $data['bukti'] = $path;
        }

        // MASUKKAN USER ID (Ini yang penting!)
        $data['user_id'] = Auth::id();

        // Simpan ke Database
        CatatanKeuangan::create($data);

        return redirect()->route('catatan-keuangan.index')
            ->with('success', 'Berhasil menyimpan data!');
    }

    // 4. HALAMAN EDIT (Form)
    public function edit($id)
    {
        $catatan = CatatanKeuangan::findOrFail($id);

        // Cek apakah ini punya dia?
        if ($catatan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pages.guest.keuangan.edit', compact('catatan'));
    }

    // 5. PROSES UPDATE (Update)
    public function update(Request $request, $id)
    {
        $catatan = CatatanKeuangan::findOrFail($id);

        if ($catatan->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->all();

        if ($request->hasFile('bukti')) {
            if ($catatan->bukti) Storage::disk('public')->delete($catatan->bukti);
            $fileName = time() . '_' . $request->file('bukti')->getClientOriginalName();
            $path = $request->file('bukti')->storeAs('uploads', $fileName, 'public');
            $data['bukti'] = $path;
        }

        $catatan->update($data);

        return redirect()->route('catatan-keuangan.index')
            ->with('success', 'Data berhasil diupdate!');
    }

    // 6. HAPUS DATA (Delete)
    public function destroy($id)
    {
        $catatan = CatatanKeuangan::findOrFail($id);

        if ($catatan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($catatan->bukti) Storage::disk('public')->delete($catatan->bukti);

        $catatan->delete();

        return redirect()->route('catatan-keuangan.index')
            ->with('success', 'Data berhasil dihapus!');
    }

    // 7. HALAMAN LAPORAN
    public function laporan()
    {
        $userId = Auth::id();
        $catatans = CatatanKeuangan::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->get();

        $laporanPerBulan = $catatans->groupBy(function ($item) {
            return Carbon::parse($item->tanggal)->format('F Y');
        });

        return view('pages.guest.keuangan.laporan', compact('laporanPerBulan'));
    }
}
