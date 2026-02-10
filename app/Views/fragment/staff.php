<div class="w3-container">
    <h1>Staffs</h1>

    <br>

    <div>
        <table class="w3-table w3-white w3-border w3-bordered">
            <tr>
                <td>id</td>
                <td>fullname</td>
                <td>site_id</td>
            </tr>
            <?php foreach ($staffs as $key=>$row): ?>
                <tr>
                    <td><?= ($key+1) ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td><?= $row['site_id'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>