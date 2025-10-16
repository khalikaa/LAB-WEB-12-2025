// Inisialisasi UI elements - Mengambil referensi ke semua elemen HTML yang dibutuhkan
const ui = {
    playerHand: document.getElementById('player-hand'),
    gameBoard: document.getElementById('game-board'),
    botHand: document.getElementById('bot-hand'),
    discardPile: document.getElementById('discard-pile'),
    deck: document.getElementById('deck'),
    statusMessage: document.getElementById('status-message'),
    playerBalance: document.getElementById('player-balance'),
    turnIndicator: document.getElementById('turn-indicator'),
    playerCardCount: document.getElementById('player-card-count'),
    botCardCount: document.getElementById('bot-card-count'),
    startGameBtn: document.getElementById('start-game-btn'),
    betInput: document.getElementById('bet-input'),
    unoModal: document.getElementById('uno-modal'),
    unoButton: document.getElementById('uno-button'),
    colorPickerModal: document.getElementById('color-picker-modal'),
    colorOptions: document.querySelector('.color-options'),
    gameOverScreen: document.getElementById('game-over-screen'),
    restartGameBtn: document.getElementById('restart-game-btn'),
    challengeModal: document.getElementById('challenge-modal'),
    challengeUnoButton: document.getElementById('challenge-uno-button'),
};

// Game state - Menyimpan status permainan saat ini
let gameState = {
    deck: [],
    playerHand: [],
    botHand: [],
    discardPile: [],
    currentPlayer: 'player',
    currentColor: '',
    playerBalance: 5000,
    currentBet: 0,
    gameActive: false,
    unoCallTimer: null,
};

// Membuat deck kartu baru dengan semua kartu UNO
function createDeck() {
    const colors = ['red', 'green', 'blue', 'yellow'];
    const actionValues = ['Skip', 'Reverse', 'DrawTwo'];
    let deck = [];
    colors.forEach(color => {
        deck.push({ color, value: '0' });
        for (let i = 1; i <= 9; i++) {
            deck.push({ color, value: String(i) }, { color, value: String(i) });
        }
        actionValues.forEach(value => {
            deck.push({ color, value }, { color, value });
        });
    });
    for (let i = 0; i < 4; i++) {
        deck.push({ color: 'Wild', value: 'Wild' }, { color: 'Wild', value: 'WildDrawFour' });
    }
    return deck;
}

// Mengacak kartu dalam deck
function shuffleDeck(deck) {
    for (let i = deck.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [deck[i], deck[j]] = [deck[j], deck[i]];
    }
}

// Membagikan 7 kartu awal ke pemain dan bot
function dealInitialCards() {
    for (let i = 0; i < 7; i++) {
        gameState.playerHand.push(gameState.deck.pop());
        gameState.botHand.push(gameState.deck.pop());
    }
}

// Mendapatkan path gambar untuk kartu
function getCardImagePath(card) {
    if (card.color === 'Wild') {
        return `url('assets/images/${card.value}.png')`;
    }
    return `url('assets/images/${card.color}_${card.value}.png')`;
}

// Membuat elemen kartu HTML
function createCardElement(card, index) {
    const cardElement = document.createElement('div');
    cardElement.className = 'card';
    cardElement.style.backgroundImage = getCardImagePath(card);
    if (index !== undefined) {
        cardElement.dataset.cardIndex = index;
    }
    return cardElement;
}

// Render kartu di tangan pemain
function renderPlayerHand() {
    ui.playerHand.innerHTML = '';
    gameState.playerHand.forEach((card, index) => {
        ui.playerHand.appendChild(createCardElement(card, index));
    });
}

// Render kartu di tangan bot (tertutup)
function renderBotHand() {
    ui.botHand.innerHTML = '';
    gameState.botHand.forEach(() => {
        const cardElement = document.createElement('div');
        cardElement.className = 'card back';
        cardElement.style.backgroundImage = `url('assets/images/card_Back.png')`;
        ui.botHand.appendChild(cardElement);
    });
}

// Render kartu teratas di discard pile
function renderDiscardPile() {
    ui.discardPile.innerHTML = '';
    if (gameState.discardPile.length === 0) return;
    const topCard = gameState.discardPile[gameState.discardPile.length - 1];
    const cardElement = createCardElement(topCard);
    if (topCard.color === 'Wild') {
        cardElement.style.borderColor = gameState.currentColor;
        cardElement.style.borderWidth = '4px';
        cardElement.style.borderStyle = 'solid';
    }
    ui.discardPile.appendChild(cardElement);
}

