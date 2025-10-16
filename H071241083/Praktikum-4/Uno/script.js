const colors = ["red", "blue", "green", "yellow"];
const values = [
  "0",
  "1",
  "2",
  "3",
  "4",
  "5",
  "6",
  "7",
  "8",
  "9",
  "skip",
  "reverse",
  "plus2",
];


function createDeck() {
  let deck = [];
  
  for (const color of colors) {
    for (const value of values) {
      deck.push({ color, value, image: `${color}_${value}.png` });
    }
  }

  
  deck.push({ color: "wild", value: "wild", image: "wild.png" });
  deck.push({ color: "wild", value: "plus4", image: "plus_4.png" });

  return deck;
}


let gameDeck = [];
let playerHand = [];
let botHand = [];
let discardPile = [];
let currentPlayer = "player";
let playerBalance = 5000;
let currentBet = 0;
let isBettingPhase = true;
let unoButtonTimer = null;
let unoButtonActive = false;
let gameDirection = 1;
let isCardPlayedThisTurn = false;
let hasDrawnCardThisTurn = false;


const playerHandEl = document.getElementById("player-hand");
const botHandEl = document.getElementById("bot-hand");
const deckEl = document.getElementById("deck");
const discardPileEl = document.getElementById("discard-pile");
const gameStatusEl = document.getElementById("game-status");
const unoButtonEl = document.getElementById("uno-button");
const unoButtonContainerEl = document.querySelector(".uno-button-container");
const playerCardCountEl = document.getElementById("player-card-count");
const botCardCountEl = document.getElementById("bot-card-count");
const playerBalanceDisplayEl = document.getElementById(
  "player-balance-display"
);
const currentBetDisplayEl = document.getElementById("current-bet-display");
const bettingAreaEl = document.getElementById("betting-area");
const betInputEl = document.getElementById("bet-input");
const placeBetButtonEl = document.getElementById("place-bet-button");
const wildColorsEl = document.getElementById("wild-colors");
const gameOverModalEl = document.getElementById("game-over-modal");
const gameOverTitleEl = document.getElementById("game-over-title");
const gameOverMessageEl = document.getElementById("game-over-message");
const restartButtonEl = document.getElementById("restart-button");

function shuffleDeck(deck) {
  for (let i = deck.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [deck[i], deck[j]] = [deck[j], deck[i]];
  }
}

function dealCards() {
  playerHand = [];
  botHand = [];
  for (let i = 0; i < 7; i++) {
    playerHand.push(gameDeck.pop());
    botHand.push(gameDeck.pop());
  }
  let startCard = gameDeck.pop();
  while (
    startCard.value === "skip" ||
    startCard.value === "reverse" ||
    startCard.value === "plus2" ||
    startCard.color === "wild"
  ) {
    gameDeck.push(startCard);
    shuffleDeck(gameDeck);
    startCard = gameDeck.pop();
  }
  discardPile.push(startCard);
}

function updateUI() {
  renderHands();
  const topCard = discardPile[discardPile.length - 1];
  discardPileEl.style.backgroundImage = `url('kartu/${topCard.image}')`;
  discardPileEl.parentElement.style.borderColor =
    topCard.color === "wild" ? "#FFF" : "transparent";
  discardPileEl.parentElement.style.borderWidth = "2px";
  discardPileEl.parentElement.style.borderStyle = "solid";
  playerCardCountEl.textContent = playerHand.length;
  botCardCountEl.textContent = botHand.length;
  playerBalanceDisplayEl.textContent = `Saldo: $${playerBalance}`;
  currentBetDisplayEl.textContent = currentBet;
}

function renderHands() {
  playerHandEl.innerHTML = "";
  playerHand.forEach((card) => {
    const cardEl = document.createElement("div");
    cardEl.classList.add("card", "card-player");
    cardEl.style.backgroundImage = `url('kartu/${card.image}')`;
    cardEl.dataset.color = card.color;
    cardEl.dataset.value = card.value;
    playerHandEl.appendChild(cardEl);
  });
  botHandEl.innerHTML = "";
  botHand.forEach(() => {
    const cardEl = document.createElement("div");
    cardEl.classList.add("card", "card-bot");
    cardEl.style.backgroundImage = `url('kartu/card_back.png')`;
    botHandEl.appendChild(cardEl);
  });
}

function canPlayCard(card) {
  const topCard = discardPile[discardPile.length - 1];
  if (card.color === "wild") return true;
  return card.color === topCard.color || card.value === topCard.value;
}

function checkWin() {
  if (playerHand.length === 0) {
    gameOver(true);
    return true;
  }
  if (botHand.length === 0) {
    gameOver(false);
    return true;
  }
  return false;
}

