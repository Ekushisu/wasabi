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
use Input;
use Session;
use View;

class ContentController extends WasabiController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getNotes()
    {
        $data = [
          'notes' => Note::all(),
          'categories' => Category::all()
        ];
        return view('pages/admin/pages/content/notes')->with($data);
    }

    public function postNote()
    {
      $note = new Note();
      $note = $this->inputHydratation($note, Input::all());
      if (Input::file('thumbnail'))
        $note->thumbnail = $this->uploadImage(Input::file('thumbnail'),'notes');
      $note->author_id = Auth::user()->id;
      $note->save();
      Session::flash('success', "La note a été correctement créé.");
      return redirect()->back();
    }

    public function deleteNote($id)
    {
        $note = Note::find($id);

        if(!$note) {
          Session::flash('error', "Cette note n'existe pas.");
          return redirect()->back();
        }

        $note->delete();

        Session::flash('success', "Note supprimée avec succès.");
        return redirect()->back();
    }

    public function getNote($id)
    {
        $note = Note::find($id);

        if(!$note) {
          Session::flash('error', "Cette note n'existe pas.");
          return redirect()->back();
        }

        $data = [
          'note' => $note,
          'categories' => Category::all()
        ];
        return view('pages/admin/pages/content/note')->with($data);
    }

    public function updateNote($id)
    {
        $note = Note::find($id);

        if(!$note) {
          Session::flash('error', "Cette note n'existe pas.");
          return redirect()->back();
        }

        $note = $this->inputHydratation($note, Input::all());
        if (Input::file('thumbnail'))
          $note->thumbnail = $this->uploadImage(Input::file('thumbnail'),'notes');
        $note->save();

        Session::flash('success', "Le rang a été correctement modifié.");
        return redirect()->back();
    }

    public function postCategory()
    {
      $category = new Category();
      $category = $this->inputHydratation($category, Input::all());
      $category->save();
      Session::flash('success', "La catégorie a été correctement créé.");
      return redirect()->back();
    }

    public function deleteCategory($id)
    {
      $category = Category::find($id);

      if(!$category) {
        Session::flash('error', "Cette catégorie n'existe pas.");
        return redirect()->back();
      }

      foreach ($category->notes as $note) {
        $note->category_id = null;
        $note->save();
      }

      $category->delete();

      Session::flash('success', "Catégorie supprimée avec succès.");
      return redirect()->back();
    }

    public function getBriefings()
    {
        $data = [
          'briefings' => Briefing::all(),
          'opexs' => Opex::all()
        ];
        return view('pages/admin/pages/content/briefings')->with($data);
    }

    public function postBriefing()
    {
      $briefing = new Briefing();
      $briefing = $this->inputHydratation($briefing, Input::all());
      if (Input::file('thumbnail'))
        $briefing->thumbnail = $this->uploadImage(Input::file('thumbnail'),'briefing');

      if (Input::get('at-missionDate')) {
        $briefing->missionDate = DateTime::createFromFormat('!d/m/Y', Input::get('at-missionDate'))->getTimestamp();
      }

      $briefing->save();
      Session::flash('success', "Le briefing a été correctement créé.");
      return redirect()->back();
    }

    public function deleteBriefing($id)
    {
      $briefing = Briefing::find($id);

      if(!$briefing) {
        Session::flash('error', "Ce briefing n'existe pas.");
        return redirect()->back();
      }

      $briefing->delete();

      Session::flash('success', "Briefing supprimé avec succès.");
      return redirect()->back();
    }

    public function getOpex($id)
    {
        $data = [
          'opex' => Opex::find($id)
        ];
        return view('pages/admin/pages/content/opex')->with($data);
    }

    public function postOpex()
    {
      $opex = new Opex();
      $opex = $this->inputHydratation($opex, Input::all());
      $opex->save();
      Session::flash('success', "L'Opex a été correctement créé.");
      return redirect()->back();
    }

    public function updateOpex($id)
    {
        $opex = Opex::find($id);

        if(!$opex) {
          Session::flash('error', "Cette opex n'existe pas.");
          return redirect()->back();
        }

        $opex = $this->inputHydratation($opex, Input::all());
        if (Input::file('thumbnail'))
          $opex->thumbnail = $this->uploadImage(Input::file('thumbnail'),'opex');
        $opex->save();

        Session::flash('success', "L'opex a été correctement modifié.");
        return redirect()->back();
    }

    public function deleteOpex($id)
    {
      $opex = Opex::find($id);

      if(!$opex) {
        Session::flash('error', "Cette catégorie n'existe pas.");
        return redirect()->back();
      }

      foreach ($opex->briefings as $briefing) {
        $briefing->opex_id = null;
        $briefing->save();
      }

      $opex->delete();

      Session::flash('success', "Opex supprimée avec succès.");
      return redirect()->back();

    }
}
