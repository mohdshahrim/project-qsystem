<main>
    <h2>Update PC (<a href="/fragment/pc/view/<?= $pc['id']?>">view</a>)</h2>

    <div style="display:inline-block;">
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

            <!-- type -->
            <tr>
                <td>type</td>
                <td>
                    <input type="text" name="type" value="<?= $pc['type'] ?>"/>
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
                        <input type="checkbox" id="<?= $row['id'] ?>" name="hosted_devices[]" value="<?= $row['id'] ?>" checked>
                        <label for="<?= $row['id'] ?>"><?= $row['model'] ?> (<?= $row['serial_no'] ?>)</label><br>
                    <?php endforeach ?>
                    <!-- for devices without host -->
                    <?php foreach ($device as $row):?>
                        <input type="checkbox" id="<?= $row['id'] ?>" name="hosted_devices[]" value="<?= $row['id'] ?>">
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
                    <button type="button" id="button-changeoffice" onclick="toggleChangeOffice()">change</button>
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
        <button type="submit">Okay</button>
        <p><a href="/fragment/pc?office=<?= $pc['office']?>">go back to PC (<?= $pc['office']?>)</a></p>
        <p><a href="/fragment/pc/">go back to PC (all)</a></p>
    </form>
    </div>

    <style>
        .pic-container {
            display:inline-block;
            vertical-align:top;
            padding-left:2em;
            position:relative;
            width:300px;
        }
        .pic-box {
            background-color: none;
        }
        .pic-desc {
            margin-bottom:30px;
        }
        .pic-delete {
            float:right;
        }
    </style>
    <div class="pic-container">
        <p>PC pictures</p>
        <?php helper('form'); ?>
        <?php if (!isset($pics[1])): ?>
            <?= form_open_multipart("/fragment/pc/picture/create") ?>
                <input type="hidden" name="id" value="<?= $pc['id'] ?>"/>
                <p><input type="file" name="pcpic"/></p>
                <p><button type="submit">Add</button></p>
            </form>
        <?php endif ?>
        
        <?php if (isset($pics[0])): ?>
            <div class="pic-box" style="position:relative;">
                <div style="position:absolute;top:0;">
                    <form method="post" action="/fragment/pc/picture/delete">
                        <input name="id" value="<?= $pics[0]['id'] ?>" type="hidden" />
                        <input name="pcid" value="<?= $pc['id'] ?>" type="hidden" />
                        <button type="submit">delete</button>
                    </form>
                </div>
                <img style="border:1px solid black;" width="250" src="/uploads/fragment/<?= $pics[0]['file_name']?>"/>
                <div class="pic-desc">
                    <?= $pics[0]['file_name'] ?>
                </div>
            </div>
        <?php endif ?>

        <?php if (isset($pics[1])): ?>
            <div class="pic-box" style="position:relative;">
                <div style="position:absolute;top:0;">
                    <form method="post" action="/fragment/pc/picture/delete">
                        <input name="id" value="<?= $pics[1]['id'] ?>" type="hidden" />
                        <input name="pcid" value="<?= $pc['id'] ?>" type="hidden" />
                        <button type="submit">delete</button>
                    </form>
                </div>
                <img style="border:1px solid black;" width="250" src="/uploads/fragment/<?= $pics[1]['file_name']?>"/>
                <div class="pic-desc">
                    <?= $pics[1]['file_name'] ?>
                </div>
            </div>
        <?php endif ?>
    </div>
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