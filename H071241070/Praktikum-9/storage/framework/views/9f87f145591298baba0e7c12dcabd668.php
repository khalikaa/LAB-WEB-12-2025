
<?php $__env->startSection('content'); ?>
    <h2>Edit Gudang</h2>

    <form action="<?php echo e(route('warehouses.update', $warehouse->id)); ?>" method="POST">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?> <div class="mb-3">
            <label class="form-label">Nama Gudang</label>
            <input type="text" name="name" class="form-control" value="<?php echo e($warehouse->name); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi (Opsional)</label>
            <textarea name="location" class="form-control"><?php echo e($warehouse->location); ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="<?php echo e(route('warehouses.index')); ?>" class="btn btn-secondary">Kembali</a>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Semester 3\Pemrograman Web  A\Tugas Praktikum\Praktikum-9\resources\views/warehouses/edit.blade.php ENDPATH**/ ?>