const readline = require("readline");
const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout,
});

function askQuestion(query) {
  return new Promise((resolve) => rl.question(query, resolve));
}

const menentukanDiskon = {
  elektronik: 0.1, // 10%
  pakaian: 0.2, // 20%
  makanan: 0., // 5%
};

function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
}

async function startDiscountCalculator() {
  console.log("--- Kalkulator Diskon Sederhana ---");
  
  const priceInput = await askQuestion("Masukkan harga barang: ");
  const price = parseFloat(priceInput);

  if (isNaN(price) || price <= 0) {
    console.log("Input harga tidak valid. Mohon masukkan angka positif.");
    rl.close();
    return;
  }

  const kategoriInput = await askQuestion("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ");
  const kategori = kategoriInput.toLowerCase().trim();

  const discountPercentage = menentukanDiskon[kategori] || 0;
  
  const discountAmount = price * discountPercentage;
  const finalPrice = price - discountAmount;

  console.log("\n--- Struk Belanja ---");
  console.log(`Harga Awal         : ${formatRupiah(price)}`);
  console.log(`Diskon             : ${discountPercentage * 100}%`);
  console.log(`Harga Setelah Diskon : ${formatRupiah(finalPrice)}`);

  rl.close();
}

startDiscountCalculator();