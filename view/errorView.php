<?php $title = 'Erreur';
$image ='public/img/aurora-borealis.jpg';
$titlePage='Une erreur s\'est produite!';
$subheadingPage='';
?>
<?php ob_start(); ?>
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto alert alert-danger"><?= $this->msg ?></div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>