<?php

namespace App\Http\Controllers\Inertia\News;

use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController as InertiaUserProfileController;
use Laravel\Jetstream\Jetstream;
use Inertia\Response;

class ShowController extends InertiaUserProfileController
{
    public function __invoke(Request $request, string $slug): Response|RedirectResponse
    {
        if(!$post = News::query()->with('user')->where('slug', $slug)->first()){
            return Inertia::location('/');
        }

        $post->href = route('news.show', $post->id);
        $post->imageUrl = 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80';
        $post->author = (object)[
            'name' => $post?->user?->name,
            'href' => '#',
            'imageUrl' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',

        ];
        $post->description = $post?->short_description;
        $post->date = $post->created_at?->format('M d, Y');
        $post->datetime = $post->created_at?->format('Y-m-d');
        $post->text = nl2br($post->text);
        $post->readingTime = $post->minutes_to_read;

        return Jetstream::inertia()->render($request, 'LandingPageRecordShow', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'post' => $post->getAttributes(),
            'head' => 'News: '.$post->title,
            'subHead' => '',
        ]);
    }
}
