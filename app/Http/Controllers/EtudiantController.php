<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Niveau;
use App\Models\Modules;
use App\Models\Note;

class EtudiantController extends Controller
{
    public function index() {
        
    }

    public function details($id) {
        
    }

    public function update($request, $id) {
        $info = Etudiant::findOrFail($id)->update(
            ['nom' => $request->nom,
            'prenom' => $request->prenom]
        );
        return redirect()->route('etudiant');
    }
    public function store(Request $request) {
        $request -> validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'matricule' => ['required'],
            'genre' => ['required'],
            'groupe' => ['required'],
            'niveau_id' => ['required'],
        ]);

        Etudiant::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'matricule' => $request->matricule,
            'genre' => $request->genre,
            'groupe' => $request->groupe,
            'niveau_id' => $request->niveau_id,
        ]);
    }

    public function get_student() {
        $student = Etudiant::all();
        return $student;
    }

    public function all_etudiant() {
        //$notes = Etudiant::find(1)->notes->where("module_id", $id);
        $etudiant = Etudiant::where('niveau_id', 1)->get();
        //api = api/all
        $note = Etudiant::join('notes', 'notes.etudiant_id', '=', 'etudiants.id')
            ->join('modules', 'notes.module_id', '=', 'modules.id')
            ->distinct('matricule')
            ->get(['notes.*', 'etudiants.*', 'modules.*'])
            ->where('etudiant_id', '<', 10)
            ->groupBy('etudiant_id');
        
        return $etudiant;
    }

    // api/note_etu
    public function note_etudiant($id) {
        $note = Etudiant::with([
            'notes' => function($query) {
            $query->where('note', '<', 10)->with('module');
         }])
            ->where('niveau_id', $id)
            ->get();

        $etudiant = Etudiant::where('id', 1)->get();

        return $note;
    }
}
