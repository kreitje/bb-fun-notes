<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Notes\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $notes = Note::where('user_id' ,'=', auth()->user()->id)
                     ->get();

        if ($request->ajax()) {
            return $notes;
        }

        return view('notes.index', compact('notes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'note' => 'required'
        ]);

        $note = new Note;
        $note->user_id = auth()->user()->id;
        $note->note = $request->get('note');
        $note->width = (int)$request->get('width', 0);
        $note->height = (int)$request->get('height', 0);
        $note->save();

        return $note;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'note' => 'required'
        ]);

        $note = Note::where('user_id', '=', auth()->user()->id)
                    ->where('id', '=', $id)
                    ->firstOrFail();

        $note->note = $request->get('note');
        $note->save();

        return $note;
    }

    public function destroy($id)
    {
        $note = Note::where('user_id', '=', auth()->user()->id)
            ->where('id', '=', $id)
            ->firstOrFail();

        $note->delete();

        return response()->json();
    }
}