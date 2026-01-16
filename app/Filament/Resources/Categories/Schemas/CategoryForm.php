<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
//                SpatieMediaLibraryFileUpload::make('image')
//                    ->disk('public')
//                    ->visibility('public')
//                    ->collection('categories_image') // Tên bộ sưu tập
//                    ->label('Image')
//                    ->image()
//                    ->required(),
            ]);
    }
}
