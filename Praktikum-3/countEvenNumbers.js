function countEvenNumbers(start, end) {
  let evens = [];
  for (let i = start; i <= end; i++) {
    if (i % 2 === 0) evens.push(i);
  }
  return `${evens.length} [${evens.join(", ")}]`;
}


console.log("output : " +(countEvenNumbers(1, 10)));
 