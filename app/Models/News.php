<?php

namespace App\Models;

use App\Enums\ArticleTypeEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Blog
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'articles';

    protected static function getType(): string
    {
        return ArticleTypeEnums::NEWS->value;
    }
}
