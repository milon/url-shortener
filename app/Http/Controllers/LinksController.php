<?php

namespace App\Http\Controllers;

use App\Contracts\UrlShortenerContract;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Jenssegers\Agent\Agent;
use Spatie\ValidationRules\Rules\Delimited;

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
            'url' => 'required|url',
            'hash' => 'nullable|unique:links,hash',
            'allowed_email' => [
                new Delimited('email'),
                Rule::requiredIf($request->has('is_private')),
            ],
        ]);

        $link = $this->urlShortener->make($request->url, $request->hash);

        if ($request->has('is_private')) {
            $link->is_private = true;
            $link->allowed_email = $request->allowed_email;
        } else {
            $link->is_private = false;
            $link->allowed_email = null;
        }
        $link->save();

        return redirect('/')->with([
            'url' => url($link->hash),
        ]);
    }

    public function show(Link $link)
    {
        $visitors = $link->visitors()->paginate(10);

        return view('show', compact('link', 'visitors'));
    }

    public function process($hash)
    {
        $link = $this->urlShortener->byHash($hash);

        if (! $link) {
            return redirect('/')->with(['error' => 'This URL is non existent']);
        }

        if ($link->is_private) {
            if (! $link->isAllowedByPrivateUser(auth()->user())) {
                return redirect('/')->with(['error' => 'This URL is private. Log in with proper email to access.']);
            }
        }

        $agent = new Agent;
        $link->visitors()->create([
            'os'      => $agent->platform(),
            'ip'      => request()->ip(),
            'device'  => $agent->device(),
            'browser' => $agent->browser(),
        ]);

        return redirect()->away($link->url);
    }
}
