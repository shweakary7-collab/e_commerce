

<?php $__env->startSection('title', 'Checkout'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h1 class="mb-4">Checkout</h1>
    
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><h5>Shipping Information</h5></div>
                <div class="card-body">
                    <form action="<?php echo e(route('checkout.process')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3"><label>Full Name</label><input type="text" class="form-control" value="<?php echo e(Auth::user()->name); ?>" readonly></div>
                        <div class="mb-3"><label>Email</label><input type="email" class="form-control" value="<?php echo e(Auth::user()->email); ?>" readonly></div>
                        <div class="mb-3"><label>Shipping Address</label><textarea name="shipping_address" class="form-control" rows="3" required placeholder="Enter your shipping address"></textarea></div>
                        <div class="mb-3"><label>Payment Method</label><select class="form-control" disabled><option>Cash on Delivery (Demo)</option></select></div>
                        <button type="submit" class="btn btn-success w-100">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><h5>Order Summary</h5></div>
                <div class="card-body">
                    <table class="table">
                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr><td><?php echo e($item->product->name); ?> x <?php echo e($item->quantity); ?></td><td class="text-end">$<?php echo e(number_format($item->quantity * $item->product->price, 2)); ?></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-top"><th>Total:</th><th class="text-end">$<?php echo e(number_format($total, 2)); ?></th></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\e_commerce\resources\views/frontend/checkout.blade.php ENDPATH**/ ?>