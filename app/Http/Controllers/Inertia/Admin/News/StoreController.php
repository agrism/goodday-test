<?php

namespace App\Http\Controllers\Inertia\Admin\News;

use App\Enums\PermissionEnums;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as SResponse;
use Inertia\Response;

class StoreController extends Controller
{
    public function __invoke(Request $request, IndexController $controller): Response|RedirectResponse
    {
        if(!Auth::user()->hasPermissionTo(PermissionEnums::NEWS_MANAGE->value)){
            abort(SResponse::HTTP_FORBIDDEN);
        }
        Validator::make($request->only(['title', 'short_description', 'text']), [
            'title' => ['required', 'string', 'max:100'],
            'short_description' => ['required', 'string', 'max:255'],
            'text' => [],
        ])->validateWithBag('handleRecord');

        /** @var News $record */
        $record = new News;

        $record->title = $request->input('title');
        $record->short_description = $request->input('short_description');
        $record->text = $request->input('text');
        $record->user_id = Auth::user()->id;
        $record->save();

        return $controller();
    }
}
