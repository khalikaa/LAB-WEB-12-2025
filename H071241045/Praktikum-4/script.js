const gameState = {
    balance: 5000,           // Saldo pemain
    currentBet: 0,           // Taruhan saat ini
    deck: [],                // Kumpulan kartu yang belum dibagikan
    playerHand: [],          // Kartu milik pemain
    botHand: [],             // Kartu milik bot (komputer)
    discardPile: [],         // Tumpukan kartu buangan
    currentColor: '',        // Warna aktif saat ini di permainan
    currentTurn: 'player',   // Giliran siapa ('player' atau 'bot')
    gameActive: false,       // Status permainan aktif atau tidak
    unoTimer: null,          // Timer untuk fitur UNO
    unoTimerSeconds: 5,      // Waktu hitung mundur untuk panggil UNO
    playerCalledUno: false,  // Apakah pemain sudah memanggil UNO
    botCalledUno: false,     // Apakah bot sudah memanggil UNO
    lastPlayedCard: null     // Kartu terakhir yang dimainkan
};

const ASSET_PATH = '.\\Assets\\';

document.addEventListener('DOMContentLoaded', () => {
    initializeGame();
});

function initializeGame() {
    updateBalanceDisplay();
    
    document.getElementById('startGameBtn').addEventListener('click', startGame);
    document.getElementById('quitBtn').addEventListener('click', quitGame);
    document.getElementById('restartBtn').addEventListener('click', resetGame);
    document.getElementById('unoBtn').addEventListener('click', callUno);
    document.getElementById('deck').addEventListener('click', drawCard);
    
    document.querySelectorAll('.color-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            selectColor(e.target.dataset.color);
        });
    });
}

function updateBalanceDisplay() {
    document.getElementById('balanceDisplay').textContent = `$${gameState.balance}`;
    document.getElementById('maxBet').textContent = `$${gameState.balance}`;
    document.getElementById('currentBalance').textContent = `$${gameState.balance}`;
}

function startGame() {
    const betInput = document.getElementById('betAmount');
    const bet = parseInt(betInput.value);
    
    if (!bet || bet < 100) {
        alert('Taruhan minimal $100!');
        return;
    }
    
    if (bet > gameState.balance) {
        alert('Saldo tidak cukup!');
        return;
    }
    
    gameState.currentBet = bet;
    document.getElementById('currentBet').textContent = `$${bet}`;
    
    document.getElementById('bettingScreen').classList.remove('active');
    document.getElementById('gameScreen').classList.add('active');
    
    initializeRound();
}

function initializeRound() {

    gameState.deck = createDeck();
    shuffleDeck();

    gameState.playerHand = [];
    gameState.botHand = [];
    
    for (let i = 0; i < 7; i++) {
        gameState.playerHand.push(gameState.deck.pop());
        gameState.botHand.push(gameState.deck.pop());
    }
    let initialCard;
    do {
        initialCard = gameState.deck.pop();
    } while (initialCard.type === 'wild' || initialCard.type === 'action');
    
    gameState.discardPile = [initialCard];
    gameState.currentColor = initialCard.color;
    gameState.lastPlayedCard = initialCard;
    
    gameState.playerCalledUno = false;
    gameState.botCalledUno = false;
    
    gameState.currentTurn = 'player';
    gameState.gameActive = true;

    renderGame();
    updateGameStatus();
    addLog('Permainan dimulai! Anda mendapat giliran pertama.', 'system');
}

function createDeck() {
    const deck = [];
    const colors = ['red', 'blue', 'green', 'yellow'];
    
    colors.forEach(color => {
        deck.push({ color, value: 0, type: 'number' });
    
        for (let i = 1; i <= 9; i++) {
            deck.push({ color, value: i, type: 'number' });
            deck.push({ color, value: i, type: 'number' });
        }
    
        deck.push({ color, value: 'skip', type: 'action' });
        deck.push({ color, value: 'skip', type: 'action' });
        
        deck.push({ color, value: 'reverse', type: 'action' });
        deck.push({ color, value: 'reverse', type: 'action' });
        
        deck.push({ color, value: 'plus2', type: 'action' });
        deck.push({ color, value: 'plus2', type: 'action' });
    });
    
    for (let i = 0; i < 4; i++) {
        deck.push({ color: 'wild', value: 'wild', type: 'wild' });
        
        deck.push({ color: 'wild', value: 'plus4', type: 'wild' });
    }
    
    return deck;
}