// Update tampilan saldo pemain
function updateBalanceDisplay() {
    ui.playerBalance.textContent = `$${gameState.playerBalance}`;
}

// Update jumlah kartu yang dimiliki pemain dan bot
function updateCardCounts() {
    ui.playerCardCount.textContent = gameState.playerHand.length;
    ui.botCardCount.textContent = gameState.botHand.length;
}

// Render seluruh elemen game
function renderGame() {
    renderPlayerHand();
    renderBotHand();
    renderDiscardPile();
    highlightPlayableCards();
    updateCardCounts();
}

// Cek apakah kartu bisa dimainkan
function isValidMove(card, topCard) {
    if (!topCard) return true;
    return card.color === 'Wild' || card.color === gameState.currentColor || card.value === topCard.value;
}

// Highlight kartu yang bisa dimainkan oleh pemain
function highlightPlayableCards() {
    const topCard = gameState.discardPile[gameState.discardPile.length - 1];
    ui.playerHand.querySelectorAll('.card').forEach(cardElement => {
        const cardIndex = cardElement.dataset.cardIndex;
        const card = gameState.playerHand[cardIndex];
        cardElement.classList.toggle('playable', isValidMove(card, topCard));
    });
}

// Mengambil kartu dari deck
function drawCards(player, amount) {
    const hand = (player === 'player') ? gameState.playerHand : gameState.botHand;
    for (let i = 0; i < amount; i++) {
        if (gameState.deck.length > 0) {
            hand.push(gameState.deck.pop());
        }
    }
}

// Menerapkan efek khusus kartu (Draw Two, Wild Draw Four, dll)
function applyCardEffect(card, playedBy) {
    const target = (playedBy === 'player') ? 'bot' : 'player';
    let amountToDraw = 0;
    if (card.value === 'DrawTwo') amountToDraw = 2;
    if (card.value === 'WildDrawFour') amountToDraw = 4;
    if (amountToDraw > 0) {
        ui.statusMessage.textContent = `${target === 'player' ? 'Anda' : 'Bot'} mengambil ${amountToDraw} kartu!`;
        drawCards(target, amountToDraw);
    }
}

// Menangani kondisi UNO (saat pemain/bot memiliki 1 kartu)
function handleUnoState(player) {
    if (player === 'player') {
        ui.statusMessage.textContent = 'Anda tinggal punya 1 kartu! Tekan tombol UNO!';
        ui.unoModal.classList.remove('hidden');
        gameState.unoCallTimer = setTimeout(() => {
            ui.statusMessage.textContent = 'Terlambat menekan UNO! Anda mengambil 2 kartu penalti.';
            drawCards('player', 2);
            ui.unoModal.classList.add('hidden');
            renderGame();
        }, 5000);
    } else {
        ui.statusMessage.textContent = 'Bot tinggal punya 1 kartu! Cepat panggil UNO!';
        ui.challengeModal.classList.remove('hidden');
        
        gameState.botUnoChallengeTimer = setTimeout(() => {
            ui.challengeModal.classList.add('hidden');
        }, 3000);
    };
}


function switchTurn() {
    if (!gameState.gameActive) return;
    gameState.currentPlayer = (gameState.currentPlayer === 'player') ? 'bot' : 'player';
    if (gameState.currentPlayer === 'player') {
        ui.turnIndicator.textContent = 'Anda';
        ui.statusMessage.textContent = 'Giliran Anda!';
        highlightPlayableCards();
    } else {
        botTurn();
    }
}

// Logic untuk memainkan kartu
function playCard(player, cardIndex) {
    clearTimeout(gameState.unoCallTimer);
    clearTimeout(gameState.botUnoChallengeTimer);
    ui.unoModal.classList.add('hidden');
    ui.challengeModal.classList.add('hidden');
    const hand = (player === 'player') ? gameState.playerHand : gameState.botHand;
    const card = hand.splice(cardIndex, 1)[0];
    gameState.discardPile.push(card);
    if (card.color !== 'Wild') {
        gameState.currentColor = card.color;
    }
    applyCardEffect(card, player);
    renderGame();
    if (hand.length === 0) {
        endRound(player);
        return;
    }
    if (hand.length === 1) {
        handleUnoState(player);
    }
    if (card.color === 'Wild') {
        showColorPicker(player);
    } else if (['Skip', 'Reverse', 'DrawTwo'].includes(card.value)) {
        ui.statusMessage.textContent = 'Mainkan kartu lagi!';
        if (player === 'player') {
            highlightPlayableCards();
        } else {
            setTimeout(botTurn, 1500);
        }
    } else {
        switchTurn();
    }
}

