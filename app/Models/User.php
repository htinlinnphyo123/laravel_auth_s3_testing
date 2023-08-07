<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'languages'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'languages' => 'object'
    ];
    protected $appends = [
        'country'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    protected function password()
    {
        return Attribute::make(
            set: fn($value) => bcrypt($value)
        );
    }
    //to change name to upper letter
    protected function name() : Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value)
        );
    }
    //address attribute is not in the model attribute. but accessor testing
    protected function address() : Attribute
    {
        return Attribute::make(
            get: fn() => Str::ucfirst($this->attributes['street']) . ' , ' . Str::ucfirst($this->attributes['city']) . ' [ ' . $this->attributes['postal_code'] . ' ]'
        );
    }
    //just to change capital letter
    // protected function languages() : Attribute
    // {
    //     return Attribute::make(
    //         get: function($value,$attribute){
    //             $languages = json_decode($value,true);
    //             if ($languages) {
    //                 $languages = array_map('strtoupper', $languages);
    //             }
    //             return $languages;
    //         }
    //     );
    // }

    protected function country() : Attribute
    {
        return Attribute::make(
            get: fn() => 'Example Attribute',
        );
    }

}
