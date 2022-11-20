<?php

namespace App\Http\Controllers\Inertia\Admin\News;

use App\Enums\ArticleTypeEnums;
use App\Enums\HttpMethodEnums;
use App\Enums\PermissionEnums;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response as SResponse;
use Inertia\Response;

class CreateController extends Controller
{

    public function __invoke(Request $request): Response|RedirectResponse
    {
        if(!Auth::user()->hasPermissionTo(PermissionEnums::NEWS_MANAGE->value)){
            abort(SResponse::HTTP_FORBIDDEN);
        }

        return Inertia::render('Admin/RecordForm', [
            'record' => null,
            'type' => ArticleTypeEnums::NEWS->value,
            'formAction' => route('admin.news.store'),
            'formActionMethod' => HttpMethodEnums::POST->value,
            'title' => 'Create "News" record',
        ]);
    }
}