// Handle klik kartu oleh pemain
function handlePlayerCardClick(e) {
    if (!gameState.gameActive || gameState.currentPlayer !== 'player') return;
    const cardElement = e.target.closest('.card');
    if (!cardElement) return;
    const cardIndex = cardElement.dataset.cardIndex;
    const card = gameState.playerHand[cardIndex];
    const topCard = gameState.discardPile[gameState.discardPile.length - 1];
    if (!isValidMove(card, topCard)) {
        ui.statusMessage.textContent = 'Kartu tidak cocok! Coba kartu lain atau ambil dari deck.';
        return;
    }
    if (card.value === 'WildDrawFour' && gameState.playerHand.some(c => c.color === gameState.currentColor)) {
        alert('Anda tidak bisa memainkan Wild +4 karena masih punya kartu dengan warna yang cocok!');
        return;
    }
    playCard('player', cardIndex);
}

// Handle pengambilan kartu dari deck
function drawCardFromDeck() {
    if (!gameState.gameActive || gameState.currentPlayer !== 'player' || gameState.deck.length === 0) return;
    drawCards('player', 1);
    const newCard = gameState.playerHand[gameState.playerHand.length - 1];
    ui.statusMessage.textContent = `Anda mengambil kartu ${newCard.color} ${newCard.value}.`;
    renderGame();
    const topCard = gameState.discardPile[gameState.discardPile.length - 1];
    if (isValidMove(newCard, topCard)) {
        ui.statusMessage.textContent += ' Kartu ini bisa dimainkan! Mainkan atau lewati giliran.';
    } else {
        ui.statusMessage.textContent += ' Kartu ini tidak bisa dimainkan. Giliran dilewati.';
        setTimeout(switchTurn, 1500);
    }
}

// Handle pemilihan warna untuk kartu Wild
function handleColorChoice(color) {
    gameState.currentColor = color;
    ui.statusMessage.textContent = `Warna diubah menjadi ${color}.`;
    ui.colorPickerModal.classList.add('hidden');
    renderDiscardPile();
    const topCard = gameState.discardPile[gameState.discardPile.length - 1];
    if (topCard.value === 'WildDrawFour') {
        ui.statusMessage.textContent = 'Mainkan kartu lagi!';
        if (gameState.currentPlayer === 'player') {
            highlightPlayableCards();
        } else {
            setTimeout(botTurn, 1500);
        }
    } else {
        switchTurn();
    }
}

// Menampilkan color picker untuk kartu Wild
function showColorPicker(player) {
    if (player === 'player') {
        ui.colorPickerModal.classList.remove('hidden');
    } else {
        const colorsInHand = gameState.botHand.map(card => card.color).filter(color => color !== 'Wild');
        if (colorsInHand.length === 0) {
            handleColorChoice('red');
            return;
        }
        const colorCounts = colorsInHand.reduce((acc, color) => {
            acc[color] = (acc[color] || 0) + 1;
            return acc;
        }, {});
        const chosenColor = Object.keys(colorCounts).reduce((a, b) => colorCounts[a] > colorCounts[b] ? a : b);
        handleColorChoice(chosenColor);
    }
}

// Logic giliran bot
function botTurn() {
    if (!gameState.gameActive || gameState.currentPlayer !== 'bot') return;
    ui.statusMessage.textContent = 'Bot sedang berpikir...';
    ui.turnIndicator.textContent = 'Bot';
    setTimeout(() => {
        const topCard = gameState.discardPile[gameState.discardPile.length - 1];
        let playableCardIndex = gameState.botHand.findIndex(card => card.color !== 'Wild' && isValidMove(card, topCard));
        if (playableCardIndex === -1) {
            playableCardIndex = gameState.botHand.findIndex(card => card.color === 'Wild' && isValidMove(card, topCard));
        }
        if (playableCardIndex !== -1 && gameState.botHand[playableCardIndex].value === 'WildDrawFour') {
            if (gameState.botHand.some(c => c.color === gameState.currentColor)) {
                playableCardIndex = -1;
            }
        }
        if (playableCardIndex !== -1) {
            playCard('bot', playableCardIndex);
        } else {
            if (gameState.deck.length > 0) {
                drawCards('bot', 1);
                const newCard = gameState.botHand[gameState.botHand.length - 1];
                ui.statusMessage.textContent = 'Bot mengambil satu kartu.';
                renderBotHand();
                if (isValidMove(newCard, topCard)) {
                    setTimeout(() => playCard('bot', gameState.botHand.length - 1), 1000);
                } else {
                    setTimeout(switchTurn, 1000);
                }
            } else {
                switchTurn();
            }
        }
    }, 1500);
}

