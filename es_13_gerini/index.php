<?php
   include('quizdata.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
        foreach ($quiz as $q){
            echo $q["question"];
            foreach($q["answers"] as $ans){
                echo $ans;
            }
        }



    ?>
</body>
</html>