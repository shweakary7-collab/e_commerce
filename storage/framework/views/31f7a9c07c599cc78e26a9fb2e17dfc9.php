

<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h1 class="mb-4">Our Products</h1>
    
    <div class="mb-4">
        <div class="btn-group">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $catName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('home', ['category' => $key])); ?>" 
                   class="btn btn-outline-primary <?php echo e($category == $key ? 'active' : ''); ?>">
                    <?php echo e($catName); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card product-card h-100">
                    <img src="<?php echo e($product->image_url); ?>" class="card-img-top product-image" alt="<?php echo e($product->name); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($product->name); ?></h5>
                        <p class="card-text text-muted"><?php echo e(Str::limit($product->description, 100)); ?></p>
                        <p class="card-text">
                            <strong class="text-primary">$<?php echo e(number_format($product->price, 2)); ?></strong>
                            <small class="text-muted"> | Stock: <?php echo e($product->stock); ?></small>
                        </p>
                        <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                            <input type="number" name="quantity" value="1" min="1" max="<?php echo e($product->stock); ?>" style="width: 60px; display: inline-block;">
                            <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12"><div class="alert alert-info">No products found.</div></div>
        <?php endif; ?>
    </div>
    
    <div class="d-flex justify-content-center"><?php echo e($products->appends(['category' => $category])->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\e_commerce\resources\views/frontend/home.blade.php ENDPATH**/ ?>