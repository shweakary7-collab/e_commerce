
<?php $__env->startSection('title', 'Order Details'); ?>
<?php $__env->startSection('content'); ?>
<h2>Order Details: <?php echo e($order->order_number); ?></h2>
<div class="row">
    <div class="col-md-6">
        <div class="card"><div class="card-header">Customer</div><div class="card-body">
            <p><strong>Name:</strong> <?php echo e($order->user->name); ?></p>
            <p><strong>Email:</strong> <?php echo e($order->user->email); ?></p>
            <p><strong>Address:</strong> <?php echo e($order->shipping_address ?? 'N/A'); ?></p>
        </div></div>
    </div>
    <div class="col-md-6">
        <div class="card"><div class="card-header">Order Info</div><div class="card-body">
            <p><strong>Date:</strong> <?php echo e($order->created_at->format('Y-m-d H:i')); ?></p>
            <p><strong>Status:</strong> <?php echo e($order->status); ?></p>
            <p><strong>Payment:</strong> <?php echo e($order->payment_method ?? 'N/A'); ?></p>
        </div></div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">Items</div>
    <div class="card-body">
        <table class="table">
            <thead><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr></thead>
            <tbody>
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->product->name); ?></td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td>$<?php echo e(number_format($item->price, 2)); ?></td>
                    <td>$<?php echo e(number_format($item->quantity * $item->price, 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class="table-active"><th colspan="3" class="text-end">Total:</th><th>$<?php echo e(number_format($order->total_amount, 2)); ?></th></tr>
            </tbody>
        </table>
    </div>
</div>
<a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-secondary mt-3">Back</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\e_commerce\resources\views/backend/orders/show.blade.php ENDPATH**/ ?>