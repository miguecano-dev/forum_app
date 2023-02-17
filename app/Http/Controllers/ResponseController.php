<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ResponseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'response' => 'required',
            'image' => 'image|max:2048'
        ]);
        
        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public');
            } else {
                $imagePath = null;
            }
            $response = Response::create([
                'response' => $validated['response'],
                'image' => $imagePath,
                'post_id' => (int) $request['post_id'],
                'user_id' => Auth::id()
            ]);
            return redirect('/post/'.$request['post_id'])->with('status', 'Response created successfully');
        } catch (\InvalidArgumentException ) {
            dd('aca');
        }   
        
    }
}
