<?php $title = 'Commentaires';
$titlePage= 'Listes des commentaires à modérer';
$subheadingPage="Choisissez une action";
?>

<?php ob_start(); ?>
<div class="container">
    <div class="table-responsive">
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
            <td><?= $comment['title'] ?></td>
            <td><?= $comment['comment_date_fr'] ?></td>
            <td><?= $comment['user_name'] ?></td>
            <td><?= $comment['comment'] ?></td>
            <td><?= $comment['nbr_comments']?></td>
            <td>
            <div class="btn-group" role="group">
                <a href="href=index.php?action=displayChoices&amp;commentId=<?= $comment['id']?>"><button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                Choix</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item alert alert-danger" href="index.php?action=deleteComment&amp;commentId=<?= $comment['id'] ?>">Supprimer</a>
                <a class="dropdown-item alert alert-success" href="index.php?action=resetReport&amp;commentId=<?= $comment['id']?>">Retirer le signalement</a>
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