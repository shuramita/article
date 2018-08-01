<?php

namespace Shuramita\Article\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string filed_type
 */
class Dictionary extends Model
{
    protected $table = 'dictionary';
    public $field_type = 'text';
    public function getFieldType($value){

        if($value != strip_tags($this->value)) {
            $this->field_type = 'html';
        }elseif (strpos($value, "\n") !== 0){
//        var_dump(strpos($value, "\n"));exit;
            $this->field_type = 'textarea';
        }else{
            $this->field_type = 'text';
        }
        return $this->field_type;
    }
}
