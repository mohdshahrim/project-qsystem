<?= $this->extend('layouts/header') ?>


<?= $this->section('title') ?>
    Fragment
<?= $this->endSection() ?>


<?= $this->section('menu') ?>
    <b>fragment</b>
<?= $this->endSection() ?>


<?= $this->section('sidebar') ?>
    <p class="margin-0 <?php if($navbar=="main"){ echo "w3-asphalt";} ?>"><a href="/fragment" class="w3-button display-block">main</a></p>
    <p class="margin-0 <?php if($navbar=="pc"){ echo "w3-asphalt";} ?>"><a href="/fragment/pc" class="w3-button display-block">pc</a></p>
    <p class="margin-0 <?php if($navbar=="monitor"){ echo "w3-asphalt";} ?>"><a href="/fragment/monitor" class="w3-button display-block">monitor</a></p>
    <p class="margin-0 <?php if($navbar=="printer"){ echo "w3-asphalt";} ?>"><a href="/fragment/printer" class="w3-button display-block">printer</a></p>
    <p class="margin-0 <?php if($navbar=="staff"){ echo "w3-asphalt";} ?>"><a href="/fragment/staff" class="w3-button display-block">staff</a></p>
    <p class="margin-0 <?php if($navbar=="site"){ echo "w3-asphalt";} ?>"><a href="/fragment/site" class="w3-button display-block">site</a></p>
    <p class="margin-0 <?php if($navbar=="department"){ echo "w3-asphalt";} ?>"><a href="/fragment/department" class="w3-button display-block">department</a></p>
<?= $this->endSection() ?>