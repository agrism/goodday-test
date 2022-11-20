<?php

namespace App\Http\Controllers\Inertia\Admin\News;

use App\Enums\ArticleTypeEnums;
use App\Enums\PermissionEnums;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as SResponse;

class IndexController extends Controller
{
    public function __invoke(): Response|RedirectResponse
    {
        if(!Auth::user()->hasPermissionTo(PermissionEnums::NEWS_VIEW->value)){
            abort(SResponse::HTTP_FORBIDDEN);
        }

        $records = News::query()->orderBy('created_at', 'desc')
            ->get()
            ->map(function(News $record){
                $record->date = $record->created_at?->format('d M Y, H:m:s');
                $record->editRoute = route('admin.news.edit', $record->id);
                return $record;
            });

        return Inertia::render('Admin/RecordList', [
            'records' => $records,
            'type' => ArticleTypeEnums::NEWS->value,
            'createRoute' => route('admin.news.create'),
            'title' => '"News" records list',
        ]);
    }
}
