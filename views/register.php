<div class="container mt-5">
    <h2 class="text-center"><?php echo $lang_data['register']; ?></h2>

    <!-- แสดง Alert เมื่อเกิดข้อผิดพลาด -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="/register" method="POST" class="mt-4">
        <div class="form-group">
            <label for="username"><?php echo $lang_data['username']; ?></label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email"><?php echo $lang_data['email']; ?></label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password"><?php echo $lang_data['password']; ?></label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary"><?php echo $lang_data['register']; ?></button>
        </div>
    </form>
</div>
