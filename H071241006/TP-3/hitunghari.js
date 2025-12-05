const readline = require("readline");

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

const days = ["minggu", "senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];

rl.question("Masukkan hari: ", (hari) => {
  hari = hari.toLowerCase();
  let index = days.indexOf(hari);
  if (index === -1) {
    console.log("Error: Nama hari tidak valid!");
    rl.close();
    return;
  }

  rl.question("Masukkan jumlah hari ke depan: ", (jumlahInput) => {
    let jumlah = parseInt(jumlahInput);
    if (isNaN(jumlah)|| jumlah <= 0 ) {
      console.log("Error: Input harus berupa angka!");
      rl.close();
      return;
    }

    let newIndex = (index + jumlah) % 7;
    console.log(`${jumlah} hari setelah ${hari} adalah ${days[newIndex]}`);
    rl.close();
  });
});
