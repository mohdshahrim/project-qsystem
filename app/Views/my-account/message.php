<div class="w3-padding" style="">
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