<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'slug',
    'description',
    'image',
    'is_active'
  ];

  protected $casts = [
    'is_active' => 'boolean',
  ];

  /**
   * Boot the model and set up event listeners
   */
  protected static function boot()
  {
    parent::boot();

    static::creating(function ($category) {
      if (empty($category->slug)) {
        $category->slug = Str::slug($category->name);
      }
    });

    static::updating(function ($category) {
      if ($category->isDirty('name') && empty($category->slug)) {
        $category->slug = Str::slug($category->name);
      }
    });
  }

  /**
   * Get products that belong to this category
   */
  public function products()
  {
    return $this->hasMany(Product::class, 'category', 'name');
  }

  /**
   * Scope to get only active categories
   */
  public function scopeActive($query)
  {
    return $query->where('is_active', true);
  }
}
