<main>
    <h2>Update Device</h2>

    <form method="post" action="/fragment/device/update">
        <table>
            <tr>
                <td>id</td>
                <td>
                    <?= $device['id']?>
                    <input type="hidden" name="id" value="<?= $device['id']?>"/>
                    <input type="hidden" name="returnlink" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
                </td>
            </tr>

            <!-- type -->
            <tr>
                <td>type</td>
                <td>
                    <input type="text" name="type" value="<?= $device['type'] ?>"/>
                </td>
            </tr>

            <!-- serial no -->
            <tr>
                <td>serial no</td>
                <td>
                    <input type="text" name="serial_no" value="<?= $device['serial_no'] ?>"/>
                </td>
            </tr>

            <!-- model -->
            <tr>
                <td>model</td>
                <td>
                    <input type="text" name="model" value="<?= $device['model'] ?>"/>
                </td>
            </tr>

            <!-- date received -->
            <tr>
                <td>date received</td>
                <td>
                    <input type="text" name="date_received" value="<?= $device['date_received'] ?>"/>
                </td>
            </tr>

            <!-- office -->
            <tr>
                <td>office</td>
                <td>
                    <input type="text" name="office" value="<?= $device['office'] ?>"/>
                </td>
            </tr>

            <!-- current location -->
            <tr>
                <td>current location</td>
                <td>
                    <input type="text" name="current_location" value="<?= $device['current_location'] ?>"/>
                </td>
            </tr>

            <!--status -->
            <tr>
                <td>status</td>
                <td>
                    <input type="text" name="status" value="<?= $device['status'] ?>"/>
                </td>
            </tr>

            <!-- hosted on -->
            <tr>
                <td>hosted on</td>
                <td>
                    <input type="text" name="hosted_on" value="<?= $device['hosted_on'] ?>"/>
                </td>
            </tr>

            <!-- codename -->
            <tr>
                <td>codename</td>
                <td>
                    <input type="text" name="codename" value="<?= $device['codename'] ?>"/>
                </td>
            </tr>

            <!-- notes -->
            <tr>
                <td>notes</td>
                <td>
                    <input type="text" name="user" value="<?= $device['notes'] ?>"/>
                </td>
            </tr>
        </table>

        <br>
        <a href="/fragment/device/">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
    
</main>