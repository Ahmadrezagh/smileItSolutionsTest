<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;
    protected $with = ['user'];
    protected $fillable = [
        'user_id',
        'balance',
        'card_number',
        'password'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function scopeFilterByUserEmail(Builder $builder, $user_email = null)
    {
        if($user_email)
        {
            $builder->whereHas('user',function (Builder $query) use ($user_email) {
               $query->where('email','=',$user_email);
            });
        }
        return $builder;
    }

    public function getRouteKeyName()
    {
        return 'card_number';
    }
}
