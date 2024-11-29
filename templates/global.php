<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? $headTitle ?? "Blog Voyage" ?></title>
    <link rel="stylesheet" href='<?= "/sources/css/style.css?v=" . filemtime(ROOT . "/sources/css/style.css"); ?>'>
</head>

<header class="main-head">
    <figure class="logo-figure">
        <img src="<?= '/assets/logos/logo_php_blog.png' ?> " alt="logo blog voyage" class="logo-img" />
    </figure>
    <nav class="main-nav">
    <ul class="main-nav-links">
      <li><a href="/">Accueil</a></li>
      <li><a href="/articles">Nos articles</a></li>
      <li><a href="/articles/4">Article 4</a></li>
      <li><a href="/contact">Contact</a></li>
      <li><a href="/game">Jouer</a></li>
    </ul>
    <div class="burger">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>
</header>

<main class="main-content">
    <?= $mainContent ?? "Erreur 404" ?>
</main>

<footer class="main-foot">
    <p class="copyright">© Fictive.Corps - 2024 - all right reserved</p>
</footer>

<script src="<?="/sources/js/burger.js?v=".filemtime(ROOT."/sources/js/burger.js")?>" ></script>
<!-- </body> -->

</html>