<?php
  require 'secret_vars.php';
  require "urls.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Zeblogphp | <?= "{$page}" ?></title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
  <link rel="stylesheet" href="/public/css/style.css">
  <link rel="stylesheet" href="<?= "/public/css/{$page}.css" ?>">
</head>
<body>
<nav>
  <div>
    <a href="/"><img src="" alt=""></a>

  </div>
  <ul>
    <li><a href="">Catégories</a></li>
    <li><a href="">Articles</a></li>
  </ul>
  <ul>
    <li><a href="<?= "{$urls['login']}" ?>">Se connecter</a></li>
    <li><a href="<?= "{$urls['register']}" ?>">S'inscrire</a></li>
  </ul>
</nav>