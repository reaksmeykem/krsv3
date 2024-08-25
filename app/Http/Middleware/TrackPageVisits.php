<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageVisit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress =  Hash::make($request->ip());
        $pageUrl = $request->path();
        $currentDateTime = Carbon::now();

        // Check if a visit exists within the last 12 hours
        $visit = PageVisit::where('ip_address', $ipAddress)
            ->where('page_url', $pageUrl)
            ->where('visited_at', '>=', $currentDateTime->subHours(12))
            ->first();

        if (!$visit) {
            // If no recent visit, record a new visit
            PageVisit::create([
                'ip_address' => $ipAddress,
                'page_url' => $pageUrl,
                'visited_at' => Carbon::now(),
            ]);
        }

        return $next($request);
    }
}
