<div class="w3-container">
    <h1>Designations</h1>

    <div>
        <form action="/fragment/designation/create" method="post">
            <input type="text" name="designation_name" class="w3-input w3-border w3-round w3-quarter"></input>
            <button type="submit" class="w3-button w3-asphalt w3-round">Add designation</button>
        </form>
    </div>

    <br>

    <div class="w3-twothird">
        <table class="w3-table w3-white w3-border w3-bordered w3-hoverable">
            <colgroup>
                <col width="2em">
                <col>
                <col width="150px">
            </colgroup>
            <tr>
                <td class="">no.</td>
                <td class="">designation</td>
                <td class="w3-center">options</td>
            </tr>
            <?php foreach ($designations as $key=>$row): ?>
                <tr class="w3-small">
                    <form action="/fragment/designation/update" method="post">
                        <td class="w3-center" style="vertical-align: middle;"><?= ($key+1) ?></td>
                        <td class="">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>"></input>
                            <input type="text" name="designation_name" value="<?= $row['designation_name'] ?>" class="w3-input w3-border"></input>
                        </td>
                        <td class="w3-center">
                            <button type="submit" class="w3-button">save</button>
                    </form>
                    <form action="/fragment/designation/delete" method="post" style="display: inline-block;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>"></input>
                            <button type="submit" class="w3-button">delete</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>