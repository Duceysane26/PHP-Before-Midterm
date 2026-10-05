<?php
echo "<h3>Solution 1</h3>";

echo "<strong>1. An array of one dimension:</strong><br><br>";
$arr = array(5, -7, 12, 10, -7, 11, -6, 12, 1, -7, 2, 9);

$total = 0;
$total_even = 0;
$total_odd = 0;

$min = $arr[0];
$max = $arr[0];

// 2. Print all elements & Calculate totals, min, max
echo "<strong>Elements:</strong> ";
foreach ($arr as $val) {
    echo $val . " ";

    // 3. Total of all elements
    $total += $val;

    // 4 & 5. Total of even and odd
    if ($val % 2 == 0) {
        $total_even += $val;
    } else {
        $total_odd += $val;
    }

    // Find min and max values
    if ($val < $min) {
        $min = $val;
    }
    if ($val > $max) {
        $max = $val;
    }
}

echo "<br><strong>Total of all elements:</strong> $total<br>";
echo "<strong>Total of even elements:</strong> $total_even<br>";
echo "<strong>Total of odd elements:</strong> $total_odd<br>";

// 6 & 7. Find positions of min and max
$min_positions = array();
$max_positions = array();

for ($i = 0; $i < count($arr); $i++) {
    if ($arr[$i] == $min) {
        $min_positions[] = $i;
    }
    if ($arr[$i] == $max) {
        $max_positions[] = $i;
    }
}

echo "<strong>Min element is:</strong> $min in positions: [" . implode("], [", $min_positions) . "]<br>";
echo "<strong>Max element is:</strong> $max in positions: [" . implode("], [", $max_positions) . "]<br>";
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>

<body>

    <?php
    echo "<br>";
    echo "<h3>Solution 2</h3>";
    echo "<strong>2. Associative array of two dimensions:</strong><br><br>";
    $colors = array(
        "Light" => array("Red" => "Light Red", "Green" => "Light Green", "Blue" => "Light Blue"),
        "Normal" => array("Red" => "Normal Red", "Green" => "Normal Green", "Blue" => "Normal Blue"),
        "Dark" => array("Red" => "Dark Red", "Green" => "Dark Green", "Blue" => "Dark Blue")
    );
    ?>

    <table>
        <tr>
            <th></th>
            <th>Red</th>
            <th>Green</th>
            <th>Blue</th>
        </tr>
        <?php foreach ($colors as $row_name => $row_data): ?>
            <tr>
                <th><?php echo $row_name; ?></th>
                <td><?php echo $row_data['Red']; ?></td>
                <td><?php echo $row_data['Green']; ?></td>
                <td><?php echo $row_data['Blue']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>

<?php
echo "<br>";
echo "<h3>Solution 3</h3>";
echo "<strong>3. A 3x3 array of integers:</strong><br><br>";

$array = [
    [2, -6, 8],
    [-6, 1, 6],
    [7, 8, -6]
];


echo "<table border='1' cellpadding='10'>";

foreach ($array as $row) {
    echo "<tr>";

    foreach ($row as $value) {
        echo "<td>$value</td>";
    }

    echo "</tr>";
}

echo "</table>";

$oddTotal = 0;
$evenTotal = 0;
$allTotal = 0;

foreach ($array as $row) {
    foreach ($row as $value) {
        $allTotal += $value;

        if ($value % 2 == 0) {
            $evenTotal += $value;
        } else {
            $oddTotal += $value;
        }
    }
}

echo "<br>Odd Total: $oddTotal";
echo "<br>Even Total: $evenTotal";

echo "<h4>Row Totals</h4>";

foreach ($array as $i => $row) {
    echo "Row " . ($i + 1) . ": " . array_sum($row) . "<br>";
}

echo "<h4>Column Totals</h4>";

for ($col = 0; $col < 3; $col++) {
    $total = 0;

    for ($row = 0; $row < 3; $row++) {
        $total += $array[$row][$col];
    }

    echo "Column " . ($col + 1) . ": $total<br>";
}

