
<?php $__env->startSection('title', 'View Product'); ?>
<?php $__env->startSection('content'); ?>
<h2><?php echo e($product->name); ?></h2>
<div class="row">
    <div class="col-md-4"><img src="<?php echo e($product->image_url); ?>" class="img-fluid"></div>
    <div class="col-md-8">
        <table class="table">
            <tr><th>Price:</th><td>$<?php echo e(number_format($product->price, 2)); ?></td></tr>
            <tr><th>Category:</th><td><?php echo e(ucfirst($product->category)); ?></td></tr>
            <tr><th>Stock:</th><td><?php echo e($product->stock); ?></td></tr>
            <tr><th>Status:</th><td><?php echo e($product->is_active?'Active':'Inactive'); ?></td></tr>
            <tr><th>Description:</th><td><?php echo e($product->description); ?></td></tr>
        </table>
    </div>
</div>
<a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary">Back</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\e_commerce\resources\views/backend/products/show.blade.php ENDPATH**/ ?>