<?php

namespace App\Http\Controllers\Inertia\Admin\Blog;

use App\Enums\ArticleTypeEnums;
use App\Enums\PermissionEnums;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as SResponse;
use Illuminate\Http\RedirectResponse;

class IndexController extends Controller
{
    public function __invoke(): Response|RedirectResponse
    {
        if(!Auth::user()->hasPermissionTo(PermissionEnums::BLOG_VIEW->value)){
            abort(SResponse::HTTP_FORBIDDEN);
        }

        $records = Blog::query()->orderBy('created_at', 'desc')
            ->get()
            ->map(function(Blog $record){
                $record->date = $record->created_at?->format('d M Y, H:m:s');
                $record->editRoute = route('admin.blog.edit', $record->id);
                return $record;
            });

        return Inertia::render('Admin/RecordList', [
            'records' => $records,
            'type' => ArticleTypeEnums::BLOG->value,
            'createRoute' => route('admin.blog.create'),
            'title' => '"Blog" records list',
        ]);
    }
}
