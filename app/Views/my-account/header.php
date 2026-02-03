<?= $this->extend('layouts/header') ?>


<?= $this->section('title') ?>
    My Account
<?= $this->endSection() ?>


<?= $this->section('menu') ?>
    My Account
<?= $this->endSection() ?>


<?= $this->section('sidebar') ?>
    <p class="margin-0"><a href="/my-account" class="w3-button display-block">Account Info</a></p>
    <p class="margin-0"><a href="/my-account/update-account" class="w3-button display-block">Update Account</a></p>
    <p class="margin-0"><a href="/my-account/change-password" class="w3-button display-block">Change Password</a></p>
<?= $this->endSection() ?>