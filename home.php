 <?php 
    include 'utils.php';
    session_start();
    checkCredentials();
?>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="css/main.css" type="text/css">
</head>
<body>
    <?php
    includeFile('header.php', ["title" => 'LOL', "logout"=> true])
    ?>
    Stuff only users can see
</body>
</html>