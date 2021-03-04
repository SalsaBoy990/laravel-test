<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // many to many
    public function recipes() {
        return $this->belongsToMany(Recipe::class);
    }

    public function filteredRecipes() {
        return $this->belongsToMany(Recipe::class)
            ->wherePivot('tag_id', $this->id)
            ->orderBy('updated_at', 'DESC');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'style',
    ];
}
