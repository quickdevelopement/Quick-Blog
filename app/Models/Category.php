<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
