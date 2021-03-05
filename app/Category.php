<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategories(){
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id')->select('id', 'name');
    }

    public function parentcategory(){
        return $this->belongsTo(Category::class, 'parent_id')->select('id', 'category_name');
    }
}
