<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use Illuminate\Http\Request;

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

        $mark = [];
        $mark[] = [
            'note'=> $note,
            'average'=> ['moyenne' => $avg,
            'avg' => $test]
        ];

        return $mark;

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
        //
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

    public function get_note_average()
    {
        $avg = Note::where('etudiant_id', 2)->avg('note');

        return $data = [
            'moyenne' => $avg
        ];
    }
}
