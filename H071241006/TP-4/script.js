// === Elemen DOM ===
const saldoEl = document.getElementById("saldo");
const taruhanEl = document.getElementById("taruhan");
const mulaiBtn = document.getElementById("mulai-btn");
const drawBtnSide = document.getElementById("draw-btn-side");
const drawBtnMiddle = document.getElementById("draw-btn-middle");
const unoBtn = document.getElementById("uno-btn");
const statusEl = document.getElementById("status");
const playerCardsEl = document.getElementById("player-cards");
const botCardsEl = document.getElementById("bot-cards");
const topCardEl = document.getElementById("top-card");
const callUnoBtn = document.getElementById("call-uno-btn");
const gameTitle = document.getElementById("game-title"); 

// === Modal Element ===
const modalOverlay = document.getElementById("modal-overlay");
const modalBox = document.getElementById("modal-box");


// helper modal color picker
function showColorPicker(promptText = "Pilih warna:") {
    return new Promise(resolve => {
        // Tambahkan kelas warna untuk styling neon
        const colors = ["red", "blue", "green", "yellow"];
        // dictionary color
        const colorHex = { "red": "#ff073a", "blue": "#00c7ff", "green": "#00ff66", "yellow": "#ffeb00" };
        
        modalBox.innerHTML = `<p>${promptText}</p>`;
        const btnWrap = document.createElement("div");

        colors.forEach(c => {
            const b = document.createElement("button");
            b.textContent = c.toUpperCase();
            b.style.borderColor = colorHex[c];
            b.style.color = colorHex[c];
            b.style.boxShadow = `0 0 8px ${colorHex[c]}`;
            
            b.addEventListener("click", () => {
                modalOverlay.style.display = "none";
                
                resolve(c);
            });
            btnWrap.appendChild(b);
        });
        modalBox.appendChild(btnWrap);
        modalOverlay.style.display = "flex";
    });
}

// helper confirm modal
function showConfirm(promptText = "Yakin?") {
    return new Promise(resolve => {
        modalBox.innerHTML = `<p>${promptText}</p>`;
        const wrapper = document.createElement("div");

        const yes = document.createElement("button");
        yes.textContent = "KONFIRMASI";
        yes.style.borderColor = "#00ff66";
        yes.style.color = "#00ff66";
        yes.style.boxShadow = `0 0 8px #00ff66`;
        yes.addEventListener("click", () => {
            modalOverlay.style.display = "none";
            resolve(true);
        });

        const no = document.createElement("button");
        no.textContent = "BATALKAN";
        no.style.borderColor = "#ff073a";
        no.style.color = "#ff073a";
        no.style.boxShadow = `0 0 8px #ff073a`;
        no.addEventListener("click", () => {
            modalOverlay.style.display = "none";
            resolve(false);
        });

        wrapper.appendChild(yes);
        wrapper.appendChild(no);
        modalBox.appendChild(wrapper);
        modalOverlay.style.display = "flex";
    });
}

// === Variabel global permainan ===
let saldo = 5000;
let deck = [];
let discardPile = [];
let playerCards = [];
let botCards = [];
let topCard = null;
let currentColor = null;
let unoTimer = null;
let giliran = "player"; // "player", "bot", "none"

// === Variabel UNO-calling control ===
let unoWindowActive = false;    //masa kritis
let unoTarget = null;           //Siapa yg kartunya sisa 1
let unoCalledBy = null;         //Siapa yang memanggil
let botWillAutoCallTimeout = null; //aksi bot dlm 2 detik

// === Utility & UI helpers ===
function randomColor() { //menentukan kartu pertama
    const arr = ["blue", "red", "green", "yellow"];
    return arr[Math.floor(Math.random() * arr.length)];
}
function shuffleArray(a) { //mengacak kartu saat permainan dimulai
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
}
function setStatus(text, color=null) {  //mengatur warna teks
    statusEl.textContent = text; 
    statusEl.className = ""; // Reset class
    if (color === "red") statusEl.classList.add("neon-red");
    else if (color === "blue") statusEl.classList.add("neon-blue");
    else if (color === "green") statusEl.classList.add("neon-green");
    else if (color === "yellow") statusEl.classList.add("neon-yellow");
    else statusEl.classList.add("neon-green"); // Default status color
}

