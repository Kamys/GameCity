<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo '<pre>';
            echo 'Thtis POST:<br>';
            foreach ($_POST as $key => $value) {
                echo htmlspecialchars($key) . " = " . htmlspecialchars($value) . "<br>";
            }
            echo '</pre>';
        }
        ?>
        <form action="" method="post">
            Name:  <input type="text" name="name" /><br />
            Email: <input type="text" name="email" /><br />
            Please, select beer: <br />
            <select multiple name="beer">
                <option value="warthog">Warthog</option>
                <option value="guinness">Guinness</option>
                <option value="stuttgarter">Stuttgarter Schwabenbräu</option>
            </select><br />
            <input type="submit" value="Go!" />
        </form>
    </body>
</html>
