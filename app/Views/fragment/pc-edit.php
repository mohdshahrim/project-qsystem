<main>
    <h2>Update PC</h2>

    <form method="post" action="/fragment/pc/update">
        <table>
            <tr>
                <td>id</td>
                <td>
                    <?= $pc['id']?>
                    <input type="hidden" name="id" value="<?= $pc['id']?>"/>
                    <input type="hidden" name="returnlink" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
                </td>
            </tr>

            <!-- hostname -->
            <tr>
                <td>hostname</td>
                <td>
                    <input type="text" name="hostname" value="<?= $pc['hostname'] ?>"/>
                </td>
            </tr>

            <!-- ip address -->
            <tr>
                <td>ip address</td>
                <td>
                    <input type="text" name="ip_address" value="<?= $pc['ip_address'] ?>"/>
                </td>
            </tr>

            <!-- os -->
            <tr>
                <td>os</td>
                <td>
                    <input type="text" name="os" value="<?= $pc['os'] ?>"/>
                </td>
            </tr>

            <!-- cpu model -->
            <tr>
                <td>cpu model</td>
                <td>
                    <input type="text" name="cpu_model" value="<?= $pc['cpu_model'] ?>"/>
                </td>
            </tr>

            <!-- cpu no -->
            <tr>
                <td>cpu no</td>
                <td>
                    <input type="text" name="cpu_no" value="<?= $pc['cpu_no'] ?>"/>
                </td>
            </tr>

            <!-- monitor model -->
            <tr>
                <td>monitor model</td>
                <td>
                    <input type="text" name="monitor_model" value="<?= $pc['monitor_model'] ?>"/>
                </td>
            </tr>

            <!-- monitor no -->
            <tr>
                <td>monitor no</td>
                <td>
                    <input type="text" name="monitor_no" value="<?= $pc['monitor_no'] ?>"/>
                </td>
            </tr>

            <!-- hosted devices -->
            <tr>
                <td>hosted devices</td>
                <td>
                    <!-- for devices hosted on this PC -->
                    <?php foreach ($hosted as $row):?>
                        <input type="checkbox" id="<?= $row['id'] ?>" name="hosted_devices" value="<?= $row['id'] ?>" checked>
                        <label for="<?= $row['id'] ?>"><?= $row['model'] ?> (<?= $row['serial_no'] ?>)</label><br>
                    <?php endforeach ?>
                    <!-- for devices without host -->
                    <?php foreach ($device as $row):?>
                        <input type="checkbox" id="<?= $row['id'] ?>" name="hosted_devices" value="<?= $row['id'] ?>">
                        <label for="<?= $row['id'] ?>"><?= $row['model'] ?> (<?= $row['serial_no'] ?>)</label><br>
                    <?php endforeach ?>
                </td>
            </tr>

            <!-- user -->
            <tr>
                <td>user</td>
                <td>
                    <input type="text" name="user" value="<?= $pc['user'] ?>"/>
                </td>
            </tr>

            <!-- department -->
            <tr>
                <td>department</td>
                <td>
                    <input type="text" name="department" value="<?= $pc['department'] ?>"/>
                </td>
            </tr>

            <!-- notes -->
            <tr>
                <td>notes</td>
                <td>
                    <input type="text" name="notes" value="<?= $pc['notes'] ?>"/>
                </td>
            </tr>

            <!-- office -->
            <tr>
                <td>office</td>
                <td style="position: relative;">
                    <?= $pc['office'] ?>
                    <input type="hidden" name="office" value="<?= $pc['office'] ?>">
                    <button style="" type="button" id="button-changeoffice" onclick="toggleChangeOffice()">change</button>
                    <div id="div-changeoffice" style="display:none;">
                        <p>
                            <a href="/fragment/pc/x-transfer/<?= $pc['id'] ?>/sibu">sibu</a>
                            &nbsp;
                            <a href="/fragment/pc/x-transfer/<?= $pc['id'] ?>/kapit">kapit</a>
                            &nbsp;
                            <a href="/fragment/pc/x-transfer/<?= $pc['id'] ?>/sarikei">sarikei</a>
                            &nbsp;
                            <a href="/fragment/pc/x-transfer/<?= $pc['id'] ?>/tgmanis">tgmanis</a>
                        </p>
                        <p style="font-size:small">changing office will drop all unsaved inputs & all its current hosted devices</p>
                    </div>
                </td>
            </tr>
        </table>

        <br>
        <a href="/fragment/pc/">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
    
</main>

<script>
function toggleChangeOffice() {
    if (document.getElementById('div-changeoffice').style.display=="block") {
        document.getElementById('button-changeoffice').innerHTML = "change";
        document.getElementById('div-changeoffice').style.display='none';
    } else {
        document.getElementById('button-changeoffice').innerHTML = "cancel";
        document.getElementById('div-changeoffice').style.display='block';
    }
}
</script>