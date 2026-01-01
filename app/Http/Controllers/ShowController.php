<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShowController extends Controller
{
    public function index()
    {
        $shows = Show::orderBy('date', 'desc')->paginate(12);
        return view('shows.index', compact('shows'));
    }

    public function create()
    {
        return view('shows.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'venue_address' => 'nullable|string|max:255',
            'date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'description' => 'nullable|string',
            'poster_image' => 'nullable|image',
            'google_maps_link' => 'nullable|url',
            'status' => 'required|in:upcoming,sold_out,cancelled,past',
            'base_price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'is_free' => 'nullable|boolean',
        ]);

        $data['is_free'] = (bool) ($request->input('is_free') ?? false);

        // handle poster upload
        if ($request->hasFile('poster_image')) {
            $path = $request->file('poster_image')->store('posters', 'public');
            $data['poster_image'] = str_replace(["\r", "\n"], '', trim(Storage::url($path)));
        }

        $show = Show::create($data);

        return redirect()->route('admin.shows.index')->with('success', 'Show creado.');
    }

    public function show(Show $show)
    {
        return view('shows.show', compact('show'));
    }

    public function edit(Show $show)
    {
        return view('shows.edit', compact('show'));
    }

    public function update(Request $request, Show $show)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'venue_address' => 'nullable|string|max:255',
            'date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'description' => 'nullable|string',
            'poster_image' => 'nullable|image',
            'google_maps_link' => 'nullable|url',
            'status' => 'required|in:upcoming,sold_out,cancelled,past',
            'base_price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'is_free' => 'nullable|boolean',
        ]);

        $data['is_free'] = (bool) ($request->input('is_free') ?? false);

        if ($request->hasFile('poster_image')) {
            if (! empty($show->poster_image)) {
                $oldPath = ltrim(str_replace('/storage/', '', $show->poster_image), '/');
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('poster_image')->store('posters', 'public');
            $data['poster_image'] = str_replace(["\r", "\n"], '', trim(Storage::url($path)));
        }

        $show->update($data);

        return redirect()->route('admin.shows.index')->with('success', 'Show actualizado.');
    }

    public function destroy(Show $show)
    {
        if (! empty($show->poster_image)) {
            $oldPath = ltrim(str_replace('/storage/', '', $show->poster_image), '/');
            Storage::disk('public')->delete($oldPath);
        }

        $show->delete();
        return redirect()->route('admin.shows.index')->with('success', 'Show eliminado.');
    }
}
