<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::updateOrCreate(
            ['email' => 'nhannd314@gmail.com'], // Điều kiện tìm kiếm
            [
                'name' => 'Nhan',
                'password' => Hash::make('MatKhau@314!'), // Đặt mật khẩu mặc định
                'role' => UserRole::Admin, // Cột phân quyền của bạn
            ]
        );

        // create categories
        $catIds = [];
        $cats = ['Dầu ăn', 'Bánh kẹo', 'Thực phẩm', 'Gia vị', 'Đồ uống', 'Bánh mì', 'Bột giặt'];
        foreach ($cats as $cat) {
            $category = Category::create(['name' => $cat, 'slug' => Str::slug($cat)]);
            $catIds[] = $category->id;
        }

        // create products
        $catIds = collect($catIds);

        for ($i = 0; $i < 30; $i++) {
            $name = fake()->words(3, true); // Dùng words sẽ ra tên sản phẩm tự nhiên hơn name() người

            Product::create([
                'category_id' => $catIds->random(),
                'name' => fake()->name(),
                'slug' => Str::slug($name),
                'price' => fake()->numberBetween(100000, 200000),
                'sale_price' => fake()->numberBetween(80000, 90000),
                'description' => fake()->text(),
            ]);
        }
    }
}
