function isPrimeNumber(input) {
    function isPrime(num) {
        if (!Number.isInteger(num) || num <= 1) return false;
        for (let i = 2; i <= Math.sqrt(num); i += 1) {
            if (num % i === 0) return false;
        }
        return true;
    }

    if (typeof input !== 'number' && !Array.isArray(input)) {
        console.log('Параметр должен быть числом или массивом чисел');
        return;
    }

    if (typeof input === 'number') {
        if (!Number.isInteger(input)) {
            console.log('Число должно быть целым');
            return;
        }
        console.log(`${input} ${isPrime(input) ? 'простое число' : 'не простое число'}`);
    } else {
        const primes = [];
        const nonPrimes = [];
        for (const num of input) {
            if (typeof num !== 'number' || !Number.isInteger(num)) {
                console.log('Массив должен содержать только целые числа');
                return;
            }
            isPrime(num) ? primes.push(num) : nonPrimes.push(num);
        }
        const ans = [];
        ans.push(`Ввод: ${input}`);
        if (primes.length > 0) {
            ans.push(`Простые числа: ${primes.join(', ')}`);
        }
        if (nonPrimes.length > 0) {
            ans.push(`Не простые числа: ${nonPrimes.join(', ')}`);
        }
        console.log(ans.join('\n'));
    }
}

function countVowels(str) {
    const vowels = new Set(['а', 'е', 'ё', 'и', 'о', 'у', 'ы', 'э', 'ю', 'я']);
    const ans = [];
    for (let char of str) {
        char = char.toLowerCase();
        if (vowels.has(char)) {
            ans.push(char);
        }
    }
    console.log(`Ввод: ${str}`);
    console.log(`Количество гласных: ${ans.length}. (${ans.join(', ')})`);
}

function uniqueElements(arr) {
    const ans = arr.reduce((acc, element) => {
        const key = String(element);
        acc[key] = (acc[key] || 0) + 1;
        return acc;
    }, {});
    console.log(`Ввод: ${arr}`);
    console.log(ans);
}

function mergeObjects(obj1, obj2) {
    console.log(`Ввод:`);
    console.log(obj1);
    console.log(obj2);
    console.log(`Результат:`);
    const ans = { ...obj1, ...obj2 };
    console.log(ans);
}

function getNames(arr) {
    const ans = arr.map(user => user.name);
    console.log(`Ввод:`);
    console.log(arr);
    console.log(`Результат:`);
    console.log(ans);
}

function mapObject(obj, callback) {
    console.log(`Ввод:`);
    console.log(obj, callback);
    console.log(`Результат:`);
    let ans = {};
    for (let key in obj) {
        let newValue = callback(obj[key]);
        ans[key] = newValue;
    }
    console.log(ans);
    return ans;
}

function generatePassword(length) {
    const lowercase = 'abcdefghijklmnopqrstuvwxyz';
    const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const numbers = '0123456789';
    const symbols = '!@#$%^&*';

    const all = [lowercase, uppercase, numbers, symbols];
    let password = all.map(chars => chars[Math.floor(Math.random() * chars.length)]).join('');

    for (let i = password.length; i < length; i++) {
        const charset = all[Math.floor(Math.random() * all.length)];
        password += charset[Math.floor(Math.random() * charset.length)];
    }

    return password;
}

function mapFilter(arr) {
    console.log(`Ввод:`);
    console.log(arr);
    const ans = arr.map(x => x * 3).filter(x => x > 10);
    console.log(`Результат:`);
    console.log(ans);
    return ans;
}

console.log('\n');