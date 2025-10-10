const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});


const daftarHari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];

rl.question('Masukkan nama hari ini: ', (hariIni) => {
  const hariIniLower = hariIni.toLowerCase();
  const indexHariIni = daftarHari.indexOf(hariIniLower);

  if (indexHariIni === -1) {
    console.log('Error: Nama hari tidak valid. Gunakan salah satu dari: Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, Minggu.');
    rl.close();
    return;
  }

  rl.question('Masukkan jumlah hari yang akan datang: ', (jumlahHariInput) => {
    const jumlahHari = parseInt(jumlahHariInput);

    if (isNaN(jumlahHari) || jumlahHari < 0) {
      console.log('Error: Jumlah hari harus berupa angka positif.');
      rl.close();
      return;
    }

    const indexHariNanti = (indexHariIni + jumlahHari) % 7;
    const namaHariNanti = daftarHari[indexHariNanti];

    const outputHariNanti = namaHariNanti.charAt(0).toUpperCase() + namaHariNanti.slice(1);
    const outputHariIni = hariIniLower.charAt(0).toUpperCase() + hariIniLower.slice(1);

    console.log(`\n${jumlahHari} hari setelah hari ${outputHariIni} adalah hari ${outputHariNanti}.`);
    rl.close();
  });
});