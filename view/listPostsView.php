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
      while ($data = $posts->fetch())
      {
      ?>
        <div class="post-preview">
          <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">
            <h2 class="post-title">
                <?= htmlspecialchars($data['title']) ?>
            </h2>
            <h3 class="post-subtitle">
                <?= substr(nl2br($data['content']),0,100) ?>...
                <br/>
            </h3>
          </a>
          <p class="post-meta">Posté par <?= $data['user_name'] ?>
            le  <?= $data['post_date_fr'] ?> </p>
        </div>
        <hr>
<?php
}
$posts->closeCursor();
?>
<div>
    <?php if ($currentPage >1): ?>
        <button class="btn btn-primary"><a href="index.php?page=<?= $currentPage -1 ?>">&laquo; Page précédente</a></button>
    <?php endif ?>
    <?php if ($currentPage <$pages): ?>
        <button class="btn btn-primary"><a href="index.php?page=<?= $currentPage +1 ?>">Page suivante &raquo;</a></button>
    <?php endif ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>