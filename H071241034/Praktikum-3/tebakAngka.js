const readline = require("readline");
const rl = readline.createInterface({ input: process.stdin, output: process.stdout });

const target = Math.floor(Math.random() * 100) + 1;
let count = 0;

function tanya() {                                                                                                                                                      
  rl.question("Masukkan angka 1-100: ", (jawab) => {
    const num = Number(jawab);
    if (isNaN(num) || num < 1 || num > 100) {
      console.log("Input harus angka 1-100!");
      return tanya();
    }
    count++;
    if (num === target) {
      console.log(`Selamat! Tebakan benar ${target}. Total percobaan: ${count}`);
      rl.close();
    } else {
      console.log(num > target ? "Terlalu tinggi!" : "Terlalu rendah!");
      tanya();
    }
  });
}
tanya();
