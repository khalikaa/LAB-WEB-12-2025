const readline = require("readline");
const rl = readline.createInterface({ input: process.stdin, output: process.stdout });

const days = ["minggu","senin","selasa","rabu","kamis","jumat","sabtu"];

rl.question("Masukkan hari: ", (hari) => {
  const start = days.indexOf(hari.toLowerCase());
  if (start === -1) { console.log("Hari tidak valid."); return rl.close(); }

  rl.question("Masukkan jumlah hari ke depan: ", (jumlah) => {
    const n = Number(jumlah);
    if (isNaN(n)|| n <= 0) { console.log("Jumlah hari harus angka positif."); return rl.close(); }
    
    const nextDay = days[(start + (n % 7)) % 7];
    console.log(`${n} hari setelah ${hari} adalah ${nextDay}`);
    rl.close();
  });
});
