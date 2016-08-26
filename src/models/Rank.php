<?php

namespace Ekushisu\Wasabi\models\;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Rank extends Model
{

    protected $table = 'ranks';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'path', 'shortName'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function users()
    {
      return $this->hasMany('App\User');
    }

    public function getPicture()
    {
      if (!$this->path)
        return "http://dummyimage.com/150/eee/333.jpg&text=no+icon";

      if (substr($this->path, 0, 4 ) === "http")
        return $this->path;

      return '/uploads/img/ranks/'.$this->path;
    }

}
