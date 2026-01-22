<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        $breadcrumb = [
            ['label' => $page->title]
        ];
        return view('page', compact('page', 'breadcrumb'));
    }
}
