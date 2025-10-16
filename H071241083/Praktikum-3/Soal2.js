const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question('Masukkan harga barang : ', (hargaInput) => {
  const harga = parseFloat(hargaInput);

  if (isNaN(harga) || harga <= 0) {
    console.log('Error: Harga yang dimasukkan harus berupa angka positif.');
    rl.close();
    return;
  }

  rl.question('Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ', (jenis) => {
    let diskonPersen = 0;
    const jenisLower = jenis.toLowerCase();
    
    switch (jenisLower) {
      case 'elektronik':
        diskonPersen = 10; 
        break;
      case 'pakaian':
        diskonPersen = 20; 
        break;
      case 'makanan':
        diskonPersen = 5;
        break;
      default:
        diskonPersen = 0;
        break;
    }

    const diskonNominal = harga * (diskonPersen / 100);
    const hargaAkhir = harga - diskonNominal;

    console.log(`\nHarga awal: Rp ${harga}`);
    console.log(`Diskon: ${diskonPersen}%`);
    console.log(`Harga setelah diskon: Rp ${hargaAkhir}`);

    rl.close();
  });
});