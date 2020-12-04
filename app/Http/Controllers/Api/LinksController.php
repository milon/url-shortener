<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UrlShortenerContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\LinkResource;
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

    public function byHash($hash)
    {
        $link = $this->urlShortener->byHash($hash);

        if (! $link) {
            return response()->json([
                'error'   => true,
                'message' => "Provided hash doesn't exists.",
            ], 404);
        }

        if ($link->is_private) {
            if (! $link->isAllowedByPrivateUser(auth()->user()) && auth()->id() !== $link->user_id) {
                return response()->json([
                    'error'   => true,
                    'message' => 'Provided link is private. Use proper authorization key.',
                ], 403);
            }
        }

        $agent = new Agent;
        $link->visitors()->create([
            'os'      => $agent->platform(),
            'ip'      => request()->ip(),
            'device'  => $agent->device(),
            'browser' => $agent->browser(),
        ]);

        return response()->json([
            'error' => false,
            'link' => new LinkResource($link),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'hash' => 'nullable|unique:links,hash',
            'is_private' => 'required|boolean',
            'allowed_email' => [
                new Delimited('email'),
                Rule::requiredIf($request->is_private),
            ],
        ]);

        $link = $this->urlShortener->make($request->url, $request->hash);
        $link->is_private = $request->is_private;
        $link->allowed_email = $request->allowed_email ?: null;
        $link->save();

        return response()->json([
            'error' => false,
            'link' => new LinkResource($link),
        ], 201);
    }
}
