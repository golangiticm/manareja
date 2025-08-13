<?php

namespace App\Http\Controllers;

use App\Models\GalleryVideo;
use Illuminate\Http\Request;

class GalleryVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $eventable_type)
    {
        // untuk gallery video
        $queryVideo = GalleryVideo::query()
            ->where('eventable_type', $eventable_type)->where('is_publish', true);

        if ($request->filled('video_search')) {
            $video_search = $request->video_search;
            $queryVideo->where(function ($q) use ($video_search) {
                $q->where('title', 'like', "%{$video_search}%");
            });
        }

        $Videoitems = $queryVideo->latest()->paginate(6);

        $VideorecentPosts = GalleryVideo::where('is_publish', true)->where('eventable_type', $eventable_type)->latest()->take(5)->get();

        return view('components.web.gallery-video', compact('Videoitems', 'VideorecentPosts', 'eventable_type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
