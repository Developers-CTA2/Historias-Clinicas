<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile_View()
    {
        $breadcrumbs = [
            ['name' => 'Mi perfil', '' => ''],

        ];

        return view('profile.Details-profile',   compact('breadcrumbs'));
    }
}
