const readline = require('readline');
const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

function mulaiPermainan() {
  const angkaRahasia = Math.floor(Math.random() * 100) + 1;
  let jumlahTebakan = 0;
  let tebakanBenar = false;

  function mintaTebakan() {
    rl.question('Masukkan tebakan angka (1-100): ', (input) => {
      const tebakan = parseInt(input.trim(), 10);
      jumlahTebakan++;
      if (isNaN(tebakan) || tebakan < 1 || tebakan > 100) {
        console.log(`Input tidak valid! Harap masukkan angka bulat antara 1 dan 100.`);
        jumlahTebakan--;
        mintaTebakan();
        return;
      }
      if (tebakan === angkaRahasia) {
        tebakanBenar = true;
        console.log(`\nSelamat! kamu berhasil menebak angka ${angkaRahasia} dengan benar.`);
        console.log(`Sebanyak ${jumlahTebakan}x percobaan.`);
        rl.close();
      } else if (tebakan < angkaRahasia) {
        console.log('Terlalu rendah! Coba lagi.');
        mintaTebakan();
      } else {
        console.log('Terlalu tinggi! Coba lagi.');
        mintaTebakan();
      }
    });
  }

  mintaTebakan();
}

mulaiPermainan();