<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Certificado extends Model
{
    use HasUuids;
    protected $table = 'certificados';
    public $incrementing = false;
    protected $fillable = [
        'tipo_id',
        'user_id',
        'evento_id'
    ];

    protected $hidden = [
    ];
    public function tipo(): BelongsTo
    {
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }
    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
