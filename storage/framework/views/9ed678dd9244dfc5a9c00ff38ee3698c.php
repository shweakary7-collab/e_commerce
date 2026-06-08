
<?php $__env->startSection('title', 'Products'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between"><h2>Products</h2><a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">Add Product</a></div>
<table class="table table-bordered mt-3">
    <thead><tr><th>ID</th><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Actions</th></tr></thead>
    <tbody>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($product->id); ?></td>
            <td><img src="<?php echo e($product->image_url); ?>" width="50"></td>
            <td><?php echo e($product->name); ?></td>
            <td><?php echo e(ucfirst($product->category)); ?></td>
            <td>$<?php echo e(number_format($product->price, 2)); ?></td>
            <td><?php echo e($product->stock); ?></td>
            <td>
                <a href="<?php echo e(route('admin.products.show', $product->id)); ?>" class="btn btn-sm btn-info">View</a>
                <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>" method="POST" class="d-inline"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button></form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php echo e($products->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\e_commerce\resources\views/backend/products/index.blade.php ENDPATH**/ ?>