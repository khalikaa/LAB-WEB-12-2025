function findEvenNumbers(start, end) {
  let NumbersFound = [];

  for (let currentNumber = start; currentNumber <= end; currentNumber++) {
    if (currentNumber % 2 === 0) {
      NumbersFound.push(currentNumber);
    }
  }

  return {
    count: NumbersFound.length,
    numbers: NumbersFound,
  };
}

const result = findEvenNumbers(1, 10);
console.log(`${result.count} [${result.numbers.join(", ")}]`);
