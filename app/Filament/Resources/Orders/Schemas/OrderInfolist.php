<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Order;
use Filament\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('customer_name'),
                TextEntry::make('phone'),
                TextEntry::make('shipping_address'),
                TextEntry::make('note')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Order $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                RepeatableEntry::make('orderItems') // Giả sử quan hệ là orderItems
                    ->label('')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('product.name')->label('Sản phẩm'),
                        ImageEntry::make('product.featured_image')->label('Ảnh'),
                        TextEntry::make('price')->label('Đơn giá')->money('VND'),
                        TextEntry::make('quantity')->label('Số lượng'),
                        TextEntry::make('subtotal')
                            ->label('Thành tiền')
                            ->state(fn ($record) => $record->price * $record->quantity)
                            ->money('VND'),
                    ])->columns(5),
                TextEntry::make('total_amount')
                    ->money('VND'),
                TextEntry::make('status'),
                Action::make('ship')
                    ->label('Giao hàng')
                    ->color('info')
                    ->hidden(fn ($record) => $record->status !== 'pending')
                    ->action(fn($record) => $record->update(['status' => 'shipping'])),
            ]);
    }
}
