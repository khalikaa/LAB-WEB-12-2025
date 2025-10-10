const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});


const angkaRahasia = Math.floor(Math.random() * 100) + 1;
let jumlahTebakan = 0;

console.log('Selamat datang di permainan tebak angka!');
console.log('Saya telah memilih sebuah angka antara 1 dan 100. Silakan tebak!');

function tebakAngka() {
  rl.question('Masukkan tebakan Anda: ', (tebakanInput) => {
    const tebakan = parseInt(tebakanInput);
    jumlahTebakan++;


    if (isNaN(tebakan)) {
      console.log('Error: Input harus berupa angka. Coba lagi.');
      tebakAngka();
      return;
    }
    

    if (tebakan > angkaRahasia) {
      console.log('Terlalu tinggi! Coba lagi.');
      tebakAngka(); 
    } else if (tebakan < angkaRahasia) {
      console.log('Terlalu rendah! Coba lagi.');
      tebakAngka(); 
    } else {
      
      console.log(`\nSelamat! Anda berhasil menebak angka ${angkaRahasia} dengan benar.`);
      console.log(`Anda memerlukan ${jumlahTebakan} kali percobaan.`);
      rl.close();
    }
  });
}

tebakAngka();