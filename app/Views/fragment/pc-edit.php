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
                    <input type="text" name="hosted_devices" value="<?= $pc['hosted_devices'] ?>"/>
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
                <td>
                    <input type="text" name="office" value="<?= $pc['office'] ?>"/>
                </td>
            </tr>
        </table>

        <br>
        <a href="/fragment/pc/">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
    
</main>