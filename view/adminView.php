<?php $title = 'Admin';
$titlePage= 'Bonjour ' .$_SESSION['user_name'].' !';
$subheadingPage="Tableau de bord";
?>


<?php ob_start(); ?>
<div class="container" style="padding-top:12%">
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <a href="index.php?action=getAllPostAdmin" style="text-decoration:none"><div class="col text-xs font-weight-bold">Listes des articles</div></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <a href="index.php?action=listReportedComments" style="text-decoration:none"><div class="col text-xs font-weight-bold">Commentaires à modérer</div></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <a href="index.php?action=createArticle" style="text-decoration:none"><div class="col mr-2 text-xs font-weight-bold mb-1">Créer un article</div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdminView.php'); ?>