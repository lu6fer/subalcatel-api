<?php

namespace Api\Articles\Models;

use Infrastructure\Database\Eloquent\ModelSluggable;

class Article extends ModelSluggable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'status'
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
     * The attributes that are date format
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];


    /**
     * Create slug
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
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
    /**
     * User relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author() {
        return $this->belongsTo('Api\Users\Models\User', 'user_id', 'id');
    }

    /**
     * Comment relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany('Api\Articles\Models\Comment');
    }
}
