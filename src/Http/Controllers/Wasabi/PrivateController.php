<?php namespace Ekushisu\Wasabi\Http\Controllers\Wasabi;

use Illuminate\Http\Response;
use Ekushisu\Wasabi\Http\Controllers\WasabiController;
use Auth;
use Ekushisu\Wasabi\models\Briefing;
use Ekushisu\Wasabi\models\Note;
use Ekushisu\Wasabi\models\Opex;
use Ekushisu\Wasabi\models\User;
use Input;
use View;


class PrivateController extends WasabiController {


    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->user = Auth::user();
        View::share('user', $this->user);
    }

    public function getHome()
    {
        $data = [
            'briefings' => Briefing::where('publiState', 1)
                                     ->orderBy('missionDate', 'desc')
                                     ->take(2)
                                     ->get(),

            'notes'     => Note::where('publiState', 1)
                                     ->orderBy('created_at', 'desc')
                                     ->take(1)
                                     ->get(),
        ];

        if (Auth::user()->level == 0)
            return view('pages/data/waitingHome')->with($data);

        return view('pages/data/home')->with($data);
    }

    public function getOpexs()
    {
        $data = [
          'opexs' => Opex::All()
        ];

        return view('pages/data/opexs')->with($data);
    }

    public function getBriefings($opex)
    {

      $data = [
        'briefings' => $opex == 0 ? Briefing::where('opex_id',null)->get() : Briefing::where('opex_id',$opex)->get(),
        'opex' => Opex::find($opex) ? Opex::find($opex) : null
      ];

      return view('pages/data/briefings')->with($data);
    }

    public function getBriefing($opex,$id)
    {

      $briefing = Briefing::find($id);
      if(!$briefing)
        return redirect()->back()->withErrors('Ce briefing n\'existe pas');

      $users = User::where('level','>',0)->get();
      $waitingUsers = [];
      foreach ($users as $key => $user) {
        if ($briefing->users()->find($user->id))
          continue;
        array_push($waitingUsers,$user->id);
      }

      $data = [
        'briefing' => $briefing,
        'users'    => $users,
        'joiningUsers' => $briefing->users()->having('status','=','1')->get(),
        'waitingUsers' => $waitingUsers
      ];

      return view('pages/data/briefing')->with($data);
    }

    public function changeUserBriefingStatus($id)
    {
      $briefing = Briefing::find($id);
      if(!$briefing)
        return redirect()->back()->withErrors('Ce briefing n\'existe pas');

      if($briefing->missionState == 1)
        return redirect()->back()->withErrors('Cette opération est terminé');

      $user = Auth::user();
      $newStatus = Input::get('status');
      $newStatus = $newStatus ? 1 : 0;

      if ($briefing->users->contains($user)) {
        $status = $briefing->users()->find($user->id);
        $status->pivot->status = $newStatus;
        $status->pivot->save();
      } else {
        $briefing->users()->attach($user, ['status' => $newStatus]);
      }

      return redirect()->back();
    }
}
