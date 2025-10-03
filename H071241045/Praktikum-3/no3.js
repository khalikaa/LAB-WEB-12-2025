const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});     
const daysOfWeek = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
function calculateFutureDay(currentDay, daysToAdd) {
    const currentIndex = daysOfWeek.indexOf(currentDay.toLowerCase());  
    if (currentIndex === -1) {
        return null;    
    }   
    const futureIndex = (currentIndex + daysToAdd) % 7;
    return daysOfWeek[futureIndex];
}   
rl.question('Masukkan hari: ', (dayInput) => {
    rl.question('Masukkan hari yang akan datang: ', (daysInput) => {
        const daysToAdd = parseInt(daysInput);  
        if (isNaN(daysToAdd) || daysToAdd < 0) {
            console.log('Jumlah hari tidak valid. Harap masukkan angka positif.');
            rl.close();
            return;
        }   
        const futureDay = calculateFutureDay(dayInput, daysToAdd);
        if (futureDay) {        
            console.log(`${daysToAdd} hari setelah ${dayInput} adalah ${futureDay.charAt(0).toUpperCase() + futureDay.slice(1)}`);
        }   
        else {
            console.log('Hari tidak valid. Harap masukkan nama hari yang benar (mis. Senin, Selasa, dll).');
        }       
        rl.close();
    });
}       
);
    

