<?php

namespace App\Enums;

enum PermissionEnums: string
{
    case NEWS_VIEW = 'news view';
    case NEWS_MANAGE = 'news manage';

    case BLOG_VIEW = 'blog view';
    case BLOG_MANAGE = 'blog manage';
}
