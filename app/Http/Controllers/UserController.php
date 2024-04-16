<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::with('roles')->orderBy('id', 'ASC')->get();
        activity()->log('Akses Menu Role');
        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.comingsoon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function uploadProfileImage(Request $request, $id) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id' => 'required|integer',
        ]);
        $user = User::find($id);
        if ($user->photo_profile) {
            $oldImagePath = public_path('profile-images') . '/' . $user->photo_profile;
            
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $imageName = str_replace(' ', '_', strtolower($user->name)).'.'.$request->image->extension();
        $request->image->move(public_path('profile-images'), $imageName);
    
        $user->photo_profile = $imageName;
        $user->save();
        
        return response()->json(['success' => true]);
    }
}
