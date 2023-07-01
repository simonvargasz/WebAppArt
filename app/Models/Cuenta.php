<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;


class Cuenta extends Authenticatable
{
    use HasFactory;

    protected $table = 'cuentas';
    protected $primaryKey = 'user';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    public function perfil(): BelongsTo
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }
    public function imagenes(): HasMany
    {
        return $this->hasMany(Imagen::class, 'cuenta_user');
    }
}
