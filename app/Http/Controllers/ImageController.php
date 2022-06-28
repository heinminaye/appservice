<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $post = new Post();
        $post->id = 0;
        $post->exists = true;
        $image = $post->addMediaFromRequest(key: 'upload')->toMediaCollection(collectionName: 'images');
        return response()->json([
            'url' => $image->getUrl(conversionName: 'thumb')
        ]);
    }
}