function animateTopCard(){ //efek visual ketika kartu diletakkan
    // Tambahkan efek glitch singkat pada kartu teratas
    topCardEl.style.transform = "scale(1.06) skewX(2deg)";
    topCardEl.style.transition = "transform 100ms";
    setTimeout(()=> topCardEl.style.transform = "scale(1) skewX(-2deg)", 100);
    setTimeout(()=> topCardEl.style.transform = "scale(1) skewX(0)", 200);
}

// === Deck & discard handling (No change) ===
function buatDeck() { //membuat kartu
    const warna = ["blue", "red", "green", "yellow"];
    const d = [];
    warna.forEach(w => {
        for (let i = 0; i <= 9; i++) d.push(`${w}_${i}`);
        d.push(`${w}_plus2`, `${w}_reverse`, `${w}_skip`);
    });
    d.push("wild", "plus_4");
    shuffleArray(d);
    return d;
}
function refillDeckFromDiscard() { //jika deck kartu habis ambil di discard pile
    if (discardPile.length === 0) return;
    const newDeck = discardPile.splice(0, discardPile.length);
    shuffleArray(newDeck);
    deck = deck.concat(newDeck);
    setStatus("Deck habis — MEMUAT ULANG DATA DISCARD.", "red");
}

// === Render kartu ===
function renderKartu(area, cards, klikable=false) { //Tampilan kartu di layar
    area.innerHTML = "";
    cards.forEach((card, index) => {
        const img = document.createElement("img");
        img.src = `asset/${card}.png`;
        img.alt = card;
        img.classList.add("neon-card"); // Tambahkan class untuk styling

        if (klikable && giliran === "player") {
            img.style.cursor = "pointer";
            img.addEventListener("click", ()=> mainkanKartu(index));
        } else {
            img.style.cursor = "default";
        }
        
        area.appendChild(img);
    });
}

// === Top card management (No change) ===
function setTopCard(kartu, chosenColor = null) { //mengelola kartu di belakang layar dan memperbarui tampilan
    if (topCard) discardPile.push(topCard);
    topCard = kartu;
    if (kartu === "wild" || kartu === "plus_4") currentColor = chosenColor || currentColor || randomColor();
    else currentColor = kartu.split("_")[0];
    topCardEl.src = `asset/${kartu}.png`;
    
    // Update border color of top card for visual feedback
    const colorMap = { "red": "#ff073a", "blue": "#00c7ff", "green": "#00ff66", "yellow": "#ffeb00" };
    topCardEl.style.borderColor = colorMap[currentColor] || "#fff";
    topCardEl.style.boxShadow = `0 0 10px ${colorMap[currentColor] || "#fff"}`;

    animateTopCard();
}

// === Cek playable (No change) ===
function kartuBisaDimainkan(kartu) {
    if (!kartu) return false;
    if (kartu === "wild" || kartu === "plus_4") return true;
    const parts = kartu.split("_");
    const warna = parts[0];
    const jenis = parts[1];
    const topParts = topCard.split("_");
    const topJenis = topParts[1];
    if (warna === currentColor) return true;
    if (jenis === topJenis) return true;
    return false;
}

