<?php

namespace Shuramita\Article\Models;

use Illuminate\Database\Eloquent\Model;
use Averspace\Admin\Models\Category as AdminCategory;

class Category extends AdminCategory
{

    protected $table = 'category';

    protected $hidden = [];


    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            $model->content_type = 'article';
            $model->slug = str_slug($model->name);
        });
        static::updating(function ($model)
        {
            $model->slug = str_slug($model->name);
        });
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    public function products(){
        return $this->hasMany('App\Product');
    }
    public static function addNewCategory($data){
        $category = new Category();
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->parent = $data['parent_id'];
        $category->save();
        return $category;
    }
    public static function updateCategory($data){
        $category = Category::find($data['id']);
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->parent = $data['parent_id'];
        $category->update();
        return $category;
    }
}
