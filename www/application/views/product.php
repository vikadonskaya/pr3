<a href="/catalog"><<< Назад</a>
<h1><?=$product['name']?></h1>

<div class="card_product">
				<div class="product_image">
					<image src="/uploads/<?=$product['image_url']?>" alt="<?=$product['name']?>" title="<?=$product['name']?>" />
				</div>
				<div class="product_desc">
					<?=$product['desc']?>					
				</div>
				<div class="price">
					<?=$product['price']?> руб.					
				</div>
				<div class="product_buy">
					
					<a href="/catalog?in-cart-product-id=<?=$product["id"]?>">Купить</a>
					
				</div>
</div>