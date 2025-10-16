function countEvenNumbers(start, end){
    if (typeof start !== 'number' || typeof end !== 'number' ){
        return "Eror: krn program hanya menerima inputan angka"
    }
    if (start > end){
        return "Eror : angka mulai lbh gede dari angka akhhir"
    }
    let count = []
    for (let i = start; i <= end; i++){
        if(i % 2 == 0){
            count.push(i)
        }
    }
    return `${count.length} [${count.join(", ") }]` // backtik
}
console.log( "Output: " + countEvenNumbers(1, 10))