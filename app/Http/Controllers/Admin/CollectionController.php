<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::withCount('products')
            ->orderBy('type')
            ->orderBy('order')
            ->get();

        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.collections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:shop,energy',
            'description' => 'nullable|string',
            'color_hex' => 'nullable|string|max:7',
            'visual_feeling' => 'nullable|string',
            'color_description' => 'nullable|string',
            'feeling' => 'nullable|string',
            'scent' => 'nullable|string',
            'energy' => 'nullable|string',
            'emotion' => 'nullable|string',
            'element' => 'nullable|string',
            'story' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('collections', 'public');
        }

        Collection::create($data);

        return redirect()->route('admin.collections.index')
            ->with('success', 'Koleksiyon başarıyla oluşturuldu.');
    }

    public function edit(Collection $collection)
    {
        return view('admin.collections.edit', compact('collection'));
    }

    public function update(Request $request, Collection $collection)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:shop,energy',
            'description' => 'nullable|string',
            'color_hex' => 'nullable|string|max:7',
            'visual_feeling' => 'nullable|string',
            'color_description' => 'nullable|string',
            'feeling' => 'nullable|string',
            'scent' => 'nullable|string',
            'energy' => 'nullable|string',
            'emotion' => 'nullable|string',
            'element' => 'nullable|string',
            'story' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($collection->image) {
                Storage::disk('public')->delete($collection->image);
            }
            $data['image'] = $request->file('image')->store('collections', 'public');
        }

        $collection->update($data);

        return redirect()->route('admin.collections.edit', $collection)
            ->with('success', 'Koleksiyon başarıyla güncellendi.');
    }

    public function destroy(Collection $collection)
    {
        if ($collection->products()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Bu koleksiyona ait ürünler var. Önce ürünleri silin veya başka koleksiyona taşıyın.');
        }

        if ($collection->image) {
            Storage::disk('public')->delete($collection->image);
        }

        $collection->delete();

        return redirect()->route('admin.collections.index')
            ->with('success', 'Koleksiyon başarıyla silindi.');
    }
}
