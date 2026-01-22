<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    // Thêm đoạn script vào cuối trang này bằng cách sử dụng @push
    public function getFooter(): ?\Illuminate\Contracts\View\View
    {
        return view('filament.settings.custom-js-category-create');
    }
}
