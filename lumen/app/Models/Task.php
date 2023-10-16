<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=[
        'title',
        'description',
        'user_id',
        'category_id'
        

    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
    public function category() {
        return $this->hasOne('App\Models\Category', 'category_id', 'id');
    }
}
