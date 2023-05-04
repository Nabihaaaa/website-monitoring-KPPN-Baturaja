<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManagerStatic as Image;


class ProfileUserController extends Controller
{
    
    public function index()
    {
        $user = auth()->user();
       
        return View::make('profile.user', compact('user'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show()
    {
       $user = auth()->user();
       
        return View::make('profile.my-profile', compact('user'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
