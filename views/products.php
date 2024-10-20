<div class="container mt-5">
    <h2 class="text-center mb-4"><?php echo $lang_data['products']; ?></h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="uploads/products/<?php echo $product['thumbnail']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text">$<?php echo number_format($product['price'], 2); ?></p>
                        <form method="POST" action="/cart/add">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="number" name="quantity" value="1" min="1" class="form-control mb-2" style="width: 60px; display: inline-block;">
                            <button type="submit" class="btn btn-primary btn-sm"><?php echo $lang_data['add_to_cart']; ?></button>
                        </form>
                        <a href="/product/<?php echo $product['id']; ?>" class="btn btn-link btn-sm"><?php echo $lang_data['view_details']; ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
