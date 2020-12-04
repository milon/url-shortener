<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'url' => $this->url,
            'hash' => $this->hash,
            'is_private' => $this->is_private,
            'allowed_email' => $this->when($this->is_private, collect(explode(',', $this->allowed_email))
                ->transform(function ($item) {
                    return trim($item);
                })->all()
            ),
            'created_at' => $this->created_at->format('d-m-Y H:s'),
            'user' => $this->user ? new UserResource($this->user) : null,
        ];
    }
}
