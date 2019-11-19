<?php $title = htmlspecialchars($post['title']);
$image ='public/img/mountains.jpg';
$titlePage=htmlspecialchars($post['title']);
$subheadingPage='Posté par ' .$post['user_name']. ' le ' .$post['post_date_fr'] ;
?>


<?php ob_start(); ?>

<article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
            <h2>
            Commentaires
            </h2>
        </div>
      </div>
    </div>
</article>

  <hr>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
