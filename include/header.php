<?php
session_start();
include_once 'classes/autoloader.php';
$db = new Database();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Otaru Embroidery</title>
    <link rel="icon" type="image/x-icon" href="/img/xicon.jpg">
    <link rel="stylesheet" href="/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <a class="navbar-brand custom-margin-left" href="/index">
            <img src="/img/logo_dark.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ms-3 <?php echo ($_SERVER['PHP_SELF'] == '/index.php') ? 'active-link' : ''; ?>">
                    <a class="nav-link" href="/index">Home</a>
                </li>
                <li class="nav-item ms-3 <?php echo ($_SERVER['PHP_SELF'] == '/catalog.php') ? 'active-link' : ''; ?>">
                    <a class="nav-link" href="/catalog">Catalog</a>
                </li>
                <li class="nav-item ms-3 <?php echo ($_SERVER['PHP_SELF'] == '/bundles.php') ? 'active-link' : ''; ?>">
                    <a class="nav-link" href="/bundles">Bundles</a>
                </li>
                <li class="nav-item ms-3 <?php echo ($_SERVER['PHP_SELF'] == '/custom-digitizing.php') ? 'active-link' : ''; ?>">
                    <a class="nav-link" href="/custom-digitizing">Custom Digitizing</a>
                </li>
                <li class="nav-item ms-3 <?php echo ($_SERVER['PHP_SELF'] == '/faq.php') ? 'active-link' : ''; ?>">
                    <a class="nav-link" href="/faq">FAQ</a>
                </li>
                <li class="nav-item ms-3 <?php echo ($_SERVER['PHP_SELF'] == '/contact.php') ? 'active-link' : ''; ?>">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
                <div class="cml">
                    <li class="nav-item ms-3">
                        <a class="nav-link" href="/cart">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>
