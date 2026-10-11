<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GlincheClient
{
    private function url(string $path): string
    {
        return rtrim(config('services.glinche.url'), '/') . '/api/partners/v2' . $path;
    }

    private function token(): string
    {
        return Cache::remember('glinche_token', now()->addMinutes(30), function () {
            $res = Http::acceptJson()
                ->post($this->url('/login'), [
                    'email' => config('services.glinche.email'),
                    'password' => config('services.glinche.password'),
                ])
                ->throw();

            return $res->json('token');
        });
    }

    public function vehicles(): array
    {
        $res = Http::withToken($this->token())
            ->acceptJson()
            ->get($this->url('/vehicles'))
            ->throw();

        return $res->json('data') ?? $res->json();
    }
}
