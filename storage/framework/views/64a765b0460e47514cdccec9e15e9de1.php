

<?php $__env->startSection('title', 'Cart'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h1 class="mb-4">Shopping Cart</h1>
    
    <?php if($cartItems->isEmpty()): ?>
        <div class="alert alert-info">Your cart is empty. <a href="<?php echo e(route('home')); ?>">Continue shopping</a></div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><img src="<?php echo e($item->product->image_url); ?>" width="50"> <?php echo e($item->product->name); ?></td>
                            <td>$<?php echo e(number_format($item->product->price, 2)); ?></td>
                            <td>
                                <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="POST" class="d-flex">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                    <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1" style="width:70px;" class="form-control">
                                    <button type="submit" class="btn btn-sm btn-secondary ms-2">Update</button>
                                </form>
                            </td>
                            <td>$<?php echo e(number_format($item->quantity * $item->product->price, 2)); ?></td>
                            <td>
                                <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><h5>Cart Summary</h5></div>
                    <div class="card-body">
                        <p><strong>Total: $<?php echo e(number_format($total, 2)); ?></strong></p>
                        <a href="<?php echo e(route('checkout.index')); ?>" class="btn btn-success w-100">Proceed to Checkout</a>
                        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary w-100 mt-2">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\e_commerce\resources\views/frontend/cart.blade.php ENDPATH**/ ?>