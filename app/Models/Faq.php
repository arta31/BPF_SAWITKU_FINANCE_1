<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    // Karena nama tabel bukan 'faqs', kita set manual:
    protected $table = 'faq';

    // Karena primary key bukan 'id', kita set manual:
    protected $primaryKey = 'faq_id';

    // Kolom yang boleh diisi
    protected $fillable = [
        'question',
        'answer'
    ];
}