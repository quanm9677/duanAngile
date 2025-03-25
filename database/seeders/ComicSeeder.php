<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comic;

class ComicSeeder extends Seeder
{
    public function run()
    {
        Comic::create([
            'title' => 'Comic 1',
            'author_id' => 1, // Giả sử bạn có tác giả với ID 1
            'category_id' => 1, // Giả sử bạn có danh mục với ID 1
            'description' => 'Description for Comic 1',
            'publication_date' => '2023-01-01',
            'price' => 10.00,
            'original_price' => 15.00,
            'stock_quantity' => 100,
            'image' => 'path/to/image1.jpg',
        ]);

        Comic::create([
            'title' => 'Comic 2',
            'author_id' => 1,
            'category_id' => 2, // Giả sử bạn có danh mục với ID 2
            'description' => 'Description for Comic 2',
            'publication_date' => '2023-02-01',
            'price' => 12.00,
            'original_price' => 18.00,
            'stock_quantity' => 50,
            'image' => 'path/to/image2.jpg',
        ]);

        // Thêm nhiều sản phẩm khác nếu cần
    }
}
