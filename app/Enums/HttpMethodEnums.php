<?php

namespace App\Enums;

enum HttpMethodEnums: string
{
    case POST = 'POST';
    case PUT = 'PUT';
    case GET = 'GET';
    case PATCH = 'PATCH';
    case DELETE = 'DELETE';
}
