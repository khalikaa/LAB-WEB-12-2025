const readline = require("readline");

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

let target = Math.floor(Math.random() * 100);
let attempts = 0;

function tanya() {
  rl.question("Masukkan salah satu dari angka 1 sampai 100: ", (input) => {
    let guess = parseInt(input);
    if (isNaN(guess) || guess < 1 || guess > 100) {
      console.log("Error: Harap masukkan angka antara 1-100!");
      tanya();
      return;
    }

    attempts++;
    if (guess > target) {
      console.log("Terlalu tinggi! Coba lagi.");
      tanya();
    } else if (guess < target) {
      console.log("Terlalu rendah! Coba lagi.");
      tanya();
    } else {
      console.log(`Selamat! kamu berhasil menebak angka ${target} dengan benar.`);
      console.log(`Sebanyak ${attempts}x percobaan.`);
      rl.close();
    }
  });
}

tanya();
