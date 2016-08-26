<?php namespace Ekushisu\Wasabi\Http\Controllers\Wasabi;

use Illuminate\Http\Response;
use Ekushisu\Wasabi\Http\Controllers\WasabiController;

use Auth;
use Ekushisu\Wasabi\models\Briefing;
use Ekushisu\Wasabi\models\Note;
use Ekushisu\Wasabi\models\Opex;
use Ekushisu\Wasabi\models\User;
use Ekushisu\Wasabi\models\Category;
use Ekushisu\Wasabi\models\Rank;
use Mail;
use Input;
use Session;
use View;


class AdminController extends WasabiController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getHome()
    {
        $data = [
            'total_users'       => User::all()->count(),
            'total_users_month' => User::where('created_at', '>', Carbon::now()->firstOfMonth())->count()
        ];
        return view('pages/admin/pages/home')->with($data);
    }

    public function getCrew()
    {
        $data = [
            'members' => User::where('level', '>', 0)->where('banned','=',0)->get()
        ];

        return view('pages/admin/pages/members/admin-list')->with($data);
    }

    public function getCrewEdit($id)
    {
      $data = [
        'user' => User::find($id),
        'ranks' => Rank::all()
      ];

      return view('pages/admin/pages/members/admin-edit')->with($data);
    }

    public function postCrewEdit($id)
    {
        $user = User::find($id);
        $user = $this->inputHydratation($user, Input::all());
        $user->save();

        Session::flash('success', "L'utilisateur a été correctement modifié.");
        return redirect()->route('admin.crew.edit', [$id]);
    }

    public function mailCrewEdit($id)
    {
        $user = User::find($id);

        if (Input::has('mail-subject') && Input::has('mail-text'))
        {
            $data = [
                'email' => $user->email,
                'text' => Input::get('mail-text'),
                'subject' => Input::get('mail-subject')
            ];

            Mail::send('emails/send-mail-user', $data, function($message) use ($data)
            {
                $message->from('contact@pie3.2.ga', '[PI 3.II] Garde Républicaine ArmA');
                $message->to($data['email'])->subject($data['subject']);
            });
        }

        Session::flash('success', "Le mail a bien été envoyé à " . $data['email'] . ".");
        return redirect()->back();
    }



    public function getRanks()
    {
      $data = [
        'ranks' => Rank::all()
      ];

      return view('pages/admin/pages/ranks')->with($data);
    }

    public function postRanks()
    {
      $rank = new Rank();
      $rank = $this->inputHydratation($rank, Input::all());
      if (Input::file('rankIcon'))
        $rank->path = $this->uploadImage(Input::file('rankIcon'),'ranks');

      $rank->save();
      Session::flash('success', "Le rang a été correctement créé.");
      return redirect()->back();
    }

    public function updateRank($id)
    {
        $rank = Rank::find($id);

        if(!$rank) {
          Session::flash('error', "Ce rang n'existe pas.");
          return redirect()->back();
        }

        $rank = $this->inputHydratation($rank, Input::all());
        if (Input::file('rankIcon'))
          $rank->path = $this->uploadImage(Input::file('rankIcon'),'ranks');
        $rank->save();
        Session::flash('success', "Le rang a été correctement modifié.");
        return redirect()->back();
    }

    public function deleteRank($id)
    {

        $rank = Rank::find($id);

        if(!$rank) {
          Session::flash('error', "Ce rang n'existe pas.");
          return redirect()->back();
        }

        if ($id == 1) {
          Session::flash('error', "Ce rang ne peut pas être supprimé");
          return redirect()->back();
        }

        foreach ($rank->users as $user) {
          $user->rank_id = 1;
          $user->save();
        }

        $rank->delete();

        Session::flash('success', "Le rang a été correctement supprimé.");
        return redirect()->back();
    }

    public function getAdmissions()
    {

      $data = [
        'users' => User::where('level','=',0)
                         ->where('banned','=',0)
                         ->get(),
        'bannedUsers' => User::where('banned','=',1)->get()
      ];

      return view('pages/admin/pages/admissions')->with($data);
    }

    public function postAdmission($id)
    {

      $user = User::find($id);

      if(!$user) {
        Session::flash('error', "Cette demande d'admission n'existe pas.");
        return redirect()->back();
      }

      if($user->banned) {
        Session::flash('error', "$user->getFullName(true) a des accès précédement révoqués, impossible de valider sa demande d'admission");
        return redirect()->back();
      }

      $user->level = 1;
      $user->save();
      Session::flash('success', "Demande d'admission validée.");
      return redirect()->back();
    }

    public function deleteAdmission($id)
    {

        $user = User::find($id);

        if(!$user) {
          Session::flash('error', "Cette demande d'admission n'existe pas.");
          return redirect()->back();
        }

        if ($user->level != 0) {
          Session::flash('error', "Cette demande d'admission n'existe pas.");
          return redirect()->back();
        }

        $user->delete();

        Session::flash('success', "Demande d'admission relégué avec succès.");
        return redirect()->back();
    }

    public function unbanAdmission($id)
    {
        $user = User::find($id);

        if(!$user) {
          Session::flash('error', "Cette utilisateur n'existe pas.");
          return redirect()->back();
        }

        if ($user->banned != 1) {
          Session::flash('error', "Cette utilisateur n'a pas été révoqué");
          return redirect()->back();
        }

        $user->banned = 0;
        $user->level = 1;
        $user->rank_id = 1;
        $user->save();
        Session::flash('success', "Accès de nouveau accordés");
        return redirect()->back();
    }
}
