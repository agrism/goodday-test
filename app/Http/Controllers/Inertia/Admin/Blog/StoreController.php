<?php

namespace App\Http\Controllers\Inertia\Admin\Blog;

use App\Enums\PermissionEnums;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as SResponse;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(Request $request, IndexController $controller): Response|RedirectResponse
    {
        if(!Auth::user()->hasPermissionTo(PermissionEnums::BLOG_MANAGE->value)){
            abort(SResponse::HTTP_FORBIDDEN);
        }

        Validator::make($request->only(['title', 'short_description', 'text']), [
            'title' => ['required', 'string', 'max:100'],
            'short_description' => ['required', 'string', 'max:255'],
            'text' => [],
        ])->validateWithBag('handleRecord');

        $record = new Blog;

        $record->title = $request->input('title');
        $record->short_description = $request->input('short_description');
        $record->text = $request->input('text');
        $record->user_id = Auth::user()->id;
        $record->save();

        return $controller();
    }
}