// Mengakhiri ronde dan menghitung hasil
function endRound(winner) {
    gameState.gameActive = false;
    ui.playerHand.removeEventListener('click', handlePlayerCardClick);
    if (winner === 'player') {
        ui.statusMessage.textContent = `Selamat! Anda memenangkan ronde dan mendapat $${gameState.currentBet * 2}`;
        gameState.playerBalance += (gameState.currentBet * 2);
        ui.statusMessage.textContent = `Selamat! Anda memenangkan ronde dan mendapat $${gameState.currentBet * 2}`;
    } else {
        ui.statusMessage.textContent = `Sayang sekali! Bot memenangkan ronde ini.`;
        gameState.playerBalance -= (gameState.currentBet);
    } 
    updateBalanceDisplay();
    ui.startGameBtn.classList.remove('hidden');
    ui.betInput.classList.remove('hidden');
    if (gameState.playerBalance <= 0) {
        setTimeout(() => ui.gameOverScreen.classList.remove('hidden'), 2000);
    }
}

// Memulai game baru
function startGame(bet) {
    Object.assign(gameState, {
        gameActive: true,
        currentBet: bet,
        playerHand: [],
        botHand: [],
        discardPile: [],
    });
    gameState.playerBalance -= bet;
    updateBalanceDisplay();
    gameState.deck = createDeck();
    shuffleDeck(gameState.deck);
    dealInitialCards();
    let firstCard = gameState.deck.pop();
    while (firstCard.value === 'WildDrawFour') {
        gameState.deck.push(firstCard);
        shuffleDeck(gameState.deck);
        firstCard = gameState.deck.pop();
    }
    gameState.discardPile.push(firstCard);
    gameState.currentColor = firstCard.color;
    gameState.currentPlayer = 'player';
    ui.turnIndicator.textContent = 'Anda';
    ui.statusMessage.textContent = 'Giliran Anda untuk bermain!';
    renderGame();
    ui.playerHand.addEventListener('click', handlePlayerCardClick);
    if (gameState.discardPile[0].color === 'Wild') {
        setTimeout(() => showColorPicker('player'), 500);
    }
}

// Setup event listeners untuk interaksi user
function setupEventListeners() {
    ui.startGameBtn.addEventListener('click', () => {
        const betAmount = parseInt(ui.betInput.value);
        if (isNaN(betAmount) || betAmount < 100) {
            return alert("Taruhan minimal adalah $100.");
        }
        if (betAmount > gameState.playerBalance) {
            return alert("Saldo Anda tidak mencukupi untuk taruhan ini.");
        }
        ui.startGameBtn.classList.add('hidden');
        ui.betInput.classList.add('hidden');
        startGame(betAmount);
    });
    ui.gameBoard.addEventListener('dblclick', () => {
        if (gameState.gameActive && gameState.currentPlayer === 'player') {
            ui.statusMessage.textContent = 'Anda memilih untuk melewati giliran.';
            setTimeout(switchTurn, 500);
        }
    });
    ui.deck.addEventListener('click', drawCardFromDeck);
    ui.unoButton.addEventListener('click', () => {
        clearTimeout(gameState.unoCallTimer);
        ui.unoModal.classList.add('hidden');
        ui.statusMessage.textContent = 'Anda berhasil memanggil UNO!';
    });
    ui.challengeUnoButton.addEventListener('click', () => {
        clearTimeout(gameState.botUnoChallengeTimer); // Hentikan timer
        ui.challengeModal.classList.add('hidden'); // Sembunyikan tombol
        ui.statusMessage.textContent = 'Berhasil! Bot mengambil 2 kartu penalti.';
        drawCards('bot', 2); // Beri penalti ke bot
        renderGame(); // Perbarui tampilan
    });
    ui.colorOptions.addEventListener('click', (e) => {
        if (e.target.classList.contains('color-box')) {
            handleColorChoice(e.target.id);
        }
    });
    ui.restartGameBtn.addEventListener('click', () => {
        gameState.playerBalance = 5000;
        updateBalanceDisplay();
        ui.gameOverScreen.classList.add('hidden');
        ui.statusMessage.textContent = 'Masukkan taruhan untuk memulai ronde baru.';
    });
}

// Inisialisasi game
updateBalanceDisplay();
setupEventListeners();