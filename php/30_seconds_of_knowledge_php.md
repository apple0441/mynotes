# Relevant PHP snippets from 30 seconds of knowledge

### Partial fragment display

> Only some code snippets are listed here, please refer to: https://github.com/30-seconds/30_seconds_of_knowledge/blob/master/src/assets/snippets/php/ for complete details.


<details>
   <summary>`average` - find the average</summary>

```php
function average(...$items) {
     $count = count($items);
     return $count === 0 ? 0 : array_sum($items) / $count;
}
average(1, 2, 3); // 2
```
</details>

<details>
   <summary>`deepFlatten` - flatten a mixed-dimensional array into a one-dimensional array</summary>

```php
function deepFlatten($items) {
     $result = [];
     foreach ($items as $item) {
         if (!is_array($item)) {
             $result[] = $item;
         } else {
             $result = array_merge($result, deepFlatten($item));
         }
     }
     return $result;
}
deepFlatten([1, [2], [[3], 4], 5]); // [1, 2, 3, 4, 5]
```
</details>

<details>
   <summary>`endsWith` - whether to end with a specific word</summary>

```php
function endsWith($haystack, $needle) {
     return strrpos($haystack, $needle) === (strlen($haystack) - strlen($needle));
}
endsWith('Hi, this is me', 'me'); // true
```
</details>

<details>
   <summary>`factorial` - factorial calculation</summary>

```php
function factorial($n) {
     if ($n <= 1) {
         return 1;
     }
     return $n * factorial($n - 1);
}
factorial(6); // 720
```
</details>

<details>
   <summary>`fibonacci` - Fibonacci sequence</summary>

```php
function fibonacci($n) {
     $sequence = [0, 1];
     for ($i = 2; $i < $n; $i++) {
         $sequence[$i] = $sequence[$i-1] + $sequence[$i-2];
     }
     return $sequence;
}
fibonacci(6); // [0, 1, 1, 2, 3, 5]
```
</details>

<details>
   <summary>`gcd` - the greatest common divisor calculation</summary>

```php
function gcd(...$numbers) {
     if (count($numbers) > 2) {
         return array_reduce($numbers, 'gcd');
     }
     $r = $numbers[0] % $numbers[1];
     return $r === 0 ? abs($numbers[1]) : gcd($numbers[1], $r);
}
gcd(8, 36); // 4
gcd(12, 8, 32); // 4
```
</details>

<details>
   <summary>`head` - get the first element</summary>

```php
function head($items) {
     return reset($items);
}
head([1, 2, 3]); // 1
```
</details>

<details>
   <summary>`isPrime` - prime number judgment</summary>

```php
function isPrime($number) {
     $boundary = floor(sqrt($number));
     for ($i = 2; $i <= $boundary; $i++) {
         if ($number % $i === 0) {
             return false;
         }
     }
     return $number >= 2;
}
isPrime(3); // true
```
</details>

<details>
   <summary>`last` - get last element</summary>

```php
function last($items) {
     return end($items);
}
last([1, 2, 3]); // 3
```
</details>

<details>
   <summary>`lcm` - least common multiple calculation</summary>

```php
function lcm(...$numbers) {
     $ans = $numbers[0];
     for ($i = 1, $max = count($numbers); $i < $max; $i++) {
         $ans = (($numbers[$i] * $ans) / gcd($numbers[$i], $ans));
     }
     return $ans;
}
lcm(12, 7); // 84
lcm(1, 3, 4, 5); // 60
```
</details>

<details>
   <summary>`palindrome` - palindrome judgment</summary>

```php
function palindrome($string) {
     return strrev($string) === (string) $string;
}
palindrome('racecar'); // true
palindrome(2221222); // true
```
</details>

<details>
   <summary>`startsWith` - whether to start with a specific word</summary>

```php
function startsWith($haystack, $needle) {
     return strpos($haystack, $needle) === 0;
}
startsWith('Hi, this is me', 'Hi'); // true
```
</details>