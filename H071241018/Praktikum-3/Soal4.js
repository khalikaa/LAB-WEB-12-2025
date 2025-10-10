const readline = require("readline");
const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout,
});

function askQuestion(query) {
  return new Promise((resolve) => rl.question(query, resolve));
}

async function startGuessingGame() {
  console.log("========================================");
  console.log("🎮 Selamat Datang di Game Tebak Angka 🎮");
  console.log("========================================");
  
  const secretNumber = Math.floor(Math.random() * 100) + 1;
  let attempts = 0;
  let guessedCorrectly = false;

  console.log("Aku sudah memilih sebuah angka antara 1 dan 100. Ayo tebak!");

  while (!guessedCorrectly) {
    const guessInput = await askQuestion(`Percobaan #${attempts + 1}: Masukkan tebakanmu: `);
    const guess = parseInt(guessInput);

    if (isNaN(guess) || guess < 1 || guess > 100) {
      console.log("Input tidak valid! Masukkan angka antara 1 dan 100.");
      continue;
    }

    attempts++;

    if (guess < secretNumber) {
      console.log("Terlalu rendah! Coba lagi.");
    } else if (guess > secretNumber) {
      console.log("Terlalu tinggi! Coba lagi.");
    } else {
      guessedCorrectly = true;
      console.log(`\n🎉 Selamat! Kamu berhasil menebak angka ${secretNumber}!`);
      console.log(`Kamu memerlukan ${attempts} kali percobaan.`);
    }
  }

  rl.close();
}

startGuessingGame();