<div class="w3-container">
    <h1>Monitor #<?= $monitor['id'] ?></h1>

    <br>

    <table>
        <colgroup>
            <col width="150px"></col>
            <col></col>
        </colgroup>
        <tr>
            <td>Asset no</td>
            <td><?= $monitor['asset_no'] ?></td>
        </tr>

        <tr>
            <td>Serial No.</td>
            <td><?= $monitor['serial_no'] ?></td>
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
            <td>
                <span class="w3-left">
                    <form action="/fragment/monitor/delete" method="post">
                        <input type="hidden" name="id" value="<?= $monitor['id'] ?>"></input>
                        <button type="submit" class="w3-button w3-red w3-round">delete</button>
                    </form>
                </span>
            </td>
            <td>
                <span class="w3-right">
                    <a href="/fragment/monitor">cancel</a>
                    &nbsp;
                    <a href="/fragment/monitor/edit/<?= $monitor['id'] ?>" class="w3-button w3-asphalt w3-round">Edit</a>
                </span>
            </td>
        </tr>
    </table>
</div>