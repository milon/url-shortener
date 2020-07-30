<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $links = Link::where('user_id', auth()->id())->withCount('visitors')->paginate(10);

        return view('user.dashboard', compact('links'));
    }

    public function settings()
    {
        return view('user.settings', [
            'user' => auth()->user(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'confirmed|min:8|nullable',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect('/settings')->with([
            'message' => 'User profile updated.',
        ]);
    }

    public function generateToken(Request $request)
    {
        $user = auth()->user();
        $user->api_token = Str::random(30);
        $user->save();

        return redirect('/settings')->with([
            'message' => 'New API token created successfully.',
        ]);
    }
}
