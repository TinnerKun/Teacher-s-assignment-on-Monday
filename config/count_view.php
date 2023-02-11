<?php
$file = 'count.txt';
$count = number_format(@file_get_contents($file));
file_put_contents($file, $count + 1);
?>
