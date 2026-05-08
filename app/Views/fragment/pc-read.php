<div class="w3-container">
    <h1>PC #<?= $pc['id'] ?></h1>

    <br>

    <div class="w3-half">
        <table>
            <colgroup>
                <col width="150px"></col>
                <col></col>
            </colgroup>
            <tr>
                <td>Hostname</td>
                <td>
                    <?= $pc['hostname'] ?>
                </td>
            </tr>

            <tr>
                <td>Asset No.</td>
                <td>
                    <?= $pc['asset_no'] ?>
                </td>
            </tr>

            <tr>
                <td>Serial No.</td>
                <td>
                    <?= $pc['serial_no'] ?>
                </td>
            </tr>

            <tr>
                <td>Model</td>
                <td>
                    <?= $pc['model'] ?>
                </td>
            </tr>

            <tr>
                <td>OS</td>
                <td>
                    <?= $pc['os'] ?>
                </td>
            </tr>

            <tr>
                <td>IP address</td>
                <td>
                    <?= $pc['ip_address'] ?>
                </td>
            </tr>


            <tr>
                <td>Computer type</td>
                <td>
                    <?= $pc['computer_type'] ?>
                </td>
            </tr>

            <tr>
                <td>Assigned user</td>
                <td>
                    <?= $pc['assigned_user'] ?>
                </td>
            </tr>


            <tr>
                <td>Site</td>
                <td>
                    <?= $pc['site'] ?>
                </td>
            </tr>

            <tr>
                <td>Physical location</td>
                <td>
                    <?= $pc['physical_location'] ?>
                </td>
            </tr>

            <tr>
                <td>created_at</td>
                <td><?= $pc['created_at'] ?></td>
            </tr>

            <tr>
                <td>updated_at</td>
                <td><?= $pc['updated_at'] ?></td>
            </tr>

            <tr>
                <td>deleted_at</td>
                <td><?= $pc['deleted_at'] ?></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td colspan="2">
                    <span style="display:inline-block;">
                        <form action="/fragment/pc/delete" method="post">
                            <input type="hidden" name="id" value="<?= $pc['id'] ?>"></input>
                            <button type="submit" class="w3-button w3-text-red w3-round">delete</button>
                        </form>
                    </span>
                    <a href="/fragment/pc" class="w3-button w3-red w3-round">cancel</a>
                    <a href="/fragment/pc/edit/<?= $pc['id'] ?>" class="w3-button w3-asphalt w3-round">edit</a>
                </td>
            </tr>
        </table>
    </div>

    <div class="w3-half">
        
    </div>
</div>