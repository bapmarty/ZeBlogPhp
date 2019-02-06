<?php
  $page = "Home";
  require __DIR__.'/components/head.php';
  require __DIR__.'/components/navbar.php';
  $bg = scandir(__DIR__. '/uploads/web/background/');
  if (isset($bg[3]))
  {
    ?>
      <img src="/uploads/web/background/Background.png" alt="bg" id="bg">
    <?php
  }
  else {
    ?>
    <div id="test">
      <img src="/img/cloud.png" alt="cloud1" id="cloud1" class="cloud">
      <img src="/img/cloud.png" alt="cloud2" id="cloud2" class="cloud">
      <img src="/img/cloud.png" alt="cloud3" id="cloud3" class="cloud">
      <img src="/img/cloud.png" alt="cloud3" id="cloud4" class="cloud">
      <img src="/img/cloud.png" alt="cloud3" id="cloud5" class="cloud">
      <img src="/img/cloud.png" alt="cloud3" id="cloud6" class="cloud">
    </div>
    <?php 
  }
  ?>
  <h1 id="thename"><?= WEBNAME ?></h1>
<?php
  require __DIR__.'/components/footer.php';
?>