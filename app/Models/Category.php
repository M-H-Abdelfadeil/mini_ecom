<?php

namespace App\Models;

use App\Traits\ModelTranslateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, ModelTranslateTrait;
    protected $guarded = ['id'];
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    public function sub()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInActive($query)
    {
        return $query->where('is_active', false);
    }

     public function scopeJustParent()
    {
        return $this->whereNull("parent_id");
    }

}
