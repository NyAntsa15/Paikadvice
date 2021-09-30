<?php 
    session_start();
    $_SESSION['idV']=0;
    $_SESSION['idA']=0;
    $_SESSION['mail']=$_POST['email'];
    $email = $_SESSION['mail'];
    require('includes/autoloader.inc.php');
    if(isset($_POST['oui'])){
        $sql="SELECT idVulg FROM Vulg WHERE email='$email'";
        $d=new Dbh();
        $f=$d->dbconnect()->query($sql);
        $id=$f->fetchAll();
        $_SESSION['idV']=$id[0]['idVulg'];
        $vulgb=new Vulg();
        $test=$vulgb->sign__in($_POST['email'],$_POST['password']);
        
        if($test==1){
           header('Location:bienvenue.php?ok');
        }else{
            header('Location:index.php?erreurLogin');
        }
    }else{
        $sql="SELECT idAgri FROM Agri WHERE email='$email'";
        $d=new Dbh();
        $f=$d->dbconnect()->query($sql);
        $id=$f->fetchAll();
        $_SESSION['idA']=$id[0]['idAgri'];
        $agrib=new Agri();
        $test1=$agrib->sign__in($_POST['email'],$_POST['password']);
        if($test1==1){
            header('Location:bienvenue.php?non');
        }else{
            header('Location:index.php?erreurLogin');
        }
    }
?>