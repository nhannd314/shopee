<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.footer_text',
            'Siêu thị mini - cửa hàng tiện ích KMax<br>
            Số giấy phép DKKD: ...<br>
            Cấp ngày ... tại ...<br>
            Địa chỉ: Thạch An, Kim Tân, Thanh Hóa (đối diện nhà máy giày Thạch Định)<br>
            Hotline: <a href="tel:0979198880">097-919-8880</a> | <a href="tel:0888112626">0888-11-2626</a><br>
            Facebook: <a href="https://www.facebook.com/sieuthikmax" target="_blank" rel="nofollow">Siêu thị KMax</a><br>
            Website: <a href="https://www.kmax.com.vn" target="_blank" rel="nofollow">https://kmax.com.vn</a>');

        $this->migrator->add('general.search_tags', 'Dầu ăn, Nước mắm,Bánh mì, Nước ngọt, Cà phê');
        $this->migrator->add('general.facebook', 'https://www.facebook.com/sieuthikmax');
        $this->migrator->add('general.tiktok', 'https://tiktok.com/@kmax.vn');

        $this->migrator->add('general.footer_menu_1', [
            'menu_title' => 'Siêu thị mini KMax',
            'items' => [
                ['text' => 'Trang chủ', 'link' => '/'],
                ['text' => 'Giới thiệu', 'link' => '/about'],
                ['text' => 'Dịch vụ', 'link' => '/services'],
                ['text' => 'Liên hệ', 'link' => '/contact'],
            ]
        ]);
        $this->migrator->add('general.footer_menu_2', [
            'menu_title' => 'Dịch vụ khách hàng',
            'items' => [
                ['text' => 'Trang chủ', 'link' => '/'],
                ['text' => 'Giới thiệu', 'link' => '/about'],
                ['text' => 'Dịch vụ', 'link' => '/services'],
                ['text' => 'Liên hệ', 'link' => '/contact'],
            ]
        ]);
        $this->migrator->add('general.footer_menu_3', [
            'menu_title' => 'Trung tâm mua sắm',
            'items' => [
                ['text' => 'Trang chủ', 'link' => '/'],
                ['text' => 'Giới thiệu', 'link' => '/about'],
                ['text' => 'Dịch vụ', 'link' => '/services'],
                ['text' => 'Liên hệ', 'link' => '/contact'],
            ]
        ]);
    }

    public function down(): void
    {
        $this->migrator->delete('general.footer_text');
        $this->migrator->delete('general.search_tags');
        $this->migrator->delete('general.facebook');
        $this->migrator->delete('general.tiktok');

        $this->migrator->delete('general.footer_menu_1');
        $this->migrator->delete('general.footer_menu_2');
        $this->migrator->delete('general.footer_menu_3');
    }
};
