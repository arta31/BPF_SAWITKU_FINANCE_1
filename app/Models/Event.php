<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // <--- JANGAN LUPA IMPORT INI
use Illuminate\Http\Request;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama_event', 'tanggal', 'lokasi','deskripsi', 'kategori', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // === COPY CODE INI KE DALAM CLASS EVENT ===
    public function scopeFilter(Builder $query, Request $request, array $filters = [], array $searchable = [])
    {
        // 1. Filter Biasa (Status, Kategori, dll)
        foreach ($filters as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->input($filter));
            }
        }

        // 2. Search (Nama Event, Lokasi, dll)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $searchable) {
                foreach ($searchable as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }

        return $query;
    }
}
