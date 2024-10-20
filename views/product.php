<?php
$productImages = ProductController::getProductImages($product['id']); // ดึงรูปภาพเพิ่มเติมของสินค้านี้
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo base_url('uploads/products/' . $product['thumbnail']); ?>" class="img-fluid mb-4" alt="Product Thumbnail">

            <div class="row">
                <?php foreach ($productImages as $index => $image): ?>
                    <?php if ($index < 4): // แสดงสูงสุด 4 รูปภาพ ?>
                        <div class="col-md-3 mb-2">
                            <img src="<?php echo base_url('uploads/products/' . $product['image_path']); ?>" class="img-fluid" alt="Product Image">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-6">
            <h2><?php echo $product['name']; ?></h2>
            <p><?php echo $product['description']; ?></p>
            <h4>$<?php echo $product['price']; ?></h4>
            <a href="cart/add/<?php echo $product['id']; ?>" class="btn btn-primary"><?php echo $lang_data['add_to_cart']; ?></a>
        </div>
    </div>
</div>
