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
x-data="">
    <h1>Update IP</h1>

    <br>

    <div>
        <form action="/pulseman/ip/update" method="post">
            <table>
                <colgroup>
                    <col>
                    <col width="350px">
                </colgroup>
                <!-- IP NAME -->
                <tr>
                    <td>
                        <label class="w3-label">Label</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="hidden" name="id" value="<?= $ip['id'] ?>" />
                        <input type="text" name="label" class="w3-input w3-border" value="<?= $ip['label'] ?>"></input>
                        <span class="w3-text-red position-absolute right-0 top--10px font-size-2rem user-select-none">*</span>
                    </td>
                </tr>

                <!-- IP ADDRESS -->
                <tr>
                    <td>
                        <label class="w3-label">IP address</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="text" name="ip_address" class="w3-input w3-border" value="<?= $ip['ip_address'] ?>"></input>
                        <span class="w3-text-red position-absolute right-0 top--10px font-size-2rem user-select-none">*</span>
                    </td>
                </tr>

                <!-- DESCRIPTION -->
                <tr>
                    <td>
                        <label class="w3-label">Description</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="text" name="description" class="w3-input w3-border" value="<?= $ip['description'] ?>"></input>
                    </td>
                </tr>

                <!-- [empty row, just to make margin] -->
                <tr>
                    <td></td>
                    <td>
                        &nbsp;
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <a href="/pulseman/ip/delete/<?= $ip['id'] ?>" class="w3-button w3-text-red w3-round">delete</a>
                        <a href="/pulseman/ip" class="w3-button w3-red w3-round">cancel</a>
                        <button type="submit" class="w3-button w3-asphalt w3-round">update</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>