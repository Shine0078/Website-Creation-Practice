<?php
$title="Home Page";
$name="Samuel Abraham";
$file="index.php";
$date="8/9/2023";

#include "./includes/header.php";
#header("Location:./sign-in.php");
#ob_flush();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">


    <!-- 
        Name: <?php echo $name."</n>"; ?>
        File:<?php echo $file."</n>"; ?>
        Date:<?php echo $name."</n>"; ?>
    -->

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/styles.css" rel="stylesheet">
	
  </head>

  <body>
    
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Samuel Abraham</a>
        <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            

        <?php
        if(isset($_SESSION['user'])){
            echo '<a class="nav-link" href="./logout.php">Sign out</a>';
        }
        else{
            echo '<a class="nav-link" href="./sign-in.php">Sign in</a>';
        }
?>

            <a class="nav-link" href="./logout.php">Sign out</a>
            </a>
                </li>
            </ul>
            </div>
        </nav>
        

        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

<h1 class="cover-heading">Cover your page.</h1>
<p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
<p class="lead">
    <a href="#" class="btn btn-lg btn-secondary">Learn more</a>
</p>

<?php
include "./includes/footer.php";
?>    