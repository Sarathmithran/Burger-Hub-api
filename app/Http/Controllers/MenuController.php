<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'category' => 'sometimes|string',
            'min_price' => 'sometimes|numeric',
            'max_price' => 'sometimes|numeric',
            'sort' => 'sometimes|in:price_asc,price_desc,name_asc,name_desc',
        ]);

        $query = Menu::with('category');
        
        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->category);
            });
        }
        
        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Sorting
        if ($request->has('sort')) {
            $sort = $request->sort;
            if ($sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($sort == 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($sort == 'name_desc') {
                $query->orderBy('name', 'desc');
            }
        }
        
        $menus = $query->get();

        // Add image_url to each menu
        $menus->each(function ($menu) {
            $menu->image = $menu->image_url;
        });
        
        return response()->json($menus);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
        ]);

        $searchTerm = $request->query('query');

        $menus = Menu::where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->with('category')
                    ->get();

        return response()->json($menus);
    }

    public function show($id)
    {
        $menu = Menu::with('category')->find($id);

        if (!$menu) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        // Add full image URL
        $menu->image = $menu->image_url;

        // Fetch 3 related menus from same category (excluding current menu)
        $relatedMenus = Menu::where('category_id', $menu->category_id)
            ->where('id', '!=', $menu->id)
            ->inRandomOrder() // randomize
            ->limit(3)
            ->get()
            ->each(function ($item) {
                $item->image = $item->image_url;
            });

        return response()->json([
            'menu' => $menu,
            'related' => $relatedMenus,
        ]);
    }

}