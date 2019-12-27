<?php $title = 'Modifier un article';
$titlePage= 'Modifier l\'article';
$subheadingPage="";
?>

<?php ob_start(); ?>

<article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="index.php?action=postUpdate&amp;id=<?=$post->getId() ?>" name="sentMessage" id="contactForm" method="post" novalidate>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                    <label>Titre</label>
                    <input type="text" class="form-control" name="title" value="<?=$post->getTitle() ?>" id="title" required>
                    <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls floating-label-form-group-with-value">
                    <label>Chapitre</label>
                    <textarea rows="5" placeholder="Contenu" name="content" id="article_content" required><?= $post->getContent() ?></textarea>
                    <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Modifier l'article</button>
                </div>
            </form>
            <?php if ($this->error): ?>
            <p class="alert alert-danger"><?= $this->msg ?></p>
            <?php endif ?>
        </div>
      </div>
    </div>
</article>

  <hr>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdminView.php'); ?>