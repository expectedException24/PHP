
<?php

function mean($numbers){
    return array_sum($numbers) / count($numbers);
}
function getResult($mean){
    return $mean >=6 ? "PROMOSSO":"BOCCIATO";

}

?>