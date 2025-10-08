<?php
$waiters = ["Luca", "Maria", "Giovanni", "Elena", "Marco"];

if(isset($_GET['name'] && $_GET['surname'] && $_GET['nTable']&& $_GET['time']&& $_GET['extraSpec']&& $_GET['menu']&& $_GET['nTable']&&$_GET['parking'])){
    elaborateOrder();
} else {
    echo "Dati mancanti.";
}
function elaborateOrder(){
        $dati = [
        'name'       => htmlspecialchars($_GET['name']),
        'surname'    => htmlspecialchars($_GET['surname']),
        'nTable'     => htmlspecialchars($_GET['nTable']),
        'time'       => htmlspecialchars($_GET['time']),
        'extraSpec'  => htmlspecialchars($_GET['extraSpec']),
        'menu'       => is_array($_GET['menu']) ? array_map('htmlspecialchars', $_GET['menu']) : [htmlspecialchars($_GET['menu'])],
        'parking'    => htmlspecialchars($_GET['parking'])
    ];
}

?>
