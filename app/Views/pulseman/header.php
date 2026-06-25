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
    Pulseman
<?= $this->endSection() ?>


<?= $this->section('menu') ?>
    <a href="/pulseman" class="w3-button display-block <?php if($navbar=="main"){ echo "w3-asphalt";}?>">
        <b>pulseman</b>
    </a>
<?= $this->endSection() ?>


<?= $this->section('sidebar') ?>
    <p class="margin-0 <?php if($navbar=="ip"){ echo "w3-asphalt";} ?>"><a href="/pulseman/ip" class="w3-button display-block">IP address</a></p>
    <p class="margin-0 <?php if($navbar=="statuscode"){ echo "w3-asphalt";} ?>"><a href="/pulseman/statuscode" class="w3-button display-block">status code</a></p>
<?= $this->endSection() ?>