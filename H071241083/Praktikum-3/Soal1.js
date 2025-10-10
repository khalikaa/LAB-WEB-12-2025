function countEvenNumbers(start, end) {

  if (typeof start !== 'number' || typeof end !== 'number') {
    return "Error: Input harus berupa angka."
  }
  if (start > end) {
    return "Error: Angka 'start' harus lebih kecil atau sama dengan 'end'.";
  }

  let numbers = []
  let count = 0;
  for (let i = start; i <= end; i++) {

    if (i % 2 === 0) {
      count++;
      numbers.push(i)
    }
  }
  return count + " [" + numbers + "]";
}


console.log(`Output: ${countEvenNumbers(1, 10)}`);