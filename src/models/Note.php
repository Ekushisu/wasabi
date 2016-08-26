<?php

namespace Ekushisu\Wasabi\models\;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    public $timestamps = true;

    protected $fillable = [
       'name', 'category_id', 'author_id', 'chapo', 'content', 'thumbnail', 'publiState'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function getThumbnail()
    {
      if (!$this->thumbnail)
        return "http://dummyimage.com/1024/eee/333.jpg&text=no+icon";

      if (substr($this->thumbnail, 0, 4 ) === "http")
        return $this->thumbnail;

      return '/uploads/img/notes/'.$this->thumbnail;
    }
}
