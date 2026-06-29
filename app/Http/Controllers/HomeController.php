<?php

namespace App\Http\Controllers;

use App\Models\NavCategory;
use App\Models\NavLink;

class HomeController extends Controller
{
    public function index()
    {
        $categories = NavCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->with(['links' => fn ($q) => $q->where('is_active', true)])
            ->get();

        $featured = NavLink::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        $links = NavLink::with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn ($link) => [
                'id' => $link->id,
                'name' => $link->name,
                'url' => $link->url,
                'description' => $link->description,
                'tags' => $link->tags ?? [],
                'isFeatured' => $link->is_featured,
                'isDomestic' => $link->is_domestic,
                'categoryId' => $link->nav_category_id,
                'categoryName' => $link->category->name,
                'categoryIcon' => $link->category->icon,
                'categorySlug' => $link->category->slug,
            ]);

        return view('home.index', [
            'categories' => $categories,
            'featured' => $featured,
            'links' => $links,
            'site' => config('aihub.site'),
        ]);
    }
}