$diagonal1 = $array[0][0] + $array[1][1] + $array[2][2];
$diagonal2 = $array[0][2] + $array[1][1] + $array[2][0];

echo "<br>First Diagonal Total: $diagonal1";
echo "<br>Second Diagonal Total: $diagonal2";

echo "<br>All Elements Total: $allTotal";

$min = min(
    $array[0][0],
    $array[0][1],
    $array[0][2],
    $array[1][0],
    $array[1][1],
    $array[1][2],
    $array[2][0],
    $array[2][1],
    $array[2][2]
);

$max = max(
    $array[0][0],
    $array[0][1],
    $array[0][2],
    $array[1][0],
    $array[1][1],
    $array[1][2],
    $array[2][0],
    $array[2][1],
    $array[2][2]
);

echo "<br>Minimum: $min";
echo "<br>Maximum: $max";

echo "<br>Minimum Positions: ";
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        if ($array[$i][$j] == $min) {
            echo "Row " . ($i + 1) . ", Column " . ($j + 1) . " ";
        }
    }
}

echo "<br>Maximum Positions: ";
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        if ($array[$i][$j] == $max) {
            echo "Row " . ($i + 1) . ", Column " . ($j + 1) . " ";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>

<body>

    <?php
    echo "<br>";
    echo "<h3>Solution 4</h3>";
    echo "<strong>4. Associative array of students:</strong><br><br>";
    $students = array(
        "CA221_1" => array("Class" => "CA221", "Name" => "Mohamed Ahmed Ali", "Phone" => "0648440403", "Address" => "Laba Dhagax, Wardhiigley"),
        "CA223" => array("Class" => "CA223", "Name" => "Ahmed Abdi Jama", "Phone" => "0647223201", "Address" => "Taleex, Hodan"),
        "CA221_2" => array("Class" => "CA221", "Name" => "Amina Nur Adan", "Phone" => "0646990276", "Address" => "Macmacaanka, Dharkeynley")
    );
    ?>

    <table>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
        <?php foreach ($students as $data): ?>
            <tr>
                <th><?php echo $data['Class']; ?></th>
                <td><?php echo $data['Name']; ?></td>
                <td><?php echo $data['Phone']; ?></td>
                <td><?php echo $data['Address']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>

<body>

    <?php
    echo "<br>";
    echo "<h3>Solution 5</h3>";
    echo "<strong>5. Associative array of transcript:</strong><br><br>";
    $transcript = array(
        "Semester 1" => array(
            array("Course" => "English", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40),
            array("Course" => "Somali", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40),
            array("Course" => "Mathematics", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40)
        ),
        "Semester 2" => array(
            array("Course" => "Calculus", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 0),
            array("Course" => "Java Script", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40),
            array("Course" => "Python", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40)
        )
    );
    ?>

    <table>
        <tr>
            <th>Semester</th>
            <th>Course</th>
            <th>CW1</th>
            <th>MidTerm</th>
            <th>CW2</th>
            <th>Final</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
        <?php foreach ($transcript as $sem_name => $courses): ?>
            <?php
            $first = true;
            $rowspan = count($courses);
            foreach ($courses as $course):
                $total = $course['CW1'] + $course['MidTerm'] + $course['CW2'] + $course['Final'];
                $status = ($total >= 50) ? "Pass" : "Fail";
                ?>
                <tr>
                    <?php if ($first): ?>
                        <td rowspan="<?php echo $rowspan; ?>"><strong><?php echo $sem_name; ?></strong></td>
                        <?php $first = false; ?>
                    <?php endif; ?>
                    <td><?php echo $course['Course']; ?></td>
                    <td><?php echo $course['CW1']; ?></td>
                    <td><?php echo $course['MidTerm']; ?></td>
                    <td><?php echo $course['CW2']; ?></td>
                    <td><?php echo $course['Final']; ?></td>
                    <td><?php echo $total; ?></td>
                    <td><?php echo $status; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>

</body>

</html>

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