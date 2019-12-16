<?php $title = 'Jean Forteroche'; 
 $image ='public/img/aurore.jpg';
 $titlePage='Lecture innovante d\'un nouveau roman';
 $subheadingPage='Suivez le chapitre par chapitre';
 ?>
<?php ob_start();?>

<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      <?php
      foreach($posts as $post)
      {
      ?>
        <div class="post-preview">
          <a href="index.php?action=post&amp;id=<?= $post->getId() ?>">
            <h2 class="post-title">
                <?= htmlspecialchars($post->getTitle()) ?>
            </h2>
            <h3 class="post-subtitle">
                <?= substr(nl2br($post->getContent()),0,100) ?>...
                <br/>
            </h3>
          </a>
          <p class="post-meta">Posté par <?= $post->getAuthor() ?>
            le  <?= $post->getPost_date_fr() ?> </p>
        </div>
        <hr>
<?php
}
?>
<div>
    <?php if ($currentPage >1): ?>
      <a href="index.php?page=<?= $currentPage -1 ?>"><button class="btn btn-primary">&laquo; Page précédente</button></a>
    <?php endif ?>
    <?php if ($currentPage <$pages): ?>
      <a href="index.php?page=<?= $currentPage +1 ?>"><button class="btn btn-primary">Page suivante &raquo;</button></a>
    <?php endif ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>