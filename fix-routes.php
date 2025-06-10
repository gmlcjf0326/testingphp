<?php

echo "=====================================\n";
echo "라우트 이름 일괄 수정 스크립트\n";
echo "=====================================\n\n";

$viewsPath = __DIR__ . '/resources/views';
$replacements = [
    "route('products.index')" => "route('shop.products.index')",
    'route("products.index")' => 'route("shop.products.index")',
    "route('products.show'" => "route('shop.products.show'",
    'route("products.show"' => 'route("shop.products.show"',
    "route('cart.index')" => "route('shop.cart.index')",
    'route("cart.index")' => 'route("shop.cart.index")',
    "route('cart.add'" => "route('shop.cart.add'",
    'route("cart.add"' => 'route("shop.cart.add"',
    "route('cart.remove'" => "route('shop.cart.remove'",
    'route("cart.remove"' => 'route("shop.cart.remove"',
    "route('cart.clear')" => "route('shop.cart.clear')",
    'route("cart.clear")' => 'route("shop.cart.clear")',
    "route('checkout." => "route('shop.checkout.",
    'route("checkout.' => 'route("shop.checkout.',
    "route('orders.index')" => "route('shop.orders.index')",
    'route("orders.index")' => 'route("shop.orders.index")',
    "route('orders.show'" => "route('shop.orders.show'",
    'route("orders.show"' => 'route("shop.orders.show"',
];

$totalReplaced = 0;

// 재귀적으로 모든 blade.php 파일 찾기
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($viewsPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php' && strpos($file->getFilename(), '.blade.php') !== false) {
        $content = file_get_contents($file->getPathname());
        $originalContent = $content;
        
        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }
        
        if ($content !== $originalContent) {
            file_put_contents($file->getPathname(), $content);
            echo "수정됨: " . $file->getPathname() . "\n";
            $totalReplaced++;
        }
    }
}

echo "\n총 " . $totalReplaced . "개 파일이 수정되었습니다.\n";
echo "\n캐시를 정리하려면 다음 명령을 실행하세요:\n";
echo "php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear\n";
