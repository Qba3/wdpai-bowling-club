<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
<h1>Login</h1>
<a href="./main">main</a>
<form action="../../src/Login.php" method="post">
    <div class="messages">
        <?php if (isset($messages)) {
            foreach ($messages as $message) {
                echo "<p>$message</p>";
            }
        }
        ?>
    </div>
    <label for="login"> Login: </label><br>
    <input type="text" id="login" name="login"><br>
    <label for="password"> Password: </label><br>
    <input type="text" id="password" name="password"><br>
    <button type="submit"> Log in!</button>
</form>
</body>

</html>