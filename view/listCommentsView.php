<?php $title = 'Commentaires';
$titlePage= 'Listes des commentaires à modérer';
$subheadingPage="Choisissez une action";
?>

<?php ob_start(); ?>
<div class="container">
    <div id="comment_table" class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Titre de l'article</th>
            <th>Date du commentaire</th>
            <th>Auteur du commentaire</th>
            <th>Commentaire</th>
            <th>Nombre de signalements</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($reportedComments as $comment): ?>
        <tr>
            <td class="non_responsive"><?= $comment->getPost_title() ?></td>
            <td class="non_responsive"><?= $comment->getComment_date_fr() ?></td>
            <td class="non_responsive"><?= $comment->getAuthor() ?></td>
            <td class="non_responsive"><?= $comment->getComment() ?></td>
            <td class="non_responsive"><?= $comment->getNbr_comments()?></td>
            <td class="text-center">
            <div id="comment_responsive"><p>Commentaire: </p> 
                <p class="text-info"> <?= $comment->getComment()?> </p>
                <p>Article <?= $comment->getPost_title() ?></p> 
                <p>posté le <?= $comment->getComment_date_fr()?></p> 
                <p>signalé <?= $comment->getNbr_comments()?> fois.</p>
            </div>
            <div class="btn-group" role="group">
                <a href="href=index.php?action=displayChoices&amp;commentId=<?= $comment->getId()?>"><button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                Choix</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item alert alert-danger" href="index.php?action=deleteComment&amp;commentId=<?= $comment->getId() ?>">Supprimer</a>
                <a class="dropdown-item alert alert-success" href="index.php?action=resetReport&amp;commentId=<?= $comment->getId()?>">Retirer le signalement</a>
                </div>
            </div>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdminView.php'); ?>