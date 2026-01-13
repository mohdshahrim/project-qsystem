<div class="w3-container w3-padding-64">
    <h2>System Message</h2>
    <h2 class="<?php
        if ($type=="warning") {
            echo "w3-text-red";
        }
        elseif ($type="info") {
            echo "w3-text-green";
        }?>">
        <?= $message; ?>
    </h2>

    <br>

    <p>
        Go back to <a tabindex="1" class="w3-text-blue" href="<?= $returnlink;?>"><?= $returnlink;?></a>
    </p>
</div>