<?php $title = htmlspecialchars($post->getTitle());
$image ='public/img/mountains.jpg';
$titlePage=htmlspecialchars($post->getTitle());
$subheadingPage='Posté par ' .$post->getAuthor(). ' le ' .$post->getPost_date_fr() ;
?>


<?php ob_start(); ?>

<article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php if ($this->errorReport): ?>
            <p class="alert alert-danger"><?= $this->msgReport ?></p>
            <?php endif ?>
            <p>
                <?= nl2br($post->getContent()) ?>
            </p>
            <h2>
            Commentaires
            </h2>
            <form action="index.php?action=addComment&amp;id=<?= $post->getId() ?>#commentMsg" name="sentComment" id="commentForm" novalidate method="post">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Commentaire</label>
                  <textarea rows="5" class="form-control" name="comment_content" placeholder="Commentaire" id="message" required></textarea>
                </div>
              </div>
              <br>
              <div id="success"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Soumettre</button>
              </div>
            </form>
            <?php if ($this->error): ?>
            <p class="alert alert-danger" id="commentMsg"><?= $this->msg ?></p>
            <?php endif ?>
          <?php foreach ($comments as $comment):?>
              <p><strong><?= htmlspecialchars($comment->getAuthor()) ?></strong> le <?= $comment->getComment_date_fr() ?> 
              <p><?= nl2br(htmlspecialchars($comment->getComment())) ?></p>
              <a href="index.php?action=reportComment&amp;id=<?= $comment->getPost_id()?>&amp;commentId=<?=$comment->getId()?>"><button class="btn btn-danger">Signaler le commentaire</button></a>
          <?php endforeach; ?>
        </div>
      </div> 
    </div>
</article>

  <hr>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
