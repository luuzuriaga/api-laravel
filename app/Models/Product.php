<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Models\Concerns\LogsActivity;

class Product extends Model
{
    use LogsActivity;
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'stock',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    }
