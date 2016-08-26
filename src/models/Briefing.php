<?php

namespace Ekushisu\Wasabi\models\;

use Illuminate\Database\Eloquent\Model;

class Briefing extends Model
{
    protected $table = "briefings";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'chapo', 'content', 'thumbnail', 'publiState', 'missionState', 'missionDate'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function opex()
    {
      return $this->belongsTo('App\Opex');
    }

    public function users()
    {
      return $this->belongsToMany('App\User', 'briefings_users')
                  ->withPivot('status');
    }

    public function getThumbnail()
    {
      if (!$this->thumbnail)
        return "http://dummyimage.com/1024/eee/333.jpg&text=no+thumbnail";

      if (substr($this->thumbnail, 0, 4 ) === "http")
        return $this->thumbnail;

      return '/uploads/img/briefing/'.$this->thumbnail;
    }
}
