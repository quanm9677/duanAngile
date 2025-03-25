<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    protected $fillable = [
        'title',
        'author_id',
        'category_id',
        'description',
        'publication_date',
        'price',
        'original_price',
        'stock_quantity',
        'image'
    ];

    protected $casts = [
        'publication_date' => 'date',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'stock_quantity' => 'integer'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}