<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\subcategory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];


    /**
     * Get the Producto that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   /**
    * Get all of the producto for the Category
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function producto(): HasMany
   {
       return $this->hasMany(Producto::class);
   }

   /**
    * Get all of the subcategory for the Category
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function subcategory(): HasMany
   {
       return $this->hasMany(Subcategory::class);
   }



}