function shuffleDeck() {
    for (let i = gameState.deck.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [gameState.deck[i], gameState.deck[j]] = [gameState.deck[j], gameState.deck[i]];
    }
}

function renderGame() {
    renderPlayerCards();
    renderBotCards();
    renderDiscardPile();
    updateDeckCount();
    updateCardCounts();
    checkUnoStatus();
}

function renderPlayerCards() {
    const container = document.getElementById('playerCards');
    container.innerHTML = '';
    
    gameState.playerHand.forEach((card, index) => {
        const cardElement = createCardElement(card, index, 'player');
        container.appendChild(cardElement);
    });
    
    updatePlayerCardStates();
}

function renderBotCards() {
    const container = document.getElementById('botCards');
    container.innerHTML = '';
    
    gameState.botHand.forEach(() => {
        const cardElement = document.createElement('div');
        cardElement.className = 'card';
        const img = document.createElement('img');
        img.src = ASSET_PATH + 'card_back.png';
        img.alt = 'Bot Card';
        cardElement.appendChild(img);
        container.appendChild(cardElement);
    });
}

function createCardElement(card, index, owner) {
    const cardElement = document.createElement('div');
    cardElement.className = 'card';
    cardElement.dataset.index = index;
    
    const img = document.createElement('img');
    img.src = getCardImagePath(card);
    img.alt = `${card.color} ${card.value}`;
    cardElement.appendChild(img);
    
    if (owner === 'player') {
        if (gameState.currentTurn === 'player' && canPlayCard(card, gameState.playerHand)) {
            cardElement.addEventListener('click', () => playCard(index));
        } else {
            cardElement.classList.add('disabled');
        }
    }
    
    return cardElement;
}

function updatePlayerCardStates() {
    const cards = document.querySelectorAll('#playerCards .card');
    cards.forEach((cardEl, index) => {
        const card = gameState.playerHand[index];
        
        if (gameState.currentTurn === 'player' && canPlayCard(card, gameState.playerHand)) {
            cardEl.classList.remove('disabled');
            cardEl.style.cursor = 'pointer';
        } else {
            cardEl.classList.add('disabled');
            cardEl.style.cursor = 'not-allowed';
        }
    });
}

function getCardImagePath(card) {
    if (card.color === 'wild') {
        if (card.value === 'wild') {
            return ASSET_PATH + 'wild.png';
        } else if (card.value === 'plus4') {
            return ASSET_PATH + 'plus_4.png';
        }
    }
    
    const fileName = `${card.color}_${card.value}.png`;
    return ASSET_PATH + fileName;
}

function renderDiscardPile() {
    const container = document.getElementById('discardPile');
    container.innerHTML = '';
    
    if (gameState.discardPile.length > 0) {
        const topCard = gameState.discardPile[gameState.discardPile.length - 1];
        const img = document.createElement('img');
        img.src = getCardImagePath(topCard);
        img.alt = 'Discard Pile';
        container.appendChild(img);
    }
}

function updateDeckCount() {
    document.getElementById('deckCount').textContent = gameState.deck.length;
}

function updateCardCounts() {
    document.getElementById('playerCardCount').textContent = `${gameState.playerHand.length} kartu`;
    document.getElementById('botCardCount').textContent = `${gameState.botHand.length} kartu`;
}

function updateGameStatus() {
    const statusElement = document.getElementById('gameStatus');
    const messageElement = statusElement.querySelector('.status-message');
    
    if (gameState.currentTurn === 'player') {
        messageElement.textContent = 'Giliran Anda!';
        statusElement.style.background = 'rgba(245, 87, 108, 0.9)';
    } else {
        messageElement.textContent = 'Giliran Bot...';
        statusElement.style.background = 'rgba(102, 126, 234, 0.9)';
    }
}

function canPlayCard(card, hand = null) {
    const topCard = gameState.discardPile[gameState.discardPile.length - 1];
    
    if (card.type === 'wild') {
        if (card.value === 'plus4') {
            const checkHand = hand || gameState.playerHand;
            const hasMatching = checkHand.some(c => {
                if (c === card) return false;
                if (c.type === 'wild') return false;
                return c.color === gameState.currentColor || c.value === topCard.value;
            });
            return !hasMatching;
        }
        return true;
    }
 
    return card.color === gameState.currentColor || 
           card.value === topCard.value;
}

