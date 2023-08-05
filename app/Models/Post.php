<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $appends = ['country'];
    protected static function booted()
    {
        static::addGlobalScope(new OrderScope('body'));
    }
    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn($value) =>  Str::ucfirst($value),
            set: fn($value) => 'Dr . ' . Str::upper($value)
        );
    }
    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    protected function country() : Attribute
    {
        return Attribute::make(
            get : fn() => 'Myanmar'
        );
    }
}
