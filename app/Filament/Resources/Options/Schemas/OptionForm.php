<?php

namespace App\Filament\Resources\Options\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class OptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->disabled(),
                // Logic hiển thị Value dựa trên cột Type của record hiện tại
                Group::make()
                    ->schema(function ($record) {
                        // Nếu không có record (đang tạo mới), trả về rỗng hoặc mặc định
                        if (!$record) return [TextInput::make('value')];

                        return match ($record->type) {
                            'text' => [
                                TextInput::make('value')
                                    ->label('Giá trị văn bản')
                                    ->required(),
                            ],
                            'image' => [
                                FileUpload::make('value')
                                    ->label('Hình ảnh')
                                    ->image() // Chỉ cho phép up ảnh
                                    ->disk('public')
                                    ->visibility('public')
                                    ->required(),
                            ],
                            default => [
                                TextInput::make('value'),
                            ],
                        };
                    })
                    ->columnSpanFull(),
            ]);
    }
}
