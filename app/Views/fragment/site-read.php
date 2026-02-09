<div class="w3-container">
    <h1>Site #<?= $site['id'] ?></h1>

    <br>

    <table>
        <tr>
            <td>Site ID / Code</td>
            <td><?= $site['site_id'] ?></td>
        </tr>

        <tr>
            <td>Site Name</td>
            <td><?= $site['site_name'] ?></td>
        </tr>

        <tr>
            <td>Site Type</td>
            <td>
                <?= $sitetype[$site['site_type']] ?>
            </td>
        </tr>

        <tr>
            <td>Address</td>
            <td><?= $site['address'] ?></td>
        </tr>

        <tr>
            <td>City / Division</td>
            <td>
                <?= $city[$site['city']] ?>
            </td>
        </tr>

        <tr>
            <td>Manager / EIC / OIC</td>
            <td></td>
        </tr>

        <tr>
            <td>created_at</td>
            <td><?= $site['created_at'] ?></td>
        </tr>

        <tr>
            <td>updated_at</td>
            <td><?= $site['updated_at'] ?></td>
        </tr>

        <tr>
            <td>deleted_at</td>
            <td><?= $site['deleted_at'] ?></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td>
                <span class="w3-left">
                    <a href="/fragment/site/delete" class="w3-button w3-red w3-round">delete</a>
                </span>
            </td>
            <td>
                <span class="w3-right">
                    <a href="/fragment/site">cancel</a>
                    &nbsp;
                    <a href="/fragment/site/edit/<?= $site['id'] ?>" class="w3-button w3-asphalt w3-round">Edit</a>
                </span>
            </td>
        </tr>
    </table>
</div>