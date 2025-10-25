<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /** @use HasFactory<\Database\Factories\RatingFactory> */
    use HasFactory;


    protected $fillable = ['book_id', 'rating', 'voter_name'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
