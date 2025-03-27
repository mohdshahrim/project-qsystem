<main>
    <h2>Update Office</h2>

    <form method="post" action="/fragment/office/update">
        <table>
            <tr>
                <td>id</td>
                <td>
                    <?= $office['id']?>
                    <input type="hidden" name="id" value="<?= $office['id']?>"/>
                    <input type="hidden" name="returnlink" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
                </td>
            </tr>

            <tr>
                <td>Office name</td>
                <td>
                    <input type="text" name="office_name" value="<?= $office['office_name'] ?>"/>
                </td>
            </tr>

            <tr>
                <td>Address</td>
                <td>
                    <textarea name="address" rows="5"><?= $office['address'] ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Manager/EIC/OIC</td>
                <td>
                    <input type="text" name="manager" value="<?= $office['manager'] ?>"/>
                </td>
            </tr>

            <tr>
                <td>Total employee</td>
                <td>
                    <input type="text" name="total_employee" value="<?= $office['total_employee'] ?>"/>
                </td>
            </tr>

            <tr>
                <td>Office type</td>
                <td>
                    <input type="text" name="office_type" value="<?= $office['office_type'] ?>"/>
                </td>
            </tr>
        </table>

        <br>
        <a href="/fragment/office/">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
</main>