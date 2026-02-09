<?= $this->extend('layouts/header') ?>


<?= $this->section('title') ?>
    My Account
<?= $this->endSection() ?>


<?= $this->section('menu') ?>
    <b>my account</b>
<?= $this->endSection() ?>


<?= $this->section('sidebar') ?>
    <p class="margin-0"><a href="/my-account" class="w3-button display-block">account info</a></p>
    <p class="margin-0"><a href="/my-account/update-account" class="w3-button display-block">update account</a></p>
    <p class="margin-0"><a href="/my-account/change-password" class="w3-button display-block">change password</a></p>
<?= $this->endSection() ?>