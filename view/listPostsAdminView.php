<?php $title = 'Listes des articles';
$titlePage= 'Listes des articles publiés';
$subheadingPage="";
?>
<?php ob_start(); ?>

<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      <a href="index.php?action=createArticle" style="text-decoration:none"><button type="button" class="btn btn-success">Créer un article</button></a>
      <?php
      while ($data = $posts->fetch())
      {
      ?>
        <div class="post-preview">
          <a href="index.php?action=postAdmin&amp;id=<?= $data->getId()?>">
            <h2 class="post-title">
                <?= htmlspecialchars($data->getTitle()) ?>
            </h2>
            <h3 class="post-subtitle">
                <?= (substr(nl2br($data->getContent()),0,100)) ?>...
                <br/>
            </h3>
            <p class="post-meta">Posté le  <?= $data->getPost_date_fr() ?> </p>
            <button type="button" class="btn btn-primary">Modifier</button>
            <button type="button" class="btn btn-danger">Supprimer</button>
          </a>
        </div>
        <hr>
<?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdminView.php'); ?>