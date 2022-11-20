<?php

namespace App\Http\Controllers\Inertia\Admin\Blog;

use App\Enums\ArticleTypeEnums;
use App\Enums\HttpMethodEnums;
use App\Enums\PermissionEnums;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response as SResponse;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class EditController extends Controller
{
    public function __invoke(int $id): Response|RedirectResponse
    {
        if(!Auth::user()->hasPermissionTo(PermissionEnums::BLOG_MANAGE->value)){
            abort(SResponse::HTTP_FORBIDDEN);
        }

        /** @var Blog $record */
        $record = Blog::query()->where('id', $id)->first();

        return Inertia::render('Admin/RecordForm', [
            'record' => $record,
            'type' => ArticleTypeEnums::BLOG->value,
            'formAction' => route('admin.blog.update', $record->id),
            'formActionMethod' => HttpMethodEnums::PUT->value,
            'title' => 'Edit "Blog" record',
        ]);
    }
}
