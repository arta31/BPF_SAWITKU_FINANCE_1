<!-- <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Pelanggan;
// class PelangganController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
// {
//     $pageData['dataPelanggan'] = Pelanggan::all();
//     return view('admin.pelanggan.index', $pageData);
// }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         return view('admin.pelanggan.create');
//     }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // BENAR: Hasil validasi disimpan ke variabel
    //     $validatedData = $request->validate([
    //         'first_name' => ['required'],
    //         'last_name'  => ['required'],
    //         'birthday'   => ['required', 'date'],
    //         'gender'     => ['required', 'in:Male,Female'],
    //         'email'      => ['required', 'email'],
    //         'phone'      => ['required', 'numeric'],
    //     ]);

    //    try {
    //         // 2. LANGKAH 2 (Create Data)
    //         Pelanggan::create($validatedData);

    //         // 3. Redirect ke halaman index dengan pesan sukses
    //         return redirect()->route('pelanggan.list')
    //                      ->with('success', 'Penambahan Data Berhasil!'); // Pesan dari Langkah 2

    //     } catch (\Exception $e) {
    //         // 4. Jika gagal, kembali ke form dengan pesan error
    //         return redirect()->back()
    //                      ->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()])
    //                      ->withInput();
    //     }
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $param1) // Terima parameter dari route
    // {
    //     // Cari data berdasarkan ID, jika tidak ketemu akan error 404
    //     $pageData['dataPelanggan'] = Pelanggan::findOrFail($param1);

    //     // Kirim data ke view edit.blade.php
    //     return view('admin.pelanggan.edit', $pageData);
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request) // Hapus 'string $id'
    // {
    //     // Ambil ID dari <input type="hidden">
    //     $pelanggan_id = $request->pelanggan_id;

    //     // 1. Validasi (Sama seperti store, TAPI rule 'email' harus diubah)
    //     $request->validate([
    //         'first_name' => ['required'],
    //         'last_name'  => ['required'],
    //         'birthday'   => ['required', 'date'],
    //         'gender'     => ['required', 'in:Male,Female,Other'], // Pastikan sinkron dengan form
    //         'email'      => [
    //             'required',
    //             'email',
    //             // Periksa unik, TAPI abaikan (ignore) pelanggan_id saat ini
    //             \Illuminate\Validation\Rule::unique('pelanggan')->ignore($pelanggan_id, 'pelanggan_id')
    //         ],
    //         'phone'      => ['required', 'numeric'],
    //     ]);

    //     try {
    //         // 2. Cari data pelanggan (sesuai tutorial)
    //         $pelanggan = Pelanggan::find($pelanggan_id);

    //         // 3. Update field satu per satu (sesuai tutorial)
    //         $pelanggan->first_name = $request->first_name;
    //         $pelanggan->last_name  = $request->last_name;
    //         $pelanggan->birthday   = $request->birthday;
    //         $pelanggan->gender     = $request->gender;
    //         $pelanggan->email      = $request->email;
    //         $pelanggan->phone      = $request->phone;
    //         $pelanggan->save(); // Simpan perubahan

    //         // 4. Redirect dengan pesan sukses
    //         return redirect()->route('pelanggan.list')
    //                      ->with('success', 'Perubahan Data Berhasil!');

    //     } catch (\Exception $e) {
    //         return redirect()->back()
    //                      ->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()])
    //                      ->withInput();
    //     }
    // }
    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $param1)
    //         {
    //             $pelanggan = Pelanggan::findOrFail($param1);

    //             $pelanggan->delete();

    //             return redirect()->route('pelanggan.list')->with('success', 'Penghapusan Data Berhasil!');
    //         }
// } -->
