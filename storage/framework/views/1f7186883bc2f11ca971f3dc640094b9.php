
<?php $__env->startSection('title', 'Orders'); ?>
<?php $__env->startSection('content'); ?>
<h2>All Orders</h2>
<table class="table table-bordered mt-3">
    <thead><tr><th>ID</th><th>Order #</th><th>Customer</th><th>Total</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
    <tbody>
        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($order->id); ?></td>
            <td><?php echo e($order->order_number); ?></td>
            <td><?php echo e($order->user->name); ?></td>
            <td>$<?php echo e(number_format($order->total_amount, 2)); ?></td>
            <td>
                <form action="<?php echo e(route('admin.orders.update-status', $order->id)); ?>" method="POST" class="d-flex">
                    <?php echo csrf_field(); ?>
                    <select name="status" class="form-select form-select-sm" style="width:120px;">
                        <option value="pending" <?php echo e($order->status=='pending'?'selected':''); ?>>Pending</option>
                        <option value="processing" <?php echo e($order->status=='processing'?'selected':''); ?>>Processing</option>
                        <option value="completed" <?php echo e($order->status=='completed'?'selected':''); ?>>Completed</option>
                        <option value="cancelled" <?php echo e($order->status=='cancelled'?'selected':''); ?>>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary ms-2">Update</button>
                </form>
            </td>
            <td><?php echo e($order->created_at->format('Y-m-d')); ?></td>
            <td>
                <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-sm btn-info">View</a>
                <form action="<?php echo e(route('admin.orders.destroy', $order->id)); ?>" method="POST" class="d-inline"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete order?')">Delete</button></form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php echo e($orders->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\e_commerce\resources\views/backend/orders/index.blade.php ENDPATH**/ ?>