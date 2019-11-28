<?php $title = 'Article';
$titlePage= 'Actions sur l\'article choisi';
$subheadingPage="";
?>
<?php ob_start(); ?>

<div class="container">
<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
    <a href="index.php?action=createArticle" style="text-decoration:none"><button type="button" class="btn btn-success">Créer un article</button></a>
    <a href="index.php?action=postModify&id=<?= $post['id'] ?>" style="text-decoration:none"><button type="button" class="btn btn-primary">Modifier ici</button></a>
    <a href="index.php?action=postDelete" style="text-decoration:none"><button type="button" class="btn btn-danger">Confirmer suppression</button></a>
    <p>
        <?= nl2br(($post['content'])) ?>
    </p>


<?php $content = ob_get_clean(); ?>

<?php require('templateAdminView.php'); ?>