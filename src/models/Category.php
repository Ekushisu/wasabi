<?php

namespace Ekushisu\Wasabi\models\;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;

    protected $fillable = [
       'name'
    ];

    public function notes()
    {
      return $this->hasMany('App\Note');
    }
}
