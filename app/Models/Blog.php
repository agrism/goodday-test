<?php

namespace App\Models;

use App\Enums\ArticleTypeEnums;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string $slug
 * @property string $short_description
 * @property string $text
 * @property string $user_id
 * @property string $minutes_to_read
 */
class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftDeletes;

    protected const READING_WORDS_PER_MINUTE = 200;

    protected $table = 'articles';

    public static function boot(): void
    {
        parent::boot();

        self::saving(function ($model) {
            $model->type = static::getType();
            $model->slug = Str::slug($model->title);
            $model->minutes_to_read = ceil(
                str_word_count(
                    sprintf('%s %s %s', $model->title, $model->short_description, $model->text)
                ) / static::READING_WORDS_PER_MINUTE
            );
        });
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    protected static function booted(): void
    {
        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', static::getType());
        });
    }

    protected static function getType(): string
    {
        return ArticleTypeEnums::BLOG->value;
    }
}

