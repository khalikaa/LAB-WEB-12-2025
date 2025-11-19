 <?php $__env->startSection('content'); ?>
<h2>Formulir Transfer Stok</h2>
<p classC="text-muted">Gunakan form ini untuk menambah (nilai positif) atau mengurangi (nilai negatif) stok produk di gudang.</p>

<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<form action="<?php echo e(route('stocks.transfer.store')); ?>" method="POST">
    <?php echo csrf_field(); ?> <div class="mb-3">
        <label class="form-label">Gudang Tujuan</label>
        <select name="warehouse_id" class="form-select" required>
            <option value="">-- Pilih Gudang --</option>
            <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Produk</label>
        <select name="product_id" class="form-select" required>
            <option value="">-- Pilih Produk --</option>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Perubahan Kuantitas</label>
        <input type="number" name="quantity_change" class="form-control" required placeholder="Contoh: 10 atau -5">
        <div class="form-text">
            Masukkan angka positif (misal: 10) untuk **menambah** stok.
            <br>
            Masukkan angka negatif (misal: -10) untuk **mengurangi** stok.
        </div>
    </div>
    
    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    <a href="<?php echo e(route('stocks.index')); ?>" class="btn btn-secondary">Kembali</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Semester 3\Pemrograman Web  A\Tugas Praktikum\Praktikum-9\resources\views/stocks/transfer.blade.php ENDPATH**/ ?>