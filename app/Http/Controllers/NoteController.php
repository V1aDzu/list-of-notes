<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use App\Models\User;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::All();
        return view('welcome', compact('notes'));
    }

     /**
     * Display filtered listing of the resource for current user
     */
    public function usernotes()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $user = User::findOrFail($user_id);
        }

        $notes = Note::whereBelongsTo($user)->get();
        return view('dashboard', compact('notes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $note = Note::create([
            'user_id' => Auth::user()->id,
            'text' => $request->text
        ]);

        $note->save();
        return redirect('dashboard')->with('status', 'Note added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return redirect('dashboard')->with('status', 'Note delete successfully!');
    }
}
