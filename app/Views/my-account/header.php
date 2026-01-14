<?= $this->extend('layouts/header') ?>

<?= $this->section('title') ?>
    My Account
<?= $this->endSection() ?>

<?= $this->section('sidebar') ?>
    <h4 class="w3-bar-item"><b>Basic Configuration</b></h4>
    <a class="w3-bar-item w3-button w3-hover-black" href="/my-account">Account Info</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="/my-account/update-account">Update Account</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="/my-account/change-password">Change Password</a>
<?= $this->endSection() ?>