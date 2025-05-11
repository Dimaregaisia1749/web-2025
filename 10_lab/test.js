isPrimeNumber([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
isPrimeNumber(2);
isPrimeNumber(4);
isPrimeNumber('2');
isPrimeNumber(['2']);
console.log('\n');

countVowels('Привет, мир!');
countVowels('Аабве');
countVowels('');
console.log('\n');

uniqueElements(['привет', 'hello', 1, '1']);
uniqueElements([]);
uniqueElements(['1']);
console.log('\n');

mergeObjects({ a: 1, b: 2 }, { b: 3, c: 4 });
mergeObjects({ a: 1, b: 3 }, { с: 2, d: 4 });
console.log('\n');

const users = [
    { id: 1, name: "Alice" },
    { id: 2, name: "Bob" },
    { id: 3, name: "Charlie" }
];
getNames(users);
console.log('\n');

const nums = { a: 1, b: 2, c: 3 };
mapObject(nums, x => x * 2)
const nums2 = { a: 1, b: 2, c: 3 };
mapObject(nums2, x => x > 2)
console.log('\n');

console.log('Пароль:');
console.log(generatePassword(10))
console.log(generatePassword(4))
console.log(generatePassword(1500))


console.log('\n');

const numbers = [2, 5, 8, 10, 3];
mapFilter(numbers)
console.log('\n');