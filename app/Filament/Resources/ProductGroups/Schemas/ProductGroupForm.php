<?php

namespace App\Filament\Resources\ProductGroups\Schemas;

use App\Models\Category;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                CheckboxList::make('category_ids')
                    ->label('Chọn danh mục sản phẩm')
                    ->options(Category::all()->pluck('name', 'id')) // Lấy toàn bộ danh mục
                    ->columns(4) // Chia làm 3 cột cho dễ nhìn nếu danh mục nhiều
                    ->gridDirection('vertical')
                    ->searchable() // Quan trọng: Giúp tìm kiếm nhanh khi danh mục quá nhiều
                    ->bulkToggleable() // Cho phép chọn nhanh tất cả
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
