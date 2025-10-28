<?php
    use App\Models\EcModel;
    $ecmodel = new EcModel();
?>

<div>
    <p>
        <a href="/">home</a>
        >
        <a href="/public/ec">eleave checker</a>
    </p>
</div>

<div class="w3-container">
    <h1>Who's on-leave today?</h1>
    <h3><?php echo date("l d/m/Y");?></h3>
</div>

<div class="w3-container w3-margin-left">
    <?php
        // simplify and restructure
        // get list of names
        $namelist = $ecmodel->getNameList();
        echo "<p><b>".sizeof($namelist)." staffs is on-leave today</b></p>";
        sort($namelist); // sort alphabetically
        foreach ($namelist as $name) {
            echo '<p class="w3-small">'.$name.'</p>';
        }
    ?>
</div>