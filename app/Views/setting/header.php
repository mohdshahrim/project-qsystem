<?= $this->extend('layouts/header') ?>

<?= $this->section('javascript') ?>
    <?php
        if ($navbar=="monitor"||"pc") {
            echo "<script src=\"/js/alpinejs.min.js\" defer></script>";
            echo "<script src=\"/js/minAjax.js\" defer></script>";
        }
    ?>
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Setting
<?= $this->endSection() ?>


<?= $this->section('menu') ?>
    <a href="/setting" class="w3-button display-block <?php if($navbar=="main"){ echo "w3-asphalt";}?>">
        <b>setting</b>
    </a>
<?= $this->endSection() ?>


<?= $this->section('sidebar') ?>
    <p class="margin-0"><a href="/my-account" class="w3-button display-block <?php if($navbar=="my-account"){ echo "w3-asphalt";} ?>">my account</a></p>
    <p class="margin-0"><a href="/setting/writable" class="w3-button display-block <?php if($navbar=="writable"){ echo "w3-asphalt";} ?>">writable</a></p>
    <p class="margin-0"><a href="/setting/database" class="w3-button display-block <?php if($navbar=="database"){ echo "w3-asphalt";} ?>">database</a></p>
<?= $this->endSection() ?>