<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GlincheClient
{
    private function url(string $path): string
    {
        return rtrim(config('services.glinche.url'), '/')
            . '/api/partners/v2'
            . $path;
    }

    private function token(): string
    {
        return Cache::remember(
            'glinche_token',
            now()->addMinutes(30),
            function () {
                $res = Http::acceptJson()
                    ->post($this->url('/login'), [
                        'email' => config('services.glinche.email'),
                        'password' => config('services.glinche.password'),
                    ])
                    ->throw();

                return $res->json('token');
            }
        );
    }

    /**
     * Récupère la liste résumée des véhicules.
     */
    public function vehicles(): array
    {
        $res = Http::withToken($this->token())
            ->acceptJson()
            ->get($this->url('/vehicles'))
            ->throw();

        return $res->json('data') ?? $res->json();
    }

    /**
     * Récupère un véhicule avec ses informations détaillées.
     */
    public function vehicle(string $id): array
    {
        $res = Http::withToken($this->token())
            ->acceptJson()
            ->get($this->url('/vehicles/' . urlencode($id)))
            ->throw();

        return $res->json('data') ?? [];
    }


    /**
     * Récupère les détails de chaque véhicule de la liste.
     */
    public function detailedVehicles(): array
    {
        $vehicles = $this->vehicles();
        $detailedVehicles = [];

        foreach ($vehicles as $vehicle) {
            $id = $vehicle['id'] ?? $vehicle['reference'] ?? null;

            if ($id === null) {
                continue;
            }

            $detailedVehicles[] = $this->vehicle((string) $id);
        }

        return $detailedVehicles;
    }
}
