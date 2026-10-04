<?php
$info = array(
"CA221"=> array( "name"=>"mohamed ahmed ali","phone"=>"252612223999","address"=>" hodan"),
"CA223"=> array( "name"=>"mohamed ahmed ali","phone"=>"2526146747699","address"=>" kaxda"),
"CA224"=> array( "name"=>"mohamed ahmed ali","phone"=>"252614647699","address"=>" kaaraan"));

echo "<table border='1'>";
echo"<th>Classes</th>";
foreach($info['CA221'] as $k=> $v){
    echo "<th>$k</th>";
    }
    echo "</tr>";

    foreach($info as $k=> $v){
        echo "<tr>";
        echo "<td>".$k."</td>";
        foreach($v as $key1 => $v1){
            echo "<td>".$v1."</td>";}
        echo "</tr>";
    }

   




?>