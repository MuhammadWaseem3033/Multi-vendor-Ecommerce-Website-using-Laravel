<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function sections()
    {
        return $this->belongsTo('App\Models\Section', 'section_id')->select('id', 'name');
    }
    public function parentCategory()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id')->select('id', 'category_name');
    }
    public function subcategries()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->where('status', 1);
    }

    public static function categoryDetails($url)
    {
        $categoryDetails = Category::select('id', 'parent_id', 'category_name', 'description', 'url')
            ->with(['subcategries' => function ($query) {
                $query->select('id', 'parent_id', 'category_name', 'description', 'url');
            }]) // Corrected relationship name
            ->where('url', $url)
            ->first();

        if ($categoryDetails) {
            $categoryDetails = $categoryDetails->toArray();

            $catIds = array();
            $catIds[] = $categoryDetails['id'];

            foreach ($categoryDetails['subcategries'] as $key => $subcat) {
                $catIds[] = $subcat['id'];
            }
            if ($categoryDetails['parent_id'] == 0) {
                $Breadcrums = '<li class="has-separator">
                             <a href="' . url($categoryDetails['url']) . '">' . $categoryDetails['category_name'] . '</a>
                               </li>';
            } else {
                $parentcategory = Category::select('category_name', 'url')->where('id', $categoryDetails['parent_id'])->first()->toArray();
                $Breadcrums = '<li class="has-separator">
                              <a href="' . url($parentcategory['url']) . '">' . $parentcategory['category_name'] . '</a>
                              </li>
                              <li class="is-marked">
                             <a href="' . url($categoryDetails['url']) . '">' . $categoryDetails['category_name'] . '</a>
                               </li>';
            }
            $response = array(
                'catIds' => $catIds,
                'categoryDetails' => $categoryDetails,
                'Breadcrums' => $Breadcrums
            );

            return $response;
        }

        return null; // Return null if category is not found
    }
    public static function getCategoryName($category_id)
    {
        $category = Category::select('category_name')->where('id', $category_id)->first();
        
        if ($category) {
            return $category->category_name;
        } else {
            return null; // or any appropriate fallback value
        }
    }
} 