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
                'name' => '프리미엄 노트북',
                'price' => 1200000,
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800&h=800&fit=crop',
                'description' => '애플 맥북 스타일의 고성능 노트북, 인텔 i7 프로세서, 16GB RAM, 512GB SSD',
                'stock' => 15,
            ],
            [
                'name' => '최신 스마트폰',
                'price' => 890000,
                'image' => 'https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?w=800&h=800&fit=crop',
                'description' => '최신 5G 스마트폰, 트리플 카메라, 128GB 저장공간, 무선충전 지원',
                'stock' => 25,
            ],
            [
                'name' => '무선 헤드폰',
                'price' => 250000,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&h=800&fit=crop',
                'description' => '프리미엄 노이즈 캔슬링 무선 헤드폰, 40시간 재생',
                'stock' => 30,
            ],
            [
                'name' => '스마트워치',
                'price' => 350000,
                'image' => 'https://images.unsplash.com/photo-1523475496153-3d6cc0f0bf19?w=800&h=800&fit=crop',
                'description' => '피트니스 추적, 심박수 모니터링, 방수 기능이 있는 스마트워치',
                'stock' => 20,
            ],
            [
                'name' => '태블릿 PC',
                'price' => 650000,
                'image' => 'https://images.unsplash.com/photo-1585790050230-5dd28404ccb9?w=800&h=800&fit=crop',
                'description' => '10.9인치 레티나 디스플레이, 64GB WiFi 모델, 스타일러스 펜 지원',
                'stock' => 18,
            ],
            [
                'name' => '기계식 키보드',
                'price' => 120000,
                'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=800&h=800&fit=crop',
                'description' => '청축 기계식 RGB 게이밍 키보드, 방수 기능',
                'stock' => 40,
            ],
            [
                'name' => '게이밍 마우스',
                'price' => 80000,
                'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=800&h=800&fit=crop',
                'description' => '무선 게이밍 마우스, 16000 DPI, RGB 라이팅',
                'stock' => 35,
            ],
            [
                'name' => '4K 웹캠',
                'price' => 150000,
                'image' => 'https://images.unsplash.com/photo-1587826080692-f439cd0b70da?w=800&h=800&fit=crop',
                'description' => '4K Ultra HD 웹캠, 노이즈 캔슬링 마이크 내장, 자동 초점',
                'stock' => 22,
            ],
            [
                'name' => '포터블 스피커',
                'price' => 89000,
                'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=800&h=800&fit=crop',
                'description' => '블루투스 5.0 포터블 스피커, 360도 사운드, 방수 기능',
                'stock' => 45,
            ],
            [
                'name' => '무선 이어폰',
                'price' => 180000,
                'image' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=800&h=800&fit=crop',
                'description' => '트루 와이어리스 이어폰, 액티브 노이즈 캔슬링, 30시간 재생',
                'stock' => 50,
            ],
            [
                'name' => '외장 SSD',
                'price' => 120000,
                'image' => 'https://images.unsplash.com/photo-1597872200969-2b65d56bd16b?w=800&h=800&fit=crop',
                'description' => '1TB 포터블 SSD, USB 3.2 Gen2, 초고속 전송',
                'stock' => 28,
            ],
            [
                'name' => '모니터 스탠드',
                'price' => 45000,
                'image' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=800&h=800&fit=crop',
                'description' => '알루미늄 모니터 스탠드, USB 허브 내장, 높이 조절 가능',
                'stock' => 60,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
