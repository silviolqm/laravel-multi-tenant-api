<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\TransacaoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao withoutTrashed()
 * @mixin \Eloquent
 */
class Transacao extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'transacoes';

    protected $fillable = [
        'user_id',
        'valor',
        'cpf',
        'documento_path',
        'status',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
