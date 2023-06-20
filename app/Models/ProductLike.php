<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip',
        'user_agent',
    ];

    public function scopeForProduct($query, Producto $product)
    {
        // Este scope filtra los registros por un producto específico.
        // Recibe como parámetro una instancia del modelo Producto.
        // Utiliza la columna 'producto_id' en la tabla de registros para realizar la comparación.
        return $query->where('producto_id', $product->id);
    }

    public function scopeForIp($query, string $ip)
    {
        // Este scope filtra los registros por una dirección IP específica.
        // Recibe como parámetro una cadena de texto que representa la dirección IP.
        // Utiliza la columna 'ip' en la tabla de registros para realizar la comparación.
        return $query->where('ip', $ip);
    }

    public function scopeForUserAgent($query, string $userAgent)
    {
        // Este scope filtra los registros por un agente de usuario específico.
        // Recibe como parámetro una cadena de texto que representa el agente de usuario.
        // Utiliza la columna 'user_agent' en la tabla de registros para realizar la comparación.
        return $query->where('user_agent', $userAgent);
    }

}
