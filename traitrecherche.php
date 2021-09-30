<?php 
    require('includes/autoloader.inc.php');
    $search=new Recherche();
    /*if(isset($_GET['ok']))
    {
        $search->search_results($_GET['search']);
    }
    if(isset($_GET['ok2']))
    {
        $search->search_results($_GET['search']);
    }*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<title>Paikadvice</title>
	<link rel="icon" type="image/png" href="image/Paikadvice.png">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<?php 
    $search->search_results($_GET['search']);
?>
</body>
</html>