// === Memulai ronde (No change) ===
function mulaiRonde() {
    let taruhan = parseInt(taruhanEl.value);
    if (isNaN(taruhan) || taruhan < 100 || taruhan > saldo) {
        alert("TARUHAN DITOLAK! (Min $100, Max saldo Anda)");
        return;
    }

    deck = buatDeck();
    discardPile = [];
    playerCards = deck.splice(0,7);
    botCards = deck.splice(0,7);
    let initial = deck.pop();
    setTopCard(initial, (initial === "wild" || initial === "plus_4") ? randomColor() : null);

    renderKartu(playerCardsEl, playerCards, true);
    renderKartu(botCardsEl, botCards.map(()=> "card_back"));

    giliran = "player";
    unoBtn.disabled = true;
    callUnoBtn.disabled = true;
    setStatus("AKSES DIBERIKAN: GILIRAN ANDA! Warna aktif: " + currentColor.toUpperCase(), currentColor);
}

// === UNO window management (No change in logic) ===
function startUnoWindow(target) { //untuk tombol call uno                                                                                                                                                                                                          ccccccccccc 
    clearUnoWindow();
    unoWindowActive = true;
    unoTarget = target;
    unoCalledBy = null;
    callUnoBtn.disabled = false;

    unoTimer = setTimeout(()=> {
        if (!unoWindowActive) return;
        applyUnoPenalty(unoTarget, "auto");
        clearUnoWindow();
    }, 5000);

    if (target === "player") {
        botWillAutoCallTimeout = setTimeout(()=> {
            if (!unoWindowActive) return;
            applyUnoPenalty("player", "bot");
            clearUnoWindow();
        }, 2000); 
    }

    setStatus(`WARNING: ${target === "player" ? "ANDA" : "BOT"} 1 KARTU! Tekan UNO dalam 5 detik — LAWAN BISA CALL.`, "red");
}

function clearUnoWindow() { //mencegah penalti ganda atau mematikan semua alarm yang tertunda
    unoWindowActive = false;
    unoTarget = null;
    unoCalledBy = null;
    callUnoBtn.disabled = true;
    if (unoTimer) { clearTimeout(unoTimer); unoTimer = null; }
    if (botWillAutoCallTimeout) { clearTimeout(botWillAutoCallTimeout); botWillAutoCallTimeout = null; }
}

function applyUnoPenalty(target, calledBy) { //auto penalti ketika tak ada yang call uno
    if (target === "player") {
        if (deck.length < 2) refillDeckFromDiscard();
        for (let i=0;i<2;i++){ if (deck.length>0) playerCards.push(deck.pop()); }
        renderKartu(playerCardsEl, playerCards, true);
        setStatus(`PENALTI AKTIF: ${calledBy === "bot" ? "BOT" : "ANDA"} CALL UNO. PLAYER LUPA UNO -> +2 KARTU.`, "red");
    } else if (target === "bot") {
        if (deck.length < 2) refillDeckFromDiscard();
        for (let i=0;i<2;i++){ if (deck.length>0) botCards.push(deck.pop()); }
        renderKartu(botCardsEl, botCards.map(()=> "card_back"));
        setStatus(`PENALTI AKTIF: ${calledBy === "player" ? "ANDA" : "AUTO"} CALL UNO. BOT LUPA UNO -> +2 KARTU.`, "blue");
    }
    if (target === "player") unoBtn.disabled = true;
}

// === Pemain memainkan kartu (No change) ===
async function mainkanKartu(index) {  // fungsi ketika bermain
    if (giliran !== "player") return;
    const kartu = playerCards[index];
    if (!kartuBisaDimainkan(kartu)) {
        setStatus("INVALID MOVE: Kartu tidak bisa dimainkan!", "red");
        return;
    }

    if (kartu === "wild" || kartu === "plus_4") {
        const confirm = await showConfirm("AKSI WILD: Mainkan " + kartu + "?");
        if (!confirm) return;
        const warnaDipilih = await showColorPicker("Pilih warna untuk " + kartu);
        playerCards.splice(index,1);
        setTopCard(kartu, warnaDipilih);
        renderKartu(playerCardsEl, playerCards, true);
    } else {
        playerCards.splice(index,1);
        setTopCard(kartu, null);
        renderKartu(playerCardsEl, playerCards, true);
    }

    if (unoWindowActive) clearUnoWindow();

    if (playerCards.length === 1) {
        unoBtn.disabled = false;
        startUnoWindow("player");
    }

    if (playerCards.length === 0) {
        let taruhan = parseInt(taruhanEl.value);
        if (isNaN(taruhan) || taruhan < 100) taruhan = 100;
        
        saldo += taruhan * 2 ;
        saldoEl.textContent = `💰 Saldo: $${saldo}`;
        setStatus("ACCESS GRANTED! KEMENANGAN PLAYER DITERIMA!", "yellow");
        giliran = "none";
        return;
    }

    processCardEffect(topCard, "player");
}

