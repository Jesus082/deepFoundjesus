<?php

namespace App\Models;

use App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'producto_id'
    ];

    /**
     * Get the productos that owns the Image
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productos(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
