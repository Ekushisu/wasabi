<?php

namespace Ekushisu\Wasabi\Http\Controllers;
use App\Http\Controllers\Controller;
use View;
use File;

class WasabiController extends Controller
{
    protected $backgroundImage;

    public function __construct()
    {
    	$this->backgroundImage = File::glob('assets/images/single/bg*');
    	shuffle($this->backgroundImage);
        View::share('backgroundImage', isset($this->backgroundImage[0]) ? $this->backgroundImage[0] : null);
    }

		protected function inputHydratation($object, $inputs)
		{
			foreach($inputs as $key => $value)
			{
			    if(strpos($key, 'at-') !== false)
			    {
			        $key = str_replace('at-', '', $key);
			        if($object->$key != $value)
			        {
			            $object->$key = $value;
			        }
			    }
			}
			return $object;
		}

    public function index()
    {
      $data = [];
      return view("wasabi::base")->with($data);
    }
}
