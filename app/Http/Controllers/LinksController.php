<?php

namespace App\Http\Controllers;

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

    public function process($hash)
    {
        $link = $this->urlShortener->byHash($hash);

        if(! $link) {
            return redirect('/')->withErrors('This URL is non existent');
        }

        return redirect()->away($link->url);
    }
}
