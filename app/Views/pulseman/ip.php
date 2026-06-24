<?php
    $session = session();
    if ($session->getFlashData('message')) {
        $message = $session->getFlashData('message');
        echo "<div style=\"width:auto; height:auto; position:absolute; top:2em; place-self:center;\" class=\"w3-yellow w3-padding w3-round\">";
        echo $message;
        echo "</div>";
    }
?>

<div class="w3-container"
x-data=""

x-init="">
    <h1>List of IP addresses</h1>

    <div>
        <div class="w3-margin-right" style="display: inline-block;">
            <a href="/pulseman/ip/new" class="w3-button w3-asphalt w3-round">
                <i class="fa fa-plus"></i>
            </a>

            <button href="/pulseman/ip/new" class="w3-button w3-red w3-round">
                Recheck all
            </button>
        </div>
    </div>

    <br>

    <!-- table -->
    <table class="w3-table w3-white w3-border w3-bordered w3-hoverable">
        <tr>
            <td class="w3-border-right">no</td>
            <td class="w3-border-right">label</td>
            <td class="w3-border-right">IP address</td>
            <td class="w3-border-right">description</td>
            <td class="w3-border-right">status</td>
            <td class="w3-border-right">checked at</td>
            <td>options</td>
        </tr>
        <?php foreach ($ips as $key=>$row): ?>
            <tr class="w3-small">
                <td class="w3-border-right"><?= ($key+1) ?></td>
                <td class="w3-border-right">
                    <a href="/pulseman/ip/<?= $row['id'] ?>" class="text-decoration-none"><?= $row['label'] ?></a>
                </td>
                <td class="w3-border-right"><?= $row['ip_address'] ?></td>
                <td class="w3-border-right"><?= $row['ip_description'] ?></td>
                <td class="w3-border-right"><?= $row['status'] ?></td>
                <td class="w3-border-right"><?= $row['checked_at'] ?></td>
                <td class="w3-border-right">
                    <a href="/pulseman/ip/delete/<?= $row['id'] ?>" class="text-decoration-none">delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>