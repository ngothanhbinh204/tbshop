<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "slug",
        "description",
        "parent_id"
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public static function getCategories()
    {
        return self::withCount('products')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function dequy($categories, $parents = 0, $level = 1, &$listCategory)
    {
        if (count($categories) > 0) {

            foreach ($categories as $key => $value) {

                if ($value->parent_id == $parents) {
                    $value->level = $level;
                    $listCategory[] = $value;
                    unset($listCategory[$key]);

                    $parent = $value->id;
                    self::dequy($categories, $parent, $level = 1, $listCategory);
                }
            }
        }
    }

    public static function getTree()
    {
        $categories = Category::all();
        return self::buildTree($categories);
    }

    private static function buildTree($categories, $parentId = null)
    {
        $listCategory = [];
        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $children = self::buildTree($categories, $category->id);
                if ($children) {
                    $category->children = $children;
                }
                $listCategory[] = $category;
            }
        }
        return $listCategory;
    }
}
