<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Imports\ProductsImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),

            // Thêm nút Import Excel
            Action::make('importProducts')
                ->label('Nhập Excel')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success')
                ->schema([
                    FileUpload::make('attachment')
                        ->label('Chọn file Excel (.xlsx hoặc .csv)')
                        ->disk('local') // Lưu tạm
                        ->directory('temp-imports')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $filePath = Storage::disk('local')->path($data['attachment']);

                    try {
                        Excel::import(new ProductsImport, $filePath);
                        Storage::disk('local')->delete($data['attachment']);

                        Notification::make()
                            ->title('Thành công')
                            ->body('Đã nhập dữ liệu sản phẩm và cập nhật danh mục.')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Lỗi hệ thống')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
