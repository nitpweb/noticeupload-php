<?php
function printData($filename)
{
    $file = fopen($filename, 'r');
    while (!feof($file)) {
        $row = fgetcsv($file);
        if(strtotime($row[1]) <= strtotime(date('Y-m-d')) && strtotime($row[2]) >= strtotime(date('Y-m-d'))){
            echo "<a href='$row[4]'>  $row[3] </a><br>";
        }
        

 }
    fclose($file);
}

function writeData($filename, $array)
{
    $file = fopen($filename, 'a');
    fputcsv($file, $array);
    fclose($file);
}


?>

<?php  ?>