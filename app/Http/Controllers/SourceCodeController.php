<?php

namespace App\Http\Controllers;

use App\Models\SourceCode;
use App\Models\SourceCodeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SourceCodeController extends Controller
{
    public function index(Request $request)
    {
        $categories = SourceCodeCategory::query()
            ->active()
            ->ordered()
            ->get();

        $query = SourceCode::query()
            ->active()
            ->ordered()
            ->with('category');

        $selectedCategory = $request->query('kategori');
        if ($selectedCategory) {
            $query->whereHas('category', function ($categoryQuery) use ($selectedCategory) {
                $categoryQuery->where('slug', $selectedCategory);
            });
        }

        $search = $request->query('q');
        if ($search) {
            $query->where(function ($searchQuery) use ($search) {
                $searchQuery
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $sourceCodes = $query->paginate(9)->withQueryString();

        return view('source-code.index', [
            'sourceCodes' => $sourceCodes,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'searchQuery' => $search,
        ]);
    }

    public function show(SourceCode $sourceCode)
    {
        $sourceCode->incrementViews();

        $relatedSourceCodes = SourceCode::query()
            ->active()
            ->where('id', '!=', $sourceCode->id)
            ->when(
                $sourceCode->category_id,
                fn ($relatedQuery) => $relatedQuery->where('category_id', $sourceCode->category_id)
            )
            ->ordered()
            ->take(3)
            ->get();

        return view('source-code.show', [
            'sourceCode' => $sourceCode->load('category'),
            'relatedSourceCodes' => $relatedSourceCodes,
        ]);
    }
}

