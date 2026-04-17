<div class="w3-container">
    <h1>Monitor #<?= $monitor['id'] ?></h1>

    <br>

    <div class="w3-half">
        <table>
            <colgroup>
                <col width="150px"></col>
                <col></col>
            </colgroup>
            <tr>
                <td>Asset no</td>
                <td>
                    <?= $monitor['asset_no'] ?>
                </td>
            </tr>

            <tr>
                <td>Serial No.</td>
                <td>
                    <?= $monitor['serial_no'] ?>
                </td>
            </tr>

            <tr>
                <td>Model</td>
                <td>
                    <?= $monitor['model'] ?>
                </td>
            </tr>

            <tr>
                <td>Screen size</td>
                <td>
                    <?= $monitor['screen_size'] ?>
                </td>
            </tr>

            <tr>
                <td>Site</td>
                <td>
                    <?= $monitor['site_id'] ?>
                </td>
            </tr>

            <tr>
                <td>Host</td>
                <td>
                    <?= $monitor['hostname'] ?>
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
                    <span style="display:inline-block;">
                        <form action="/fragment/monitor/delete" method="post">
                            <input type="hidden" name="id" value="<?= $monitor['id'] ?>"></input>
                            <button type="submit" class="w3-button w3-text-red w3-round">delete</button>
                        </form>
                    </span>
                    <a href="/fragment/monitor" class="w3-button w3-red w3-round">cancel</a>
                    <a href="/fragment/monitor/edit/<?= $monitor['id'] ?>" class="w3-button w3-asphalt w3-round">edit</a>
                </td>
            </tr>
        </table>
    </div>

    <div class="w3-half">
        
    </div>
</div>