// === Tombol UNO & Call UNO (No change) ===
unoBtn.addEventListener("click", () => {
    if (unoWindowActive && unoTarget === "player") {
        clearTimeout(unoTimer);
        clearUnoWindow();
        unoBtn.disabled = true;
        setStatus("UNO DITEKAN. SISTEM TERKUNCI.", "blue");
    } else {
        unoBtn.disabled = true;
        setStatus("UNO DITEKAN. PENGAWASAN AKTIF.", "green");
    }
});

callUnoBtn.addEventListener("click", () => {
    if (!unoWindowActive || !unoTarget) {
        setStatus("TARGET TIDAK TERDETEKSI. Tidak ada pemain dalam kondisi UNO.", "green");
        return;
    }
    if (unoTarget === "player") {
        setStatus("SELF-CALL BLOCKED. Tidak bisa memanggil UNO pada diri sendiri.", "red");
        return;
    }
    applyUnoPenalty("bot", "player");
    clearUnoWindow();
});

// === Tombol Ambil Kartu (No change) ===
drawBtnMiddle.addEventListener("click", () => {
    if (giliran !== "player") return;
    if (deck.length === 0) refillDeckFromDiscard();
    if (deck.length === 0) {
        setStatus("DECK OFFLINE. Tidak ada data kartu.", "red");
        return;
    }
    const ambil = deck.pop();
    playerCards.push(ambil);
    renderKartu(playerCardsEl, playerCards, true);

    if (kartuBisaDimainkan(ambil)) {
        setStatus("DATA TERIMA: Kartu dapat dimainkan! (LANJUTKAN)", "yellow");
    } else {
        setStatus("DATA TOLAK. Giliran berpindah ke BOT...", "red");
        giliran = "bot";
        setTimeout(giliranBot, 900);
    }
});
drawBtnSide.addEventListener("click", drawBtnMiddle.click);

