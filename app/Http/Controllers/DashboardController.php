<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $links = Link::where('user_id', auth()->id())->paginate(10);

        return view('home', compact('links'));
    }
}
