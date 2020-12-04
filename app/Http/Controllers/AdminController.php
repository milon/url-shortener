<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function links()
    {
        $links = Link::with('user')->withCount('visitors')->paginate(10);

        return view('admin.links', compact('links'));
    }

    public function users()
    {
        $users = User::withCount('links')->paginate(10);

        return view('admin.users', compact('users'));
    }
}
