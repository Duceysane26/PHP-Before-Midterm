<?php
$a = 15;
$b = 42;
$c = 8;

//the greatest
if ($a >= $b && $a >= $c) {
    $greatest = $a;
} elseif ($b >= $a && $b >= $c) {
    $greatest = $b;
} else {
    $greatest = $c;
}

//the smallest
if ($a <= $b && $a <= $c) {
    $smallest = $a;
} elseif ($b <= $a && $b <= $c) {
    $smallest = $b;
} else {
    $smallest = $c;
}

echo "<h3>Solution 1</h3>";
echo "Greatest: $greatest <br>";
echo "Smallest: $smallest <br>";
?>


<?php
//divisible 
echo "<br>";
echo "<h3>Solution 2</h3>";
$num = 76;

if ($num % 3 == 0 && $num % 5 == 0) {
    echo "$num is divisible by both 3 and 5";
} elseif ($num % 3 == 0) {
    echo "$num is divisible by 3";
} elseif ($num % 5 == 0) {
    echo "$num is divisible by 5";
} else {
    echo "$num is divisible by none of them <br>";
}
?>

<?php
//odd numbers 
echo "<br>";
echo "<h3>Solution 3</h3>";
echo "<strong>The odd numbers from 2 to 20 are:</strong><br>";
for ($i = 2; $i <= 20; $i++) {
    if ($i % 2 != 0) {
        echo $i . " ";
    }
}
//even numbers
echo "<br><br><strong>The even numbers from 35 down to 7 are:</strong><br>";
for ($i = 35; $i >= 7; $i--) {
    if ($i % 2 == 0) {
        echo $i . " ";
    }
}
echo "<br>";
?>


<?php
echo "<br>";
echo "<h3>Solution 4</h3>";
echo "<strong>The numbers divisible by 2 and 5 from 50 down to 2 are:</strong><br>";
for ($i = 50; $i >= 2; $i--) {
    if ($i % 2 == 0 && $i % 5 == 0) {
        echo $i . " ";
    }
}
echo "<br>";
?>

<?php
echo "<br>";
echo "<h3>Solution 5</h3>";
$num = 2345;
$original = $num;
$reversed = 0;

while ($num > 0) {
    $remainder = $num % 10;
    $reversed = ($reversed * 10) + $remainder;
    $num = (int) ($num / 10);
}

echo "Original Number: $original <br>";
echo "Reversed Number: $reversed";
echo "<br>";
?>

<?php
echo "<br>";
echo "<h3>Solution 6</h3>";
$a = 6;
$b = 10;


$lcm = ($a > $b) ? $a : $b;

while (true) {
    if ($lcm % $a == 0 && $lcm % $b == 0) {
        break;
    }
    $lcm++;
}

echo "Lowest Common Multiplier of $a and $b is: $lcm";

echo "<br>";
?>

<?php
echo "<br>";
echo "<h3>Solution 7</h3>";
$a = 23;
$b = 24;

$hcf = 1;
$limit = ($a < $b) ? $a : $b;

for ($i = 1; $i <= $limit; $i++) {
    if ($a % $i == 0 && $b % $i == 0) {
        $hcf = $i;
    }
}

echo "Highest Common Factor of $a and $b is: $hcf";
echo "<br>";
?>

<?php
echo "<br>";
echo "<h3>Solution 8</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";

echo "<tr>";
echo "<th colspan='12'>Multiplication Table</th>";
echo "</tr>";

for ($row = 1; $row <= 12; $row++) {

    echo "<tr>";

    for ($col = 1; $col <= 12; $col++) {
        echo "<td>" . ($row * $col) . "</td>";
    }

    echo "</tr>";
}

echo "</table>";
echo "<br>";
?>

<?php
echo "<br>";
echo "<h3>Solution 9</h3>";
$num = 27;
$isPrime = true;

if ($num <= 1) {
    $isPrime = false;
} else {
    for ($i = 2; $i <= $num / 2; $i++) {
        if ($num % $i == 0) {
            $isPrime = false;
            break;
        }
    }
}

if ($isPrime) {
    echo "$num is a Prime number";
} else {
    echo "$num is a Non-Prime number";
}
echo "<br><br>";
?>

<?php
echo "<br>";
echo "<h3>Solution 10</h3>";
echo "<strong>The prime numbers 10 to 50 are:</strong><br><br>";

for ($num = 10; $num <= 50; $num++) {
    $isPrime = true;

    for ($i = 2; $i <= $num / 2; $i++) {
        if ($num % $i == 0) {
            $isPrime = false;
            break;
        }
    }

    if ($isPrime) {

        echo $num . " ";

    }
}
?>


<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f1f5f9;
        padding: 25px;

    }

    h3 {
        color: #2563eb;
    }

    table {
        /* margin: 20px auto; */
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
    }

    th {
        background: #1e40af;
        color: white;
        padding: 10px 15px;
    }

    td {
        border: 1px solid #ddd;
        padding: 8px 15px;
    }

    tr:hover {
        background: whitesmoke;
    }
</style>
<title>10 assigments</title>