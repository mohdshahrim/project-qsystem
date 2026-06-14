<?php
    $session = session();
    if ($session->getFlashData('message')) {
        $message = $session->getFlashData('message');
        echo "<div style=\"width:auto; height:auto; position:absolute; top:2em; place-self:center;\" class=\"w3-yellow w3-padding w3-round\">";
        echo $message;
        echo "</div>";
    }
?>

<div class="w3-container">
    <h1>Printer #<?= $printer['id'] ?></h1>

    <br>

    <div class="w3-third">
        <form action="/fragment/printer/update" method="post">
            <table>
                <colgroup>
                    <col width="150px"></col>
                    <col></col>
                </colgroup>
                <tr>
                    <td>Model</td>
                    <td>
                        <input type="hidden" name="id" value="<?= $printer['id'] ?>" />
                        <input type="text" name="model" class="w3-input w3-border" value="<?= $printer['model'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Serial no</td>
                    <td>
                        <input type="text" name="serial_no" class="w3-input w3-border" value="<?= $printer['serial_no'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Nickname</td>
                    <td>
                        <input type="text" name="nickname" class="w3-input w3-border" value="<?= $printer['nickname'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Printer type</td>
                    <td>
                        <select name="printer_type" class="w3-input w3-border">
                            <?php foreach($printer_types as $key => $value): ?>
                                <option value="<?= $value ?>" <?php if($printer['printer_type']==$value){echo "selected";}?>><?= $value ?></option>
                            <?php endforeach ?> 
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>IP address</td>
                    <td>
                        <input type="text" name="ip_address" class="w3-input w3-border" value="<?= $printer['ip_address'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Host</td>
                    <td>
                        <a href="/fragment/printer/change-host/<?= $printer['id'] ?>" class="w3-button w3-light-gray w3-round w3-block" title="click to change Host">
                            <?php
                                if ($printer['host']=="") {
                                    echo "site not set";
                                } else {
                                    echo $printer['hostname'];
                                }
                            ?>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>Site</td>
                    <td>
                        <a href="/fragment/printer/change-site/<?= $printer['id'] ?>" class="w3-button w3-light-gray w3-round w3-block" title="click to change Site">
                            <?php
                                if ($printer['site_id']=="") {
                                    echo "site not set";
                                } else {
                                    echo $printer['site_id'];
                                }
                            ?>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>Is rental?</td>
                    <td>
                        <span>
                            <input type="radio" name="is_rental" value="0" id="isrental_no" x-model="printer.is_rental" class="w3-radio" <?php if($printer['is_rental']===0){echo "checked";}?>/>
                            <label for="isrental_no">No</label>
                        </span>

                        &nbsp;

                        <span>
                            <input type="radio" name="is_rental" value="1" id="isrental_yes" x-model="printer.is_rental" class="w3-radio" <?php if($printer['is_rental']===1){echo "checked";}?>/>
                            <label for="isrental_yes">Yes</label>
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>Notes</td>
                    <td>
                        <input type="text" name="notes" class="w3-input w3-border" value="<?= $printer['notes'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>created_at</td>
                    <td><?= $printer['created_at'] ?></td>
                </tr>

                <tr>
                    <td>updated_at</td>
                    <td><?= $printer['updated_at'] ?></td>
                </tr>

                <tr>
                    <td>deleted_at</td>
                    <td><?= $printer['deleted_at'] ?></td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="2">
                        <a href="/fragment/printer/delete/<?= $printer['id'] ?>" class="w3-button w3-text-red w3-round">delete</a>
                        <a href="/fragment/printer/" class="w3-button w3-red w3-round">cancel</a>
                        <button type="submit" class="w3-button w3-asphalt w3-round">update</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div class="spacer-large">
</div>