// === Proses efek kartu (No change) ===
function processCardEffect(kartu, playedBy) {
    const isPlayer = playedBy === "player";
    const parts = kartu.split("_");
    const jenis = parts[1] || kartu;

    if (jenis === "skip" || jenis === "reverse") {
        if (isPlayer) {
            setStatus("AKSI: SKIP/REVERSE. BOT DILEWATI. GILIRAN ANDA LAGI.", "yellow");
            giliran = "player";
            renderKartu(playerCardsEl, playerCards, true);
        } else {
            setStatus("AKSI: SKIP/REVERSE. ANDA DILEWATI. BOT LANJUT.", "red");
            giliran = "bot";
            renderKartu(botCardsEl, botCards.map(()=> "card_back"));
            setTimeout(giliranBot, 900);
        }
        return;
    }

    if (jenis === "plus2") {
        if (isPlayer) {
            if (deck.length < 2) refillDeckFromDiscard();
            for (let i=0;i<2;i++){ if (deck.length>0) botCards.push(deck.pop()); }
            renderKartu(botCardsEl, botCards.map(()=> "card_back"));
            setStatus("AKSI: +2. BOT MENGAMBIL 2 KARTU. GILIRAN ANDA LAGI.", "yellow");
            giliran = "player";
            return;
        } else {
            if (deck.length < 2) refillDeckFromDiscard();
            for (let i=0;i<2;i++){ if (deck.length>0) playerCards.push(deck.pop()); }
            renderKartu(playerCardsEl, playerCards, true);
            setStatus("AKSI: +2. ANDA MENGAMBIL 2 KARTU. BOT LANJUT.", "red");
            giliran = "bot";
            setTimeout(giliranBot, 900);
            return;
        }
    }

    if (kartu === "wild") {
        if (isPlayer) {
            setStatus(`AKSI: WILD. WARNA DIPILIH: ${currentColor.toUpperCase()}. GILIRAN BOT.`, currentColor);
            giliran = "bot";
            setTimeout(giliranBot, 900);
        } else {
            setStatus(`AKSI: WILD. BOT MEMILIH WARNA: ${currentColor.toUpperCase()}. GILIRAN ANDA.`, currentColor);
            giliran = "player";
            renderKartu(playerCardsEl, playerCards, true);
            if (botCards.length === 1) startUnoWindow("bot");
        }
        return;
    }

    if (kartu === "plus_4") {
        if (isPlayer) {
            if (deck.length < 4) refillDeckFromDiscard();
            for (let i=0;i<4;i++){ if (deck.length>0) botCards.push(deck.pop()); }
            renderKartu(botCardsEl, botCards.map(()=> "card_back"));
            setStatus(`AKSI: +4. BOT MENGAMBIL 4 KARTU. WARNA: ${currentColor.toUpperCase()}. GILIRAN ANDA LAGI.`, currentColor);
            giliran = "player";
            return;
        } else {
            if (deck.length < 4) refillDeckFromDiscard();
            for (let i=0;i<4;i++){ if (deck.length>0) playerCards.push(deck.pop()); }
            renderKartu(playerCardsEl, playerCards, true);
            setStatus(`AKSI: +4. ANDA MENGAMBIL 4 KARTU. WARNA: ${currentColor.toUpperCase()}. BOT LANJUT.`, currentColor);
            giliran = "bot";
            setTimeout(giliranBot, 900);
            return;
        }
    }

    // Angka biasa => giliran berganti
    if (isPlayer) {
        giliran = "bot";
        setStatus("GILIRAN BERPINDAH KE BOT...", "green");
        setTimeout(giliranBot, 900);
    } else {
        giliran = "player";
        setStatus("GILIRAN ANDA! WARNA AKTIF: " + currentColor.toUpperCase(), currentColor);
        renderKartu(playerCardsEl, playerCards, true);
    }
}

