<style>
    .table-form {
        border-collapse: collapse;
        table-layout: fixed;
    }
    .table-form tr th,td {
        padding: 0.2em;
    }
    .table-form tr:hover {
        background-color: lightgray;
    }
</style>
<main>
    <div>
        <h2 style="display:inline-block;margin-right:1.5em;">PC (<a href="/fragment/pc/edit/<?= $pc['id']?>">edit</a>)</h2>
        <p style="display:inline-block;font-size:small;">
            <a href="/fragment/pc?office=<?= $pc['office']?>">PC (<?= $pc['office']?>)</a>
            <a href="/fragment/pc/">PC (all)</a>
        </p>
    </div>

    <div style="display:inline-block;">
        <form method="post" action="/fragment/pc/update">
            <table class="table-form">
                <tr>
                    <td>id</td>
                    <td>
                        <?= $pc['id']?>
                    </td>
                </tr>

                <!-- hostname -->
                <tr>
                    <td>hostname</td>
                    <td>
                        <?= $pc['hostname']?>
                    </td>
                </tr>

                <!-- ip address -->
                <tr>
                    <td>ip address</td>
                    <td>
                        <?= $pc['ip_address']?>
                    </td>
                </tr>

                <!-- os -->
                <tr>
                    <td>os</td>
                    <td>
                        <?= $pc['os']?>
                    </td>
                </tr>

                <!-- type -->
                <tr>
                    <td>type</td>
                    <td>
                        <?= $pc['type']?>
                    </td>
                </tr>

                <!-- cpu model -->
                <tr>
                    <td>cpu model</td>
                    <td>
                        <?= $pc['cpu_model']?>
                    </td>
                </tr>

                <!-- cpu no -->
                <tr>
                    <td>cpu no</td>
                    <td>
                        <?= $pc['cpu_no']?>
                    </td>
                </tr>

                <!-- monitor model -->
                <tr>
                    <td>monitor model</td>
                    <td>
                        <?= $pc['monitor_model']?>
                    </td>
                </tr>

                <!-- monitor no -->
                <tr>
                    <td>monitor no</td>
                    <td>
                        <?= $pc['monitor_no']?>
                    </td>
                </tr>

                <!-- hosted devices -->
                <tr>
                    <td>hosted devices</td>
                    <td>
                        <?= $pc['hosted_devices']?>
                    </td>
                </tr>

                <!-- user -->
                <tr>
                    <td>user</td>
                    <td>
                        <?= $pc['user']?>
                    </td>
                </tr>

                <!-- department -->
                <tr>
                    <td>department</td>
                    <td>
                        <?= $pc['department']?>
                    </td>
                </tr>

                <!-- notes -->
                <tr>
                    <td>notes</td>
                    <td>
                        <?= $pc['notes']?>
                    </td>
                </tr>

                <!-- office -->
                <tr>
                    <td>office</td>
                    <td>
                        <?= $pc['office']?>
                    </td>
                </tr>

                <!-- created_at -->
                <tr>
                    <td>created_at</td>
                    <td>
                        <?= $pc['created_at']?>
                    </td>
                </tr>

                <!-- updated_at -->
                <tr>
                    <td>updated_at</td>
                    <td>
                        <?= $pc['updated_at']?>
                    </td>
                </tr>

                <!-- deleted_at -->
                <tr>
                    <td>deleted_at</td>
                    <td>
                        <?= $pc['deleted_at']?>
                    </td>
                </tr>
            </table>
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
        <?php if (isset($pics[0])): ?>
            <div class="pic-box">
                <img width="250" src="/uploads/fragment/<?= $pics[0]['file_name']?>"/>
                <div class="pic-desc">
                    <?= $pics[0]['file_name'] ?>
                </div>
            </div>
        <?php endif ?>
    </div>

    <div class="spacer"></div>

    <form method="post" action="/fragment/pc/delete">
        <p style="color:red;">CAREFUL. This cannot be reversed.</p>
        <input type="hidden" name="id" value="<?= $pc['id'] ?>"/>
        <button type="submit">Delete permanently</button>
    </form>
</main>