function playCard(index) {
    if (gameState.currentTurn !== 'player' || !gameState.gameActive) return;
    
    const card = gameState.playerHand[index];
    
    if (!canPlayCard(card)) {
        addLog('Kartu ini tidak bisa dimainkan!', 'system');
        return;
    }
    
    gameState.playerHand.splice(index, 1);
    
    gameState.discardPile.push(card);
    gameState.lastPlayedCard = card;
    
    addLog(`Anda memainkan ${card.color} ${card.value}`, 'player');
   
    if (card.type === 'wild') {
        showColorPicker();
        return; 
    } else {
        gameState.currentColor = card.color;
        handleCardEffect(card, 'player');
    }
}

function handleCardEffect(card, player) {
    const opponent = player === 'player' ? 'bot' : 'player';
    
    if (card.value === 'skip') {
        addLog(`${player === 'player' ? 'Anda' : 'Bot'} melewati giliran lawan!`, player);
        renderGame();
        updateGameStatus();
        
        if (checkWin(player)) return;
        setTimeout(() => {
            if (player === 'bot') {
                botTurn();
            }
        }, 1000);
        return;
    }
    
    if (card.value === 'reverse') {
        addLog(`${player === 'player' ? 'Anda' : 'Bot'} membalik arah (skip)!`, player);
        renderGame();
        updateGameStatus();
        
        if (checkWin(player)) return;
        
        setTimeout(() => {
            if (player === 'bot') {
                botTurn();
            }
        }, 1000);
        return;
    }
    
    if (card.value === 'plus2') {
        addLog(`${opponent === 'player' ? 'Anda' : 'Bot'} mengambil 2 kartu!`, player);
        if (opponent === 'player') {
            drawCardsForPlayer(2);
        } else {
            drawCardsForBot(2);
        }
        
        renderGame();
        updateGameStatus();
        
        if (checkWin(player)) return;
      
        setTimeout(() => {
            if (player === 'bot') {
                botTurn();
            }
        }, 1000);
        return;
    }
    
    if (card.value === 'plus4') {
        addLog(`${opponent === 'player' ? 'Anda' : 'Bot'} mengambil 4 kartu!`, player);
        if (opponent === 'player') {
            drawCardsForPlayer(4);
        } else {
            drawCardsForBot(4);
        }
        
        renderGame();
        updateGameStatus();
        
        if (checkWin(player)) return;
        
        setTimeout(() => {
            if (player === 'bot') {
                botTurn();
            }
        }, 1000);
        return;
    }
    renderGame();
    
    if (checkWin(player)) return;
    
    switchTurn();
}

function showColorPicker() {
    document.getElementById('colorPickerModal').classList.add('active');
}

function selectColor(color) {
    gameState.currentColor = color;
    document.getElementById('colorPickerModal').classList.remove('active');
    
    addLog(`Warna dipilih: ${color}`, 'player');

    const lastCard = gameState.lastPlayedCard;
    if (lastCard.value === 'plus4') {
        addLog('Bot mengambil 4 kartu!', 'player');
        drawCardsForBot(4);
    }
    
    renderGame();
    
    if (checkWin('player')) return;
    updateGameStatus();
}

function drawCard() {
    if (gameState.currentTurn !== 'player' || !gameState.gameActive) return;

    const hasPlayable = gameState.playerHand.some(card => canPlayCard(card, gameState.playerHand));
    
    if (hasPlayable) {
        addLog('Anda masih punya kartu yang bisa dimainkan!', 'system');
        return;
    }
    
    if (gameState.deck.length === 0) {
        reshuffleDeck();
    }
    
    const card = gameState.deck.pop();
    gameState.playerHand.push(card);
    
    addLog('Anda mengambil 1 kartu', 'player');
    if (canPlayCard(card, gameState.playerHand)) {
        addLog('Kartu yang diambil bisa dimainkan!', 'system');
        renderGame();
        updateGameStatus();
    } else {
        addLog('Kartu tidak bisa dimainkan, giliran dilewati', 'system');
        renderGame();
        switchTurn();
    }
}

function drawCardsForPlayer(count) {
    for (let i = 0; i < count; i++) {
        if (gameState.deck.length === 0) {
            reshuffleDeck();
        }
        gameState.playerHand.push(gameState.deck.pop());
    }
}

