const readline = require("readline");
const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout,
});

function askQuestion(query) {
  return new Promise((resolve) => rl.question(query, resolve));
}

const daysInWeek = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];

async function timeTravelCalculator() {
  console.log("--- Kalkulator Hari Masa Depan ---");
  
  const startDayInput = await askQuestion("Masukkan nama hari ini: ");
  const startDay = startDayInput.toLowerCase().trim();

  const startDayIndex = daysInWeek.indexOf(startDay);

  if (startDayIndex === -1) {
    console.log("Nama hari tidak valid. Pastikan penulisan benar (e.g., 'senin', 'selasa').");
    rl.close();
    return;
  }

  const daysToAddInput = await askQuestion("Berapa hari ke depan yang ingin dicek? ");
  const daysToAdd = parseInt(daysToAddInput);

  if (isNaN(daysToAdd) || daysToAdd < 0) {
    console.log("Jumlah hari tidak valid. Mohon masukkan angka positif.");
    rl.close();
    return;
  }

  const futureDayIndex = (startDayIndex + daysToAdd) % daysInWeek.length;

  const futureDay = daysInWeek[futureDayIndex];

  console.log(`\n${daysToAdd} hari setelah hari ${startDay} adalah hari ${futureDay}.`);

  rl.close();
}

timeTravelCalculator();