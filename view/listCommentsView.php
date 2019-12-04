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
            <td><?= $comment['report']?></td>
            <td><button>Supprimer</button></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdminView.php'); ?>