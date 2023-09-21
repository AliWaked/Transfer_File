<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'name',
        'company',
    ];
    protected static function booted(): void
    {
        $user_id = Auth::id();
        static::addGlobalScope(function (Builder $query) use ($user_id) {
            $query->where('user_id', $user_id);
        });
        static::creating(function (Contact $contact) use ($user_id) {
            $contact->user_id = $user_id;
        });
    }
    public function scopeFilter(Builder $builder, ?string $value): void
    {
        $builder->when($value, function (Builder $builder, string $value) {
            // $builder->where();
        });
    }
}
