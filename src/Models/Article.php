<?php

namespace Shura\Article\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $table = 'article';

    protected $hidden = [];
    protected $fillable = ['title','slug','description','body','category_id','photos','created_by'];
    protected $translate_fields = ['title','description','body'];
    public function createdBy(){
        return $this->belongsTo('App\User','created_by');
    }
    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
    public static function addNewArticle($article){
        $article['slug'] = str_slug($article['title']);
        $article['created_by'] = Auth::user()->id;

        return static::create($article);
    }
    public function translate(){
        $language = App()->getLocale();
//        var_dump($language);
//        var_dump(config('app.fallback_locale'));
        if($language == config('app.fallback_locale')) return;
        $dictionaries = Dictionary::where('content_type',$this->table)
            ->where('content_id',$this->id)
            ->where('language',$language)
            ->get();
        foreach ($dictionaries as $sentence) {
            if(trim($sentence->value)!= "" && $sentence->translated == 1) {
                $field = $sentence->field;
                $this->$field = $sentence->value;
            }
        }
        // find list of untranslated value
        $this->storeUntranslated($this->toArray(),$dictionaries->toArray());
//        var_dump($this->name);exit;
    }
    public function storeUntranslated($content,$dictionaries){
//        var_dump($dictionaries);exit;
        $translated_fields = [];
        $unTranslated = [];
        $language = App()->getLocale();
        foreach($dictionaries as $dictionary) {
            $translated_fields[] = $dictionary['field'];
        }
        foreach ($content as $key => $value) {
            if(in_array($key,$this->translate_fields) && !in_array($key,$translated_fields) && trim($value)!="") {
                $unTranslated[] = [
                    'content_type'=>$this->table,
                    'content_id'=>$this->id,
                    'field'=>$key,
                    'domain'=>$this->table,
                    'language'=>$language,
                    'value'=>$value
                ];
            }
        }
        Dictionary::insert($unTranslated);
    }

}
