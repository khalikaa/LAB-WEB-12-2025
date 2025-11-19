

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Detail Kategori: <?php echo e($category->name); ?></h2>
            <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Informasi Kategori</h5>
                <p class="card-text"><strong>Deskripsi:</strong> <?php echo e($category->description ?? 'Tidak ada deskripsi'); ?></p>
            </div>
        </div>

        <h4>Daftar Produk di Kategori Ini</h4>
        <?php if($category->products->count() > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $category->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($product->name); ?></td>
                            <td>Rp <?php echo e(number_format($product->price, 2, ',', '.')); ?></td>
                            <td>
                                <a href="<?php echo e(route('products.show', $product->id)); ?>" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">Belum ada produk di kategori ini.</div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Semester 3\Pemrograman Web  A\Tugas Praktikum\Praktikum-9\resources\views/categories/show.blade.php ENDPATH**/ ?>