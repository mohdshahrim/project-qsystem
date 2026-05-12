<?= $this->extend('layouts/header') ?>


<?= $this->section('title') ?>
    Home
<?= $this->endSection() ?>


<?= $this->section('menu') ?>
    <a href="/home" class="w3-button display-block">
        <b>home</b>
    </a>
<?= $this->endSection() ?>


<?= $this->section('sidebar') ?>
    <p class="margin-0"><a href="/fragment/pc" class="w3-button display-block">fragment</a></p>
    <p class="margin-0"><a href="#" class="w3-button display-block">devices</a></p>
    <p class="margin-0"><a href="/home/apps" class="w3-button display-block">more...</a></p>
<?= $this->endSection() ?>