function gameOver(isPlayerWinner) {
  isBettingPhase = true;
  bettingAreaEl.style.display = "flex";
  if (isPlayerWinner) {
    playerBalance += currentBet;
    gameOverTitleEl.textContent = "Anda Menang!";
    gameOverMessageEl.textContent = `Selamat, Anda memenangkan $${currentBet}!`;
  } else {
    playerBalance -= currentBet;
    gameOverTitleEl.textContent = "Anda Kalah!";
    gameOverMessageEl.textContent = `Anda kalah $${currentBet}.`;
  }

  if (playerBalance <= 0) {
    gameOverTitleEl.textContent = "Game Over";
    gameOverMessageEl.textContent = "Saldo Anda habis. Mari coba lagi!";
    restartButtonEl.textContent = "Mulai Ulang";
    restartButtonEl.onclick = () => {
      playerBalance = 5000;
      gameOverModalEl.classList.add("hidden");
      bettingAreaEl.style.display = "flex";
      updateUI();
    };
  } else {
    restartButtonEl.textContent = "Lanjut ke Ronde Berikutnya";
    restartButtonEl.onclick = () => {
        gameOverModalEl.classList.add("hidden");
        isBettingPhase = true;
        bettingAreaEl.style.display = 'flex';
        updateUI();
    };
  }
  currentBet = 0;
  gameOverModalEl.classList.remove("hidden");
  unoButtonContainerEl.style.display = "none";
  updateUI();
}


function switchTurn() {
  currentPlayer = currentPlayer === "player" ? "bot" : "player";
  isCardPlayedThisTurn = false;
  hasDrawnCardThisTurn = false;
  gameStatusEl.textContent =
    currentPlayer === "player" ? "Giliran Anda." : "Giliran Bot...";
  if (currentPlayer === "bot") {
    setTimeout(handleBotTurn, 1500);
  }
}

function handleCardPlay(card, player) {
  const hand = player === "player" ? playerHand : botHand;
  const index = hand.findIndex(
    (c) => c.color === card.color && c.value === card.value
  );

  if (index > -1) {
    const playedCard = hand.splice(index, 1)[0];
    discardPile.push(playedCard);
    isCardPlayedThisTurn = true;
    updateUI();

    if (player === "player" && playerHand.length === 1) startUnoTimer();
    else clearUnoTimer();

    let turnEnds = true;
    const opponent = player === 'player' ? 'Bot' : 'Anda';

    if (playedCard.value === "skip") {
      gameStatusEl.textContent = `${player === 'player' ? 'Anda memainkan' : 'Bot memainkan'} kartu Skip! ${opponent} dilewati. Giliran berlanjut!`;
      turnEnds = false;
    } else if (playedCard.value === "reverse") {
      gameStatusEl.textContent = `Arah permainan dibalik! ${player === 'player' ? 'Anda' : 'Bot'} main lagi!`;
      turnEnds = false;
    } else if (playedCard.value === "plus2") {
      gameStatusEl.textContent = `${player === 'player' ? 'Anda memainkan' : 'Bot memainkan'} kartu +2! ${opponent} mengambil 2 kartu. Giliran berlanjut!`;
      drawCards(player === "player" ? botHand : playerHand, 2);
      turnEnds = false;
    } else if (playedCard.color === "wild") {
      if (player === "player") {
        showWildColorPicker(playedCard);
        return;
      } else {
        const newColor = colors[Math.floor(Math.random() * colors.length)];
        discardPile[discardPile.length - 1].color = newColor;
        gameStatusEl.textContent = `Bot memainkan Wild. Warna berubah menjadi ${newColor.toUpperCase()}.`;
        if (playedCard.value === "plus4") {
          gameStatusEl.textContent += ` ${opponent} mengambil 4 kartu.`;
          drawCards(playerHand, 4);
          turnEnds = false;
        }
      }
    }

    if (checkWin()) return;

    if (turnEnds) {
      switchTurn();
    } else if (player === 'bot') {
      isCardPlayedThisTurn = false;
      setTimeout(handleBotTurn, 1500);
    } else {
      isCardPlayedThisTurn = false;
    }
  }
}

function drawCards(hand, num) {
  const drawnCards = [];
  for (let i = 0; i < num; i++) {
    if (gameDeck.length === 0) {
      const topCard = discardPile.pop();
      gameDeck = [...discardPile];
      shuffleDeck(gameDeck);
      discardPile = [topCard];
    }
    const card = gameDeck.pop();
    hand.push(card);
    drawnCards.push(card);
  }
  updateUI();
  return drawnCards;
}

