<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //this funciton is to display the grades of the student, api: api/note
    public function resultat($id) {
        $note = Etudiant::with([
            'notes' => function($query) use($id) {
            $query->where('etudiant_id', $id)->with('module');
        }])
        
            ->where('id', $id)
            ->get();

        
        $test = 'hello';
        $avg = Note::where('etudiant_id', $id)->avg('note');

        return $note;

    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $module = Note::find(1)->module;

        $note = Note::create([
            'note' => $request->note,
            'etudiant_id' => $request->etudiant_id,
            'module_id' => $request->module_id,
        ]);

        if ($note) {
            return ([
                'success' => true,
                'message' => 'grades successfully added.'
            ]);
        } else {
            return ([
                'success' => false,
                'message' => 'error while inserting datas.'
            ]);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $module = Note::where('module_id', 1)->get();

        $request->validate([
        ]);

        $note->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }

    public function get_note_average($id)
    {
        $avg = DB::table('notes')
            ->select(DB::raw('avg(note) as moyenne, etudiant_id'))
            ->groupBy('etudiant_id')
            ->where('etudiant_id', $id)
            ->get();

        return $avg;
    }
}