function drawCardsForBot(count) {
    for (let i = 0; i < count; i++) {
        if (gameState.deck.length === 0) {
            reshuffleDeck();
        }
        gameState.botHand.push(gameState.deck.pop());
    }
}

function reshuffleDeck() {
    if (gameState.discardPile.length <= 1) {
        addLog('Deck habis dan tidak bisa di-reshuffle!', 'system');
        return;
    }
    
    const topCard = gameState.discardPile.pop();
    gameState.deck = [...gameState.discardPile];
    gameState.discardPile = [topCard];
    shuffleDeck();
    
    addLog('Deck di-reshuffle!', 'system');
}

function switchTurn() {
    gameState.currentTurn = gameState.currentTurn === 'player' ? 'bot' : 'player';
    updateGameStatus();
    renderGame();
    
    if (gameState.currentTurn === 'bot') {
        setTimeout(botTurn, 1500);
    }
}

function botTurn() {
    if (!gameState.gameActive || gameState.currentTurn !== 'bot') return;
  
    const playableCards = gameState.botHand
        .map((card, index) => ({ card, index }))
        .filter(({ card }) => canPlayCard(card));
    
    if (playableCards.length > 0) {
        const { card, index } = playableCards[Math.floor(Math.random() * playableCards.length)];
        
        gameState.botHand.splice(index, 1);
        gameState.discardPile.push(card);
        gameState.lastPlayedCard = card;
        
        addLog(`Bot memainkan ${card.color} ${card.value}`, 'bot');
        
        if (card.type === 'wild') {
            const colorCounts = { red: 0, blue: 0, green: 0, yellow: 0 };
            gameState.botHand.forEach(c => {
                if (c.color !== 'wild') {
                    colorCounts[c.color]++;
                }
            });
            
            const bestColor = Object.keys(colorCounts).reduce((a, b) => 
                colorCounts[a] > colorCounts[b] ? a : b
            );
            
            gameState.currentColor = bestColor;
            addLog(`Bot memilih warna: ${bestColor}`, 'bot');
            if (card.value === 'plus4') {
                addLog('Anda mengambil 4 kartu!', 'bot');
                drawCardsForPlayer(4);
            }
            
            renderGame();
            
            if (checkWin('bot')) return;
        
            setTimeout(botTurn, 1500);
        } else {
            gameState.currentColor = card.color;
            handleCardEffect(card, 'bot');
        }
    } else {
        if (gameState.deck.length === 0) {
            reshuffleDeck();
        }
        
        const drawnCard = gameState.deck.pop();
        gameState.botHand.push(drawnCard);
        
        addLog('Bot mengambil 1 kartu', 'bot');
        
        if (canPlayCard(drawnCard)) {
            addLog('Bot memainkan kartu yang diambil', 'bot');
            setTimeout(() => {
                const cardIndex = gameState.botHand.length - 1;
                const card = gameState.botHand[cardIndex];
                
                gameState.botHand.splice(cardIndex, 1);
                gameState.discardPile.push(card);
                gameState.lastPlayedCard = card;
                
                if (card.type === 'wild') {
                    const colorCounts = { red: 0, blue: 0, green: 0, yellow: 0 };
                    gameState.botHand.forEach(c => {
                        if (c.color !== 'wild') {
                            colorCounts[c.color]++;
                        }
                    });
                    
                    const bestColor = Object.keys(colorCounts).reduce((a, b) => 
                        colorCounts[a] > colorCounts[b] ? a : b
                    );
                    
                    gameState.currentColor = bestColor;
                    addLog(`Bot memilih warna: ${bestColor}`, 'bot');
                    
                    if (card.value === 'plus4') {
                        addLog('Anda mengambil 4 kartu!', 'bot');
                        drawCardsForPlayer(4);
                    }
                    
                    renderGame();
                    
                    if (checkWin('bot')) return;
                    
                    setTimeout(botTurn, 1500);
                } else {
                    gameState.currentColor = card.color;
                    handleCardEffect(card, 'bot');
                }
            }, 1000);
        } else {
            renderGame();
            switchTurn();
        }
    }
}
function checkUnoStatus() {
    if (gameState.playerHand.length > 1) {
        gameState.playerCalledUno = false;
        clearInterval(gameState.unoTimer);
        document.getElementById('unoBtn').classList.remove('active');
    }

    if (gameState.playerHand.length === 1 && !gameState.playerCalledUno) {
        startUnoTimer('player');
    }

    if (gameState.botHand.length === 1) {
        const botDelay = 2000 + Math.random() * 2000;
        setTimeout(() => {
            if (gameState.botHand.length === 1 && gameState.gameActive) {
                gameState.botCalledUno = true;
                document.getElementById('botUnoNotification').classList.add('show');
                addLog('Bot memanggil UNO!', 'bot');
                setTimeout(() => {
                    document.getElementById('botUnoNotification').classList.remove('show');
                }, 2000);
            }
        }, botDelay);
    }
}


