

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2 class="mb-4">Tambah Gudang Baru</h2>

        <form action="<?php echo e(route('warehouses.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label class="form-label">Nama Gudang</label>
                <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('name')); ?>" required>

                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Lokasi (Opsional)</label>
                <textarea name="location" class="form-control"><?php echo e(old('location')); ?></textarea>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="<?php echo e(route('warehouses.index')); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Semester 3\Pemrograman Web  A\Tugas Praktikum\Praktikum-9\resources\views/warehouses/create.blade.php ENDPATH**/ ?>