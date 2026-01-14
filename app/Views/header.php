<?= $this->extend('layouts/header') ?>

<?= $this->section('title') ?>
    Home
<?= $this->endSection() ?>

<?= $this->section('sidebar') ?>
    <h4 class="w3-bar-item"><b>IT Inventory</b></h4>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">PC</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">Monitors</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">Devices</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">Users</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">Sites</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">PC Layout Diagram</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">Network Hardwares</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">Tools & Equipments</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">IT Documents</a>

    <br>

    <h4 class="w3-bar-item"><b>Tools</b></h4>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">KPI</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">Claim maker</a>
<?= $this->endSection() ?>