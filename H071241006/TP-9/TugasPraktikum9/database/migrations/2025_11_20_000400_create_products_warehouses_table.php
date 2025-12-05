public function up()
{
    Schema::create('product_warehouse', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('product_id');
    $table->unsignedBigInteger('warehouse_id');
    $table->integer('quantity')->default(0);
    $table->timestamps();

    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
});

}

public function down()
{
    Schema::dropIfExists('product_warehouses');
}
