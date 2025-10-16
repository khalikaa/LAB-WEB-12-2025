const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
}); 
function calculateFinalPrice(price, category) {
    let discount = 0;   

    switch (category.toLowerCase()) {
        case 'elektronik':
            discount = 0.10;    
            break;
        case 'pakaian':
            discount = 0.20;
            break;
        case 'makanan':
            discount = 0.05;    
            break;
        case 'lainnya':
            discount = 0.0;
            break;
        default:
            console.log('Kategori tidak valid. Gunakan Elektronik, Pakaian, Makanan, atau Lainnya.');
            return null;
    }       
    const finalPrice = price - (price * discount);
    return {
        initialPrice: price,
        discountPercentage: discount * 100,
        finalPrice: finalPrice
    };
}       
rl.question('Masukkan harga barang: ', (priceInput) => {
    const price = parseFloat(priceInput);   
    if (isNaN(price) || price < 0) {
        console.log('Harga tidak valid. Harap masukkan angka positif.');
        rl.close();
        return;
    }       
    rl.question('Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ', (category) => {
        const result = calculateFinalPrice(price, category);    
        if (result) {
            console.log(`Harga awal: Rp ${result.initialPrice}`);
            console.log(`Diskon: ${result.discountPercentage}%`);
            console.log(`Harga setelah diskon: Rp ${result.finalPrice}`);
        }   
        rl.close();
    });
});

