<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of services
     */
    public function index()
    {
        $services = Service::active()->get();

        return view('services.index', compact('services'));
    }

    /**
     * Display the specified service
     */
    public function show(Service $service)
    {
        // Only show active services
        if (!$service->is_active) {
            abort(404);
        }

        // Get other services for cross-selling
        $otherServices = Service::active()
            ->where('id', '!=', $service->id)
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'otherServices'));
    }
}
