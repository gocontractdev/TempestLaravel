<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class News extends Model
{

    protected $table = 'news';

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (false) {
                $model->user_id = null;
            }
        });

        static::updating(function($model) {
            if (false) {
                $model->user_id = null;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
