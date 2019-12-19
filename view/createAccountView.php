<?php $title = 'Inscription';
$image ='public/img/alaskanlandscape.jpg';
$titlePage='Incrivez vous ici';
$subheadingPage='Remplissez le formulaire ci dessous';
?>

<?php ob_start(); ?>
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <form action="index.php?action=accountCreate#createAccountError" name="createAccount" id="contactForm" method="post">
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Nom</label>
                    <input type="text" class="form-control" name="name" placeholder="Nom" id="name" pattern="[a-zA-ZÀ-ÿ-]+" title="Lettres et '-' acceptés">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Login</label>
                    <input type="text" class="form-control" name="login" placeholder="Login" id="login" pattern="[a-zA-ZÀ-ÿ0-9]+" title="Tous caractères alpha-numériques">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Mot de passe</label>
                    <input type="password" class="form-control" name="password" placeholder="Mot de passe" id="password" required data-validation-required-message="Veuillez remplir ce champs.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Confirmez le mot de passe</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmez le mot de passe" id="password_confirmation" required data-validation-required-message="Veuillez remplir ce champs.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary" id="sendMessageButton">Confirmer</button>
            </div>
        </form>
        <?php if ($this->error): ?>
        <p class="alert alert-danger" id="createAccountError"><?= $this->msg ?></p>
        <?php endif ?>
      </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
