<div class="w3-container">
    <h1>Monitor #<?= $monitor['id'] ?></h1>

    <br>

    <div class="w3-third">
        <table>
            <colgroup>
                <col width="150px"></col>
                <col></col>
            </colgroup>
            <tr>
                <td>Asset no</td>
                <td>
                    <input type="text" name="asset_no" class="w3-input w3-border" value="<?= $monitor['asset_no'] ?>"></input>
                </td>
            </tr>

            <tr>
                <td>Serial No.</td>
                <td>
                    <input type="text" name="serial_no" class="w3-input w3-border" value="<?= $monitor['serial_no'] ?>"></input>
                </td>
            </tr>

            <tr>
                <td>Model</td>
                <td>
                    <input type="text" name="model" class="w3-input w3-border" value="<?= $monitor['model'] ?>"></input>
                </td>
            </tr>

            <tr>
                <td>Screen size</td>
                <td>
                    <input type="text" name="screen_size" class="w3-input w3-border" value="<?= $monitor['screen_size'] ?>"></input>
                </td>
            </tr>

            <tr>
                <td>
                    Site
                </td>
                <td>
                    <a href="/fragment/monitor/change-site/<?= $monitor['id'] ?>" class="w3-button w3-light-gray w3-round w3-block" title="click to change Site">
                        <?php
                            if ($monitor['site_id']=="") {
                                echo "site not set";
                            } else {
                                echo $monitor['site_id'];
                            }
                        ?>
                    </a>
                </td>
            </tr>

            <tr>
                <td>
                    Host
                </td>
                <td>
                    <a href="/fragment/monitor/change-host/<?= $monitor['id'] ?>" class="w3-button w3-light-gray w3-round w3-block" title="click to change Host"><?= $monitor['hostname'] ?>
                    <?php
                            if ($monitor['host']=="") {
                                echo "host not set";
                            } else {
                                echo $monitor['host'];
                            }
                        ?>
                    </a>
                </td>
            </tr>

            <tr>
                <td>created_at</td>
                <td><?= $monitor['created_at'] ?></td>
            </tr>

            <tr>
                <td>updated_at</td>
                <td><?= $monitor['updated_at'] ?></td>
            </tr>

            <tr>
                <td>deleted_at</td>
                <td><?= $monitor['deleted_at'] ?></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td colspan="2">
                    <a href="/fragment/monitor/<?= $monitor['id'] ?>" class="w3-button w3-text-red w3-round">cancel</a>
                    <a href="/fragment/monitor/edit/<?= $monitor['id'] ?>" class="w3-button w3-asphalt w3-round">okay</a>
                </td>
            </tr>
        </table>
    </div>

    <div class="w3-half">
        
    </div>
</div>