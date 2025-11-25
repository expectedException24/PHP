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
        /*foreach ($quiz as $index => $q) {
            echo "<div style='margin-bottom:20px; padding:15px; border:1px solid #ccc; border-radius:8px;'>";
            echo "<h3 style='margin-top:0;'>" . htmlspecialchars($q["question"]) . "</h3>";
            echo "<ul style='list-style:none; padding-left:0;'>";
            foreach ($q["answers"] as $aIndex => $ans) {
                echo "
                    <li style='margin:6px 0;'>
                        <label>
                            <input type='checkbox' 
                                name='q{$index}[]' 
                                value='{$aIndex}' 
                                style='margin-right:6px;'>
                            " . htmlspecialchars($ans) . "
                        </label>
                    </li>
                ";
            }
            echo "</ul>";
            echo "</div>";
        }
    ?>*/

</body>
</html>