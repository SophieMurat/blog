<?php $title = 'Création d\'article';
$titlePage= 'Creation d\'article';
$subheadingPage="Créer un nouveau chapitre";
?>
<?php ob_start(); ?>

<article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="index.php?action=addPost" name="sentMessage" id="contactForm" method="post" novalidate>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                    <label>Titre</label>
                    <input type="text" class="form-control" name="title" placeholder="Titre" id="title" required>
                    <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls floating-label-form-group-with-value">
                    <label>Chapitre</label>
                    <textarea rows="5" placeholder="Contenu" name="content" id="article_content" required></textarea>
                    <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Ajouter l'article</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</article>

  <hr>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdminView.php'); ?>