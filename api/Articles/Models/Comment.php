<?php

namespace Api\Articles\Models;

use Infrastructure\Database\Eloquent\Model;

class Comment extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Model fields
    |--------------------------------------------------------------------------
    |
    | Fields configurations
    |
    */
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body'
    ];

    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [
        'user_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that are date format
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author() {
        return $this->belongsTo('Api\User\Models\User', 'user_id', 'id');
    }

    /**
     * Article relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article() {
        return $this->belongsTo('Api\Articles\Models\Articles');
    }
}