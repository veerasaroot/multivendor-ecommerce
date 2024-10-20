<div class="container mt-5">
    <h2 class="text-center"><?php echo $lang_data['your_cart']; ?></h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th><?php echo $lang_data['products']; ?></th>
                <th><?php echo $lang_data['price']; ?></th>
                <th>Quantity</th>
                <th><?php echo $lang_data['total']; ?></th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $productId => $item): ?>
                    <tr>
                        <td>
                            <img src="uploads/products/<?php echo $item['thumbnail']; ?>" alt="<?php echo $item['name']; ?>" width="50">
                            <?php echo $item['name']; ?>
                        </td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td>
                            <form method="POST" action="/cart/update">
                                <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                <button type="submit" class="btn btn-sm btn-primary"><?php echo $lang_data['update']; ?></button>
                            </form>
                        </td>
                        <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        <td>
                            <form method="POST" action="/cart/remove">
                                <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                <button type="submit" class="btn btn-sm btn-danger"><?php echo $lang_data['remove']; ?></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center"><?php echo $lang_data['empty_cart']; ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="text-right">
        <h4><?php echo $lang_data['total']; ?>: $<?php echo number_format(CartController::calculateTotal(), 2); ?></h4>
        
        <!-- ตรวจสอบการเข้าสู่ระบบก่อนแสดงปุ่ม Checkout -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <form method="POST" action="/checkout">
                <button type="submit" class="btn btn-success"><?php echo $lang_data['proceed_to_checkout']; ?></button>
            </form>
        <?php else: ?>
            <!-- หากผู้ใช้ยังไม่ได้เข้าสู่ระบบ ให้แสดงปุ่มพาไปหน้า Login -->
            <a href="/login" class="btn btn-primary"><?php echo $lang_data['login']; ?> to Checkout</a>
        <?php endif; ?>
    </div>
</div>
