<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $activities = Activity::feed(auth()->user());

        return view('pages.profile.show', compact('user', 'activities'));
    }
}
