

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Detail Produk: <?php echo e($product->name); ?></h2>
            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="row">
            
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-light fw-bold">Informasi Produk</div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 30%">Nama Produk</th>
                                <td><?php echo e($product->name); ?></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>Rp <?php echo e(number_format($product->price, 2, ',', '.')); ?></td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>
                                    <span class="badge bg-secondary">
                                        <?php echo e($product->category->name ?? 'Tanpa Kategori'); ?>

                                    </span>
                                </td>
                            </tr>

                            
                            <tr>
                                <td colspan="2">
                                    <hr>
                                </td>
                            </tr>

                            <tr>
                                <th>Deskripsi</th>
                                <td class="text-muted"><?php echo e($product->detail->description ?? 'Tidak ada deskripsi'); ?></td>
                            </tr>
                            <tr>
                                <th>Berat</th>
                                <td><?php echo e($product->detail->weight ?? 0); ?> kg</td>
                            </tr>
                            <tr>
                                <th>Ukuran</th>
                                <td><?php echo e($product->detail->size ?? '-'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Stok di Gudang
                    </div>
                    <ul class="list-group list-group-flush">
                        
                        <?php $__empty_1 = true; $__currentLoopData = $product->warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?php echo e($warehouse->name); ?></strong>
                                    <br>
                                    <small class="text-muted" style="font-size: 0.8em;"><?php echo e($warehouse->location); ?></small>
                                </div>

                                
                                <span class="badge bg-success rounded-pill" style="font-size: 1rem;">
                                    <?php echo e($warehouse->pivot->quantity); ?>

                                </span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item text-center text-muted py-4">
                                <em>Produk ini belum tersedia di gudang manapun.</em>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Semester 3\Pemrograman Web  A\Tugas Praktikum\Praktikum-9\resources\views/products/show.blade.php ENDPATH**/ ?>