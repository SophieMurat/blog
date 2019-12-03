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
            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" name="sentComment" id="commentForm" novalidate method="post">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Commentaire</label>
                  <textarea rows="5" class="form-control" name="comment_content" placeholder="Commentaire" id="message" required></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <br>
              <div id="success"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Soumettre</button>
              </div>
            </form>
            <p class="alert alert-danger"><?= $this->msg ?></p>
          <?php foreach ($comments as $comment):?>
              <p><strong><?= htmlspecialchars($comment['user_name']) ?></strong> le <?= $comment['comment_date_fr'] ?> 
              <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
              <button class="btn btn-danger">Signaler le commentaire</button>
          <?php endforeach; ?>
        </div>
      </div> 
    </div>
</article>

  <hr>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
