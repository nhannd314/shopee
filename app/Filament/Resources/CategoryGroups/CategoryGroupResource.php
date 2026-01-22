<?php

namespace App\Filament\Resources\CategoryGroups;

use App\Filament\Resources\CategoryGroups\Pages\CreateCategoryGroup;
use App\Filament\Resources\CategoryGroups\Pages\EditCategoryGroup;
use App\Filament\Resources\CategoryGroups\Pages\ListCategoryGroups;
use App\Filament\Resources\CategoryGroups\Schemas\CategoryGroupForm;
use App\Filament\Resources\CategoryGroups\Tables\CategoryGroupsTable;
use App\Models\CategoryGroup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryGroupResource extends Resource
{
    protected static ?string $model = CategoryGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArchiveBox;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CategoryGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoryGroupsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategoryGroups::route('/'),
            'create' => CreateCategoryGroup::route('/create'),
            'edit' => EditCategoryGroup::route('/{record}/edit'),
        ];
    }
}
