<?= $this->extend('layouts/header') ?>


<?= $this->section('title') ?>
    Setting
<?= $this->endSection() ?>


<?= $this->section('menu') ?>
    <b>setting</b>
<?= $this->endSection() ?>


<?= $this->section('sidebar') ?>
    <p class="margin-0"><a href="/my-account" class="w3-button display-block <?php if($navbar=="my-account"){ echo "w3-asphalt";} ?>">my account</a></p>
    <p class="margin-0"><a href="/setting/writable" class="w3-button display-block <?php if($navbar=="writable"){ echo "w3-asphalt";} ?>">writable</a></p>
<?= $this->endSection() ?>