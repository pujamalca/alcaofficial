<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of portfolio items
     */
    public function index(Request $request)
    {
        $query = PortfolioItem::active();

        // Filter by category if provided
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $portfolioItems = $query->paginate(9);

        // Get unique categories for filtering
        $categories = PortfolioItem::active()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');

        return view('portfolio.index', compact('portfolioItems', 'categories'));
    }

    /**
     * Display the specified portfolio item
     */
    public function show(PortfolioItem $portfolioItem)
    {
        // Only show active portfolio items
        if (!$portfolioItem->is_active) {
            abort(404);
        }

        // Get related portfolio items from same category
        $relatedItems = PortfolioItem::active()
            ->where('id', '!=', $portfolioItem->id)
            ->where('category', $portfolioItem->category)
            ->take(3)
            ->get();

        return view('portfolio.show', compact('portfolioItem', 'relatedItems'));
    }
}
