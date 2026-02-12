<div class="w3-container">
    <h1>List of PC</h1>

    <div>
        <div class="w3-margin-right" style="display: inline-block;">
            <a href="/fragment/pc/add" class="w3-button w3-asphalt w3-round">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="w3-margin-right" style="display: inline-block;">
            <input class="w3-check" type="checkbox">
            <label>Sibu</label>
        </div>
        <div class="w3-margin-right" style="display: inline-block;">
            <input class="w3-check" type="checkbox">
            <label>Kapit</label>
        </div>
        <div style="display: inline-block;">
            <input class="w3-check" type="checkbox">
            <label>Tg. Manis</label>
        </div>
    </div>

    <br>

    <!-- table -->
    <table class="w3-table w3-white w3-border w3-bordered">
        <tr>
            <td>no</td>
            <td>hostname</td>
            <td>ip address</td>
            <td>asset no</td>
        </tr>
        <?php foreach ($pc as $key=>$row): ?>
            <tr>
                <td><?= ($key+1) ?></td>
                <td><?= $row['hostname'] ?></td>
                <td><?= $row['ip_address'] ?></td>
                <td><?= $row['asset_no'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>