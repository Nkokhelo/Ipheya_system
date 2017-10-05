<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Document</title>
</head>
<body>
    <form action="../core/controllers/expenses-controller.php" method="POST">
        <input type="text" name="number" id="number" />
        <input type="submit" value="save" patten="[0]{1}[6-8]{1}[0-9]{8}" required />
    </form>
</body>
</html>