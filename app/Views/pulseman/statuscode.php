<div class="w3-container">
    <h1>Status Codes</h1>

    <br>

    <div class="w3-twothird">
        <table class="w3-table w3-white w3-border w3-bordered w3-hoverable">
            <colgroup>
                <col>
                <col>
                <col>
            </colgroup>
            <tr>
                <td class="">no.</td>
                <td class="">status code</td>
                <td class="w3-center">description</td>
            </tr>
            <?php foreach ($statuscodes as $key=>$row): ?>
                <tr class="w3-small">
                    <td><?= $row[0] ?></td>
                    <td><?= $row[1] ?></td>
                    <td><?= $row[2] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>