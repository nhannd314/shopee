<?php

namespace App\Filament\Resources\Slides\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
                SpatieMediaLibraryFileUpload::make('image')
                    ->disk('public')
                    ->visibility('public')
                    ->collection('slides_image') // Tên bộ sưu tập
                    ->label('Image')
                    ->image()
                    ->required(),
            ]);
    }
}