// === Giliran Bot (No change in logic) ===
function giliranBot() {
    if (giliran !== "bot") return;
    if (deck.length === 0) refillDeckFromDiscard();

    let pilihanIndex = -1;
    for (let i=0;i<botCards.length;i++){
        const c = botCards[i];
        if (c === "wild" || c === "plus_4") continue;
        const parts = c.split("_");
        const warna = parts[0];
        if (warna === currentColor) { pilihanIndex = i; break; }
    }
    if (pilihanIndex === -1) {
        const topJenis = topCard.split("_")[1];
        for (let i=0;i<botCards.length;i++){
            const c = botCards[i];
            if (c === "wild" || c === "plus_4") continue;
            const jenis = c.split("_")[1];
            if (jenis === topJenis) { pilihanIndex = i; break; }
        }
    }
    if (pilihanIndex === -1) {
        const iw = botCards.indexOf("wild");
        const ip = botCards.indexOf("plus_4");
        if (iw !== -1) pilihanIndex = iw;
        else if (ip !== -1) pilihanIndex = ip;
    }

    if (pilihanIndex !== -1) {
        const kartu = botCards.splice(pilihanIndex,1)[0];
        let chosenColor = null;
        if (kartu === "wild" || kartu === "plus_4") chosenColor = randomColor();
        setTopCard(kartu, chosenColor);
        renderKartu(botCardsEl, botCards.map(()=> "card_back"));

        if (kartu === "wild" || kartu === "plus_4") setStatus(`BOT MEMUTUSKAN: ${kartu.toUpperCase()}. WARNA: ${currentColor.toUpperCase()}`, currentColor);
        else setStatus(`BOT MEMUTUSKAN: ${kartu.toUpperCase()}.`, currentColor);

        if (botCards.length === 1) {
            startUnoWindow("bot");
        }

        if (botCards.length === 0) {
            let taruhan = parseInt(taruhanEl.value);
            if (isNaN(taruhan) || taruhan < 100) taruhan = 100;

            saldo -= taruhan;
            saldoEl.textContent = `💰 Saldo: $${saldo}`;
            setStatus("GAMEOVER. BOT KEMENANGAN DITERIMA.", "red");
            giliran = "none";
            if (saldo <= 0) { alert("SYSTEM DOWN! SALDO HABIS! RESET SALDO..."); saldo = 5000; saldoEl.textContent = `💰 Saldo: $${saldo}`; }
            return;
        }

        setTimeout(()=> processCardEffect(kartu, "bot"), 700);
        return;
    } else {
        if (deck.length === 0) refillDeckFromDiscard();
        if (deck.length === 0) {
            setStatus("DECK OFFLINE. BOT SKIP. GILIRAN ANDA!", "green");
            giliran = "player";
            renderKartu(playerCardsEl, playerCards, true);
            return;
        }
        const ambil = deck.pop();
        botCards.push(ambil);
        renderKartu(botCardsEl, botCards.map(()=> "card_back"));
        setStatus("BOT MENGAMBIL KARTU BARU.", "green");

        if (kartuBisaDimainkan(ambil)) {
            botCards.pop();
            const chosenColor = (ambil === "wild" || ambil === "plus_4") ? randomColor() : null;
            setTopCard(ambil, chosenColor);
            renderKartu(botCardsEl, botCards.map(()=> "card_back"));
            if (ambil === "wild" || ambil === "plus_4") setStatus(`BOT MENGAMBIL & MAIN: ${ambil}. WARNA: ${currentColor.toUpperCase()}`, currentColor);
            else setStatus("BOT MENGAMBIL & MAIN: KARTU MATCH.", currentColor);

            if (botCards.length === 1) startUnoWindow("bot");
            if (botCards.length === 0) {
                let taruhan = parseInt(taruhanEl.value);
                if (isNaN(taruhan) || taruhan < 100) taruhan = 100;
                saldo -= taruhan;
                saldoEl.textContent = `💰 Saldo: $${saldo}`;
                setStatus("GAMEOVER. BOT KEMENANGAN DITERIMA.", "red");
                giliran = "none";
                return;
            }
            setTimeout(()=> processCardEffect(ambil, "bot"), 700);
            return;
        }

        giliran = "player";
        setStatus("GILIRAN ANDA! WARNA AKTIF: " + currentColor.toUpperCase(), currentColor);
        renderKartu(playerCardsEl, playerCards, true);
    }
}

// === Tombol mulai ronde ===
mulaiBtn.addEventListener("click", mulaiRonde);

// === Inisialisasi Typing Effect (Updated Text) ===
const titleContent = "⚡️ UNO GLITCH SYSTEM";
const saldoContent = "💰 Saldo: $5000";

let i = 0;
let j = 0;

function typeTitle() {
    if (i < titleContent.length) {
        gameTitle.textContent += titleContent.charAt(i);
        i++;
        setTimeout(typeTitle, 50); // Kecepatan ketik lebih cepat
    } else {
        setTimeout(typeSaldo, 300);
    }
}

function typeSaldo() {
    if (j < saldoContent.length) {
        saldoEl.textContent += saldoContent.charAt(j);
        j++;
        setTimeout(typeSaldo, 40);
    }
}

window.addEventListener("load", () => {
    typeTitle();
});

// inisialisasi UI
setStatus("LOADING... TEKAN 'MULAI RONDE' UNTUK AKSES.", "green");
callUnoBtn.disabled = true;