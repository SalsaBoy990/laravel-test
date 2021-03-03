<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    // one user! not with 's'
    public function user() {
        return $this->belongsTo(User::class);
    }

    // many to many
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];
}
