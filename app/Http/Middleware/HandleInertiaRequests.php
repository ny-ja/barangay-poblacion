<?php

namespace App\Http\Middleware;

use App\Models\News;
use Inertia\Middleware;
use Illuminate\Http\Request;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        // Retrieve the description of the latest news item
        $latestNews = News::orderBy('created_at', 'desc')
                                     ->value('description');

        // return array_merge(parent::share($request), [
        //     'latestNews' => $latestNews,
        // ]);

        $apiKey = env('GOOGLE_MAPS_API_KEY');

        return array_merge(parent::share($request), [
            'latestNews' => $latestNews,
            'apiKey' => $apiKey, // Share the API key with all Inertia pages
        ]);
    }
}
