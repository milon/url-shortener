<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Contracts\UrlShortenerContract;

class LinksController extends Controller
{
    protected $urlShortener;

    public function __construct(UrlShortenerContract $urlShortener)
    {
        $this->urlShortener = $urlShortener;
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $link = $this->urlShortener->make($request->url);

        return redirect('/')->with([
            'url' => url($link->hash)
        ]);
    }

    public function show(Link $link)
    {
        $link->load('visitors');

        return view('show', compact('link'));
    }

    public function process($hash)
    {
        $link = $this->urlShortener->byHash($hash);

        if(! $link) {
            return redirect('/')->withErrors('This URL is non existent');
        }

        return redirect()->away($link->url);
    }
}
