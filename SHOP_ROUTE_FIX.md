# Shop 라우트 에러 해결

## 문제
```
Route [products.show] not defined.
```

## 원인
`resources/views/products/index.blade.php` 파일에서 잘못된 라우트 이름을 사용하고 있었습니다.
- 잘못된 코드: `route('products.show', $product->id)`
- 올바른 코드: `route('shop.products.show', $product->id)`

## 해결 완료
✅ products/index.blade.php 파일 수정 완료
✅ fix-shop-route.bat 스크립트 생성

## 추가 작업
캐시를 정리하려면 다음 명령을 실행하세요:
```batch
fix-shop-route.bat
```

## 라우트 구조
```
/shop                    -> shop.products.index
/shop/product/{id}       -> shop.products.show
/shop/cart              -> shop.cart.index
/shop/cart/add/{id}     -> shop.cart.add
/shop/checkout          -> shop.checkout.index
```

모든 shop 관련 라우트는 `shop.` 접두사가 붙어있으므로 주의하세요.
