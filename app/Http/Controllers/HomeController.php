<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request) // Tambahkan Request $request
    {
        // Ambil username dari session
        $data['username'] = $request->session()->get('username', 'Guest'); // Default 'Guest' jika session tidak ada

        $data['last_login']      = date('Y-m-d H:i:s');
        $data['list_pendidikan'] = ['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3'];

        // Pastikan Anda menggunakan nama view yang benar (home.blade.php -> 'home')
        return view('home', $data);
    }

    // ... (method lainnya biarkan saja)


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    // public function signup(Request $request)
    // {
    // $request->validate([
	// 	    'name'  => 'required|max:10',
	// 	    'email' => ['required','email'],
	// 	    'password' => [
	// 	        'required',           // Wajib diisi
	// 	        'string',             // Harus berupa string
	// 	        'min:8',              // Minimal 8 karakter
	// 	        'regex:/[A-Z]/',      // Harus mengandung setidaknya 1 huruf besar
	// 	    ],
	// 	]);

    // $pageData['name']     = $request->name;
    // $pageData['email']    = $request->email;
    // $pageData['password'] = $request->password;

    // // Kirim data ke view baru
    // return view('signup-success', $pageData);
    // }
}