function handleBotTurn() {
  const playableCards = botHand.filter((card) => canPlayCard(card));
  let cardToPlay = null;

  if (playableCards.length > 0) {
    const actionCards = playableCards.filter(c => ["skip", "reverse", "plus2"].includes(c.value));
    if (actionCards.length > 0) {
      cardToPlay = actionCards[0];
    } else {
      cardToPlay = playableCards[0];
    }
  } else {
    const wildPlus4 = botHand.find(c => c.value === 'plus4');
    if (wildPlus4) cardToPlay = wildPlus4;
  }

  if (cardToPlay) {
    handleCardPlay(cardToPlay, "bot");
  } else {
    gameStatusEl.textContent = "Bot mengambil kartu dari dek.";
    const [drawnCard] = drawCards(botHand, 1);
    if (canPlayCard(drawnCard)) {
      setTimeout(() => {
        gameStatusEl.textContent = "Bot memainkan kartu yang baru diambil.";
        handleCardPlay(drawnCard, "bot");
      }, 1000);
    } else {
      setTimeout(switchTurn, 1000);
    }
  }

  if (botHand.length === 1) {
    setTimeout(() => {
      gameStatusEl.textContent = "Bot meneriakkan UNO!";
      unoButtonContainerEl.style.display = "none";
    }, 500);
  }
}


function showWildColorPicker(card) {
  wildColorsEl.style.display = "flex";
  wildColorsEl.querySelectorAll("div").forEach((picker) => {
    picker.onclick = () => {
      const newColor = picker.dataset.color;
      discardPile[discardPile.length - 1].color = newColor;
      wildColorsEl.style.display = "none";
      gameStatusEl.textContent = `Warna diubah menjadi ${newColor.toUpperCase()}.`;
      let turnEnds = true;
      if (card.value === "plus4") {
        gameStatusEl.textContent += " Bot mengambil 4 kartu. Anda main lagi!";
        drawCards(botHand, 4);
        turnEnds = false;
      }
      updateUI();
      if (checkWin()) return;
      if(turnEnds) switchTurn();
      else isCardPlayedThisTurn = false;
    };
  });
}

function startUnoTimer() {
  unoButtonActive = true;
  unoButtonContainerEl.style.display = "block";
  gameStatusEl.textContent = "Anda hanya punya 1 kartu tersisa. Tekan UNO!";
  unoButtonTimer = setTimeout(() => {
    if (unoButtonActive) {
      gameStatusEl.textContent = "Terlambat menekan UNO! Penalti +2 kartu.";
      drawCards(playerHand, 2);
      unoButtonActive = false;
      unoButtonContainerEl.style.display = "none";
    }
  }, 5000);
}

function clearUnoTimer() {
  clearTimeout(unoButtonTimer);
  unoButtonActive = false;
  unoButtonContainerEl.style.display = "none";
}

placeBetButtonEl.addEventListener("click", () => {
  const bet = parseInt(betInputEl.value);
  if (isNaN(bet) || bet < 100 || bet > playerBalance) {
    alert("Taruhan tidak valid. Minimal $100 dan tidak boleh melebihi saldo.");
    return;
  }
  currentBet = bet;
  isBettingPhase = false;
  bettingAreaEl.style.display = "none";
  startGame();
});

deckEl.addEventListener("click", () => {
  if (currentPlayer !== "player" || isCardPlayedThisTurn) return;
  if (hasDrawnCardThisTurn) {
    gameStatusEl.textContent = "Anda memilih untuk melewati giliran.";
    setTimeout(switchTurn, 1000);
    return;
  }
  const [drawnCard] = drawCards(playerHand, 1);
  hasDrawnCardThisTurn = true;
  if (canPlayCard(drawnCard)) {
    gameStatusEl.textContent =
      "Anda mendapat kartu yang bisa dimainkan! Mainkan kartu itu, atau klik dek lagi untuk lewat.";
  } else {
    gameStatusEl.textContent =
      "Kartu yang diambil tidak cocok. Giliran selesai.";
    setTimeout(switchTurn, 1000);
  }
});

playerHandEl.addEventListener("click", (event) => {
  if (currentPlayer !== "player" || isCardPlayedThisTurn) return;
  const cardEl = event.target.closest(".card");
  if (!cardEl) return;
  const card = {
    color: cardEl.dataset.color,
    value: cardEl.dataset.value,
  };

  if (card.value === "plus4") {
    const hasOtherPlayable = playerHand.some(
      (c) => canPlayCard(c) && c.color !== 'wild'
    );
    if (hasOtherPlayable) {
      gameStatusEl.textContent =
        "Kartu +4 hanya bisa dimainkan jika tidak ada kartu lain yang cocok.";
      return;
    }
  }

  if (canPlayCard(card)) {
    handleCardPlay(card, "player");
  } else {
    gameStatusEl.textContent =
      "Kartu tidak cocok. Mainkan kartu lain atau ambil dari dek.";
  }
});

unoButtonEl.addEventListener("click", () => {
  if (playerHand.length === 1 && unoButtonActive) {
    clearUnoTimer();
    gameStatusEl.textContent = "Anda berhasil menekan UNO!";
  }
});

function startGame() {
  gameDeck = createDeck();
  shuffleDeck(gameDeck);
  dealCards();
  currentPlayer = "player";
  gameStatusEl.textContent = "Giliran Anda untuk memulai permainan.";
  isCardPlayedThisTurn = false;
  hasDrawnCardThisTurn = false;
  updateUI();
}

updateUI();