public function run()
{
    \App\Models\Category::insert([
        ['name'=>'Elektronik','description'=>'Perangkat elektronik','created_at'=>now(),'updated_at'=>now()],
        ['name'=>'Furniture','description'=>'Meubel','created_at'=>now(),'updated_at'=>now()],
    ]);

    \App\Models\Warehouse::insert([
        ['name'=>'Gudang Makassar','location'=>'Makassar', 'created_at'=>now(),'updated_at'=>now()],
        ['name'=>'Gudang Gowa','location'=>'Gowa', 'created_at'=>now(),'updated_at'=>now()],
    ]);

    $p1 = \App\Models\Product::create(['name'=>'Laptop ASUS','price'=>12000000,'category_id'=>1]);
    $p1->detail()->create(['description'=>'Laptop ASUS X', 'weight'=>1.50, 'size'=>'15 inch']);

    $p2 = \App\Models\Product::create(['name'=>'Meja Kayu','price'=>850000,'category_id'=>2]);
    $p2->detail()->create(['description'=>'Meja kayu jati', 'weight'=>20.00, 'size'=>'180x90 cm']);

    \App\Models\ProductsWarehouse::create(['product_id'=>$p1->id,'warehouse_id'=>1,'quantity'=>10]);
    \App\Models\ProductsWarehouse::create(['product_id'=>$p1->id,'warehouse_id'=>2,'quantity'=>5]);
    \App\Models\ProductsWarehouse::create(['product_id'=>$p2->id,'warehouse_id'=>1,'quantity'=>2]);
}
