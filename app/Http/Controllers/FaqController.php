<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq; // Import Model Faq
use Illuminate\Support\Facades\Validator; // Import Validator

class FaqController extends Controller
{
    // 1. GET: Ambil Semua Data FAQ
    public function index()
    {
        $faq = Faq::all();
        
        return response()->json([
            'message' => 'Data retrieved successfully',
            'data'    => $faq,
        ], 200);
    }

    // 2. POST: Tambah Data FAQ Baru
    public function store(Request $request)
    {
        // Validasi Input
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer'   => 'required',
        ]);

        // Jika Validasi Gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Simpan Data
        $data['question'] = $request->question;
        $data['answer']   = $request->answer;

        $faq = Faq::create($data);

        return response()->json([
            'status'  => true,
            'message' => 'Data created successfully',
            'data'    => $faq,
        ], 201);
    }

    // (Function show, update, destroy biarkan kosong dulu sesuai modul)


    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
}
