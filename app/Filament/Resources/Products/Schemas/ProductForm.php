<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([ // Cho phép thêm nhanh danh mục mới ngay tại đây
                        TextInput::make('name')
                            ->required(),
                    ])
                    ->required(),
                TextInput::make('name')
                    ->required(),
                Section::make('Image')
                    ->columnSpanFull()
                    ->schema([
                        // Gallery
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->disk('public')
                            ->visibility('public')
                            ->collection('products_gallery') // Tên bộ sưu tập khác
                            ->label('Thư viện ảnh')
                            ->multiple() // Cho phép chọn nhiều
                            ->reorderable() // Cho phép kéo thả sắp xếp thứ tự
                            ->image()
                            ->maxFiles(6)
                            ->panelLayout('grid')
                            //->imagePreviewHeight('150')
                        ,
                    ]),
                RichEditor::make('description')
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'min-height: 300px;', // Cách viết trực tiếp bằng CSS
                    ]),
                TextInput::make('sku'),
                TextInput::make('cost_price')
                    ->numeric()
                    ->prefix('VND'),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('VND'),
                TextInput::make('sale_price')
                    ->numeric()
                    ->prefix('VND'),
                TextInput::make('stock')
                    ->numeric(),
                TextInput::make('sold_count')
                    ->numeric(),
                TextInput::make('rank')
                    ->numeric(),

            ]);
    }
}
