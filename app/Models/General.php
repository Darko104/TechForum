<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;

    public static function incrementView($id, $page = 'pages') {
        \DB::table($page)->where('id', '=', $id)->increment('views', 1);
    }
    public static function pagination($request, $items, $numberPerPage) {
        if ($request->has('pagination')) {
            $page = (int)$request->pagination;
        }
        else {
            $page = 0;
        }
        $numberOfThreads = count($items);
        $numberOfPages = ceil($numberOfThreads / $numberPerPage);
        $items = array_slice($items, $page * $numberPerPage, $numberPerPage);

        return [$numberOfPages, $items];
    }
}
