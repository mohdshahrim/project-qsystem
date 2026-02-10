<?= $this->extend('layouts/header') ?>


<?= $this->section('title') ?>
    Home
<?= $this->endSection() ?>


<?= $this->section('menu') ?>
    <b>home</b>
<?= $this->endSection() ?>


<?= $this->section('sidebar') ?>
    <p class="margin-0"><a href="/fragment/pc" class="w3-button display-block">pc</a></p>
    <p class="margin-0"><a href="#" class="w3-button display-block">devices</a></p>
    <p class="margin-0"><a href="/fragment/site" class="w3-button display-block">office</a></p>
    <p class="margin-0"><a href="/fragment/staff" class="w3-button display-block">staff</a></p>
    <p class="margin-0"><a href="/home/apps" class="w3-button display-block">more...</a></p>
<?= $this->endSection() ?>

