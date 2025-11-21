const readline = require("readline");
const rl = readline.createInterface({ input: process.stdin, output: process.stdout });

rl.question("Masukkan harga barang: ", (harga) => {
  const h = Number(harga);
  if (isNaN(h) || h <= 0) {
    console.log("Harga harus angka positif!");
    return rl.close();
  }
  rl.question("Masukkan jenis barang (Elektronik/Pakaian/Makanan/Lainnya): ", (jenis) => {
    let diskon = 0;
    const j = jenis.toLowerCase();
    if (j === "elektronik") diskon = 0.1;
    else if (j === "pakaian") diskon = 0.2;
    else if (j === "makanan") diskon = 0.05;

    const potongan = h * diskon; 
    const akhir = h - potongan;
    console.log(`Harga awal: Rp ${h}`);
    console.log(`Diskon: ${diskon * 100}%`);
    console.log(`Harga setelah diskon: Rp ${akhir}`);
    rl.close();
  });
});
