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
                <?= nl2br(($post['content'])) ?>
            </p>
            <h2>
            Commentaires
            </h2>
            <form name="sentMessage" id="contactForm" novalidate>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Nom</label>
              <input type="text" class="form-control" placeholder="Nom" id="name" required data-validation-required-message="Veuillez vous connecter.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Commentaire</label>
              <textarea rows="5" class="form-control" placeholder="Commentaire" id="message" required data-validation-required-message="Veuillez écrire votre commentaire."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Soumettre</button>
          </div>
        </form>
        </div>
      </div>
    </div>
</article>

  <hr>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
