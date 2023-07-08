<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rel_to_guest(){
        return $this->belongsTo(Guestlogin::class,'guest_id');
    }
    public function replies(){
        return $this->hasMany(Comment::class,'parent_id', 'id');
    }
}
