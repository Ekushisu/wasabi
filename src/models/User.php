<?php

namespace Ekushisu\Wasabi\models\;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'banned', 'level', 'firstName', 'lastName', 'background'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $firstname;
    protected $lastname;

    public function getFullName($shorten = false)
    {
      return $shorten ? substr(ucfirst($this->firstName),0, 1).". ".$this->lastName : $this->firstName." ".$this->lastName;
    }

    public function getCreationDate()
    {
        setlocale(LC_TIME, 'French');
        return $this->created_at->formatLocalized('%A %d %B %Y');
    }

    public function rank()
    {
        return $this->belongsTo('App\Rank');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    public function briefings()
    {
         return $this->belongsToMany('App\Briefing', 'briefings_users')
    	               ->withPivot('status');
    }
}
