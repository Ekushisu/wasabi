<?php

namespace Ekushisu\Wasabi\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

class WasabiController extends Controller
{
    public function index()
    {
      $data = [];
      return view("wasabi::base")->with($data);
    }
}
