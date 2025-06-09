<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => '노트북',
                'price' => 1200000,
                'image' => 'https://via.placeholder.com/300x300/1e40af/ffffff?text=노트북',
                'description' => '고성능 노트북, 인텔 i7 프로세서, 16GB RAM',
                'stock' => 15,
            ],
            [
                'name' => '스마트폰',
                'price' => 890000,
                'image' => 'https://via.placeholder.com/300x300/dc2626/ffffff?text=스마트폰',
                'description' => '최신 5G 스마트폰, 128GB 저장공간',
                'stock' => 25,
            ],
            [
                'name' => '헤드폰',
                'price' => 250000,
                'image' => 'https://via.placeholder.com/300x300/059669/ffffff?text=헤드폰',
                'description' => '노이즈 캔슬링 무선 헤드폰',
                'stock' => 30,
            ],
            [
                'name' => '스마트워치',
                'price' => 350000,
                'image' => 'https://via.placeholder.com/300x300/7c2d12/ffffff?text=스마트워치',
                'description' => '피트니스 추적 기능이 있는 스마트워치',
                'stock' => 20,
            ],
            [
                'name' => '태블릿',
                'price' => 650000,
                'image' => 'https://via.placeholder.com/300x300/6d28d9/ffffff?text=태블릿',
                'description' => '10인치 디스플레이, 64GB WiFi 모델',
                'stock' => 18,
            ],
            [
                'name' => '키보드',
                'price' => 120000,
                'image' => 'https://via.placeholder.com/300x300/0891b2/ffffff?text=키보드',
                'description' => '기계식 RGB 게이밍 키보드',
                'stock' => 40,
            ],
            [
                'name' => '마우스',
                'price' => 80000,
                'image' => 'https://via.placeholder.com/300x300/e11d48/ffffff?text=마우스',
                'description' => '무선 게이밍 마우스, DPI 조절 가능',
                'stock' => 35,
            ],
            [
                'name' => '웹캠',
                'price' => 150000,
                'image' => 'https://via.placeholder.com/300x300/f59e0b/ffffff?text=웹캠',
                'description' => '1080p HD 웹캠, 마이크 내장',
                'stock' => 22,
            ],
            [
                'name' => 'USB 허브',
                'price' => 45000,
                'image' => 'https://via.placeholder.com/300x300/10b981/ffffff?text=USB+허브',
                'description' => '7포트 USB 3.0 허브',
                'stock' => 50,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
