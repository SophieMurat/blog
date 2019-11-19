<?php $title = 'Jean Forteroche'; 
 $image ='public/img/aurore.jpg';
 $titlePage='Lecture innovante d\'un nouveau roman';
 $subheadingPage='Suivez le chapitre par chapitre';
 ?>
<?php ob_start();?>

<?php
while ($data = $posts->fetch())
{
?>
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-preview">
          <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">
            <h2 class="post-title">
                <?= htmlspecialchars($data['title']) ?>
            </h2>
            <h3 class="post-subtitle">
                <?= substr(nl2br(htmlspecialchars($data['content'])),0,100) ?>...
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
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>