function startUnoTimer(player) {
    if (player === 'player') {
        const unoBtn = document.getElementById('unoBtn');
        unoBtn.classList.add('active');
        
        gameState.unoTimerSeconds = 5;
        updateUnoTimerDisplay();
        
        clearInterval(gameState.unoTimer);
        gameState.unoTimer = setInterval(() => {
            gameState.unoTimerSeconds--;
            updateUnoTimerDisplay();
            
            if (gameState.unoTimerSeconds <= 0) {
                clearInterval(gameState.unoTimer);
                unoBtn.classList.remove('active');
                
                if (!gameState.playerCalledUno && gameState.playerHand.length === 1) {
                  
                    addLog('Anda lupa memanggil UNO! Penalti +2 kartu', 'system');
                    drawCardsForPlayer(2);
                    renderGame();
                }
            }
        }, 1000);
    }
}

function updateUnoTimerDisplay() {
    document.getElementById('unoTimer').textContent = gameState.unoTimerSeconds;
}

function callUno() {
    if (gameState.playerHand.length === 1 && !gameState.playerCalledUno) {
        gameState.playerCalledUno = true;
        clearInterval(gameState.unoTimer);
        document.getElementById('unoBtn').classList.remove('active');
        addLog('Anda memanggil UNO!', 'player');
    }
}

function checkWin(player) {
    const hand = player === 'player' ? gameState.playerHand : gameState.botHand;
    
    if (hand.length === 0) {
        gameState.gameActive = false;
        endRound(player);
        return true;
    }
    
    return false;
}

function endRound(winner) {
    clearInterval(gameState.unoTimer);
    
    if (winner === 'player') {
        gameState.balance += gameState.currentBet;
        showGameOver(true, 'ANDA MENANG!', `Selamat! Anda memenangkan $${gameState.currentBet}!`);
    } else {
        gameState.balance -= gameState.currentBet;
        
        if (gameState.balance <= 0) {
            gameState.balance = 0;
            showGameOver(false, 'GAME OVER', 'Saldo Anda habis! Permainan berakhir.');
        } else {
            showGameOver(false, 'ANDA KALAH!', `Anda kehilangan $${gameState.currentBet}`);
        }
    }
}

function showGameOver(isWin, title, message) {
    document.getElementById('gameOverTitle').textContent = title;
    document.getElementById('gameOverTitle').className = isWin ? 'win' : 'lose';
    document.getElementById('gameOverMessage').textContent = message;
    document.getElementById('finalBalance').textContent = `$${gameState.balance}`;
    
    document.getElementById('gameScreen').classList.remove('active');
    document.getElementById('gameOverScreen').classList.add('active');
}

function quitGame() {
    if (confirm('Yakin ingin keluar? Progress akan hilang.')) {
        gameState.gameActive = false;
        clearInterval(gameState.unoTimer);
        document.getElementById('gameScreen').classList.remove('active');
        document.getElementById('bettingScreen').classList.add('active');
    }
}

function resetGame() {
    gameState.balance = 5000;
    gameState.currentBet = 0;
    gameState.playerCalledUno = false;
    gameState.botCalledUno = false;
    clearInterval(gameState.unoTimer);
    
    updateBalanceDisplay();
    document.getElementById('betAmount').value = '';
    document.getElementById('gameOverScreen').classList.remove('active');
    document.getElementById('bettingScreen').classList.add('active');
  
    document.getElementById('actionLog').innerHTML = '';
}

function addLog(message, type) {
    const log = document.getElementById('actionLog');
    const entry = document.createElement('div');
    entry.className = `log-entry ${type}`;
    entry.textContent = message;
    log.appendChild(entry);
   
    log.scrollTop = log.scrollHeight;
    
    while (log.children.length > 50) {
        log.removeChild(log.firstChild);
    }
}