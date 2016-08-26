<?php

namespace Ekushisu\Wasabi\models\;

use Illuminate\Database\Eloquent\Model;

class Opex extends Model
{
    protected $table = "opexs";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'periode', 'location', 'description','thumbnail'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function briefings()
    {
      return $this->hasMany('App\Briefing');
    }

    public function getThumbnail()
    {
      if (!$this->thumbnail)
        return "http://dummyimage.com/1024x400/eee/333.jpg&text=no+thumbnail";

      if (substr($this->thumbnail, 0, 4 ) === "http")
        return $this->thumbnail;

      return '/uploads/img/opex/'.$this->thumbnail;
    }
}
