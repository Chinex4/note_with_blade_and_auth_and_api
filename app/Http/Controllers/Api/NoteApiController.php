<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;

class NoteApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NoteResource::collection(Note::latest()->paginate(10));
        // return response()->json(Note::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $createNote = $request->validate([
            'notes' => 'required|string|min:10|max:2500',
            'image' => 'nullable|image|mimes:jpg,png,gif,jpeg|max:6084'
        ]);

        if($request->hasFile('image')){
            $createNote['image'] = $request->file('image')->store('images', 'public');
        }
        else{
            $createNote['image'] = 'images/default-blog.jpg';
        }
        // $createNote['user_id'] = $request->user()->id;
        $createNote['user_id'] = 3;

        $note = Note::create($createNote);

        return NoteResource::make($note);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return NoteResource::make($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $updateNote = $request->validate([
            'notes' => 'required|string|min:10|max:2500',
            'image' => 'nullable|image|mimes:jpg,png,gif,jpeg|max:6084'
        ]);

        if($request->hasFile('image')){
            $updateNote['image'] = $request->file('image')->store('images', 'public');
        }

        $updateNote['user_id'] = 3;

        $note->update($updateNote);

        return NoteResource::make($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return NoteResource::collection(Note::latest()->paginate());
    }
}
