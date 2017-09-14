<?php

namespace Api\Users\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use Sluggable, SluggableScopeHelpers;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'email',
        'street', 'city', 'zip_code', 'phone_number',
        'mobile_phone', 'pro_phone', 'birth_city',
        'birth_country', 'birthday'
    ];

    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [
        'slug', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['first_name', 'name']
            ]
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Model relationship
    |--------------------------------------------------------------------------
    |
	| Methods defining model relationship
    |
    */
    public function articles() {
        return $this->hasMany('Api\Articles\Models\Article');
    }
}
