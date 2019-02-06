<?php 
session_start(); 

require __DIR__.'/../src/classes/webClass.php';

use Zeblogphp\Web;

$webname = new Web;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/uploads/web/logo/logo.png" type="image/x-icon">
  <title><?= WEBNAME ?> | <?= $page ?></title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="/js/jscolor.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="/stylesheets/css/style.css">
  <style>
    div#header h3 img {
      border: 2px solid <?= COLORWEBSITE ?>;
    }
    .nav-item.active,
    .nav-item:hover,
    section.profile div.profile-container div.settings hr, 
    section.profile div.profile-container div.panel hr,
    section.container-cArticle hr,
    div.article-container div.article-group hr,
    div.article-container div.categorie-group hr,
    div#noImgArticle {
      background-color: <?= COLORWEBSITE ?>;
    }
    div.article h4 a:hover {
      color: <?= COLORWEBSITE ?>;
    }
  </style>
</head>
<body>