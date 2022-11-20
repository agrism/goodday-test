<?php

namespace App\Http\Controllers\Inertia\Admin\News;

use App\Enums\ArticleTypeEnums;
use App\Enums\HttpMethodEnums;
use App\Enums\PermissionEnums;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as SResponse;

class EditController extends Controller
{
    public function __invoke(int $id): Response|RedirectResponse
    {
        if(!Auth::user()->hasPermissionTo(PermissionEnums::NEWS_MANAGE->value)){
            abort(SResponse::HTTP_FORBIDDEN);
        }

        /** @var News $record */
        $record = News::query()->where('id', $id)->first();

        return Inertia::render('Admin/RecordForm', [
            'record' => $record,
            'type' => ArticleTypeEnums::NEWS->value,
            'formAction' => route('admin.news.update', $record->id),
            'formActionMethod' => HttpMethodEnums::PUT->value,
            'title' => 'Edit "News" record',
        ]);
    }
}
