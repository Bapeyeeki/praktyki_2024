<?php 

$size = rand(1,14);

for($i=0;$i<=$size;$i++) {   

    for($j=0;$j<=$i;$j++) {

        echo '*';
    }
    echo '<br />';
}

