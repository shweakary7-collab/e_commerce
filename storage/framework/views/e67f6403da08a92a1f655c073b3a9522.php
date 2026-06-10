
<?php $__env->startSection('title', 'Create Role'); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumbbar" style="background: transparent; padding: 25px 0 15px 0;">
    <div class="row align-items-center justify-content-between">
        <div class="col-md-6">
            <h4 class="page-title" style="font-weight: 700; color: #1e293b; font-size: 1.5rem;">Create New Role</h4>
            <p class="text-muted" style="font-size: 0.85rem; margin-top: -5px;">Add a new role with permissions.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn" style="background-color: #f1f5f9; color: #475569; font-weight: 600; border: none; border-radius: 10px; padding: 10px 20px;">
                <i class="ri-arrow-left-line me-1"></i> Back to List
            </a>
        </div>
    </div>          
</div>

<div class="contentbar" style="padding-top: 10px;">
    <div class="card" style="border: none; border-radius: 14px; background-color: #ffffff; padding: 25px;">
        <form action="<?php echo e(route('admin.roles.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="form-group mb-4">
                <label style="font-weight: 600; color: #475569; margin-bottom: 8px;">Role Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter role name (e.g. editor, moderator)" style="border: 2px solid #f1f5f9; border-radius: 10px; padding: 12px;" required>
            </div>
            
            <div class="form-group mb-4">
                <label style="font-weight: 600; color: #475569; margin-bottom: 8px;">Permissions</label>
                <div class="row">
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="<?php echo e($permission->name); ?>" id="perm_<?php echo e($permission->id); ?>" class="form-check-input">
                            <label for="perm_<?php echo e($permission->id); ?>" class="form-check-label"><?php echo e($permission->name); ?></label>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            
            <button type="submit" class="btn" style="background-color: #e6f9f0; color: #065f46; font-weight: 700; border: none; border-radius: 10px; padding: 12px 25px;">
                <i class="ri-save-line me-1"></i> Create Role
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\e_commerce\resources\views/backend/roles/create.blade.php ENDPATH**/ ?>