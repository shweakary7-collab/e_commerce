
<?php $__env->startSection('title', 'Edit Product'); ?>
<?php $__env->startSection('content'); ?>
<h2>Edit Product</h2>
<form action="<?php echo e(route('admin.products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" value="<?php echo e($product->name); ?>" required></div>
    <div class="mb-3"><label>Description</label><textarea name="description" class="form-control" rows="5" required><?php echo e($product->description); ?></textarea></div>
    <div class="row">
        <div class="col-md-4"><label>Price ($)</label><input type="number" step="0.01" name="price" class="form-control" value="<?php echo e($product->price); ?>" required></div>
        <div class="col-md-4"><label>Category</label><select name="category" class="form-control" required><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($key); ?>" <?php echo e($product->category==$key?'selected':''); ?>><?php echo e($name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
        <div class="col-md-4"><label>Stock</label><input type="number" name="stock" class="form-control" value="<?php echo e($product->stock); ?>" required></div>
    </div>
    <div class="mb-3 mt-3">
        <?php if($product->image): ?><img src="<?php echo e($product->image_url); ?>" width="100" class="mb-2"><br><?php endif; ?>
        <label>New Image</label><input type="file" name="image" class="form-control">
    </div>
    <div class="mb-3"><label><input type="checkbox" name="is_active" value="1" <?php echo e($product->is_active?'checked':''); ?>> Active</label></div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary">Cancel</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\e_commerce\resources\views/backend/products/edit.blade.php ENDPATH**/ ?>