<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perfil extends Model
{
    use HasFactory;
    protected $table = 'perfiles';
    protected $primaryKey = 'id';

    public function cuentas(): HasMany
    {
        return $this->hasMany(Cuenta::class, 'perfil_id');
    }
}
