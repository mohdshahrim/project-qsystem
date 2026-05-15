<?php
    $session = session();
    if ($session->getFlashData('message')) {
        $message = $session->getFlashData('message');
        echo "<div style=\"width:auto; height:auto; position:absolute; top:2em; place-self:center;\" class=\"w3-yellow w3-padding w3-round\">";
        echo $message;
        echo "</div>";
    }
?>

<div class="w3-container"
x-data="{
    btn_backup:true,
    btn_restore:<?php if($backup=='exist'){echo 'true';}else{echo 'false';}?>,
    btn_export:true,
    btn_reset:false,
    btn_delete:<?php if($backup=='exist'){echo 'true';}else{echo 'false';}?>,
    backup() {
        minAjax({
            url: `/setting/database/backup`,
            type: 'POST',
            success: () => {
                window.location.reload();
            }
        });
    },
    restore() {
        minAjax({
            url: `/setting/database/restore`,
            type: 'POST',
            success: () => {
                window.location.reload();
            }
        });
    },
    deleteBackup() {
        minAjax({
            url: `/setting/database/delete-backup`,
            type: 'POST',
            success: () => {
                window.location.reload();
            }
        });
    },
}">
    <h1>Database management</h1>
    <br>
    <p>You may backup, restore, export or reset database files here.</p>
    <p>Be careful and please know what you are doing.</p>

    <br>

    <div class="w3-border w3-white w3-padding" style="display:inline-block">
        <table>
            <tr class="w3-center">
                <td>database</td>
                <td></td>
                <td>backup</td>
            </tr>
            <tr>
                <td class="w3-padding" rowspan="3">
                    <?php
                        if ($database=='exist') {
                            echo '
                                <div class="w3-olive w3-border w3-round-large" style="display:grid; place-items:center; height:200px; width:200px;" title="core, fragment">
                                    <span class="w3-center">
                                    <i class="w3-xxxlarge fa fa-database"></i>
                                        <br>
                                        core + fragment
                                    </span>
                                </div>                            
                            ';
                        } else {
                            echo '
                                <div class="w3-white w3-border w3-round-large" style="display:grid; place-items:center; height:200px; width:200px;" title="core, fragment">
                                    <span class="w3-center">
                                        n/a
                                    </span>
                                </div>
                            ';
                        }
                    ?>
                </td>
                <td class="w3-padding">
                    <button class="w3-button w3-red w3-block w3-round" :disabled="!btn_backup" x-on:click="backup()">backup <i class="fa fa-arrow-right"></i></button>
                </td>
                <td class="w3-padding" rowspan="3">
                    <?php
                        if ($backup=='exist') {
                            echo '
                                <div class="w3-olive w3-border w3-round-large" style="display:grid; place-items:center; height:200px; width:200px;" title="core, fragment">
                                    <span class="w3-center">
                                    <i class="w3-xxxlarge fa fa-database"></i>
                                        <br>
                                        core + fragment
                                    </span>
                                </div>                            
                            ';
                        } else {
                            echo '
                                <div class="w3-white w3-border w3-round-large" style="display:grid; place-items:center; height:200px; width:200px;" title="core, fragment">
                                    <span class="w3-center">
                                        n/a
                                    </span>
                                </div>
                            ';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="w3-padding">
                    <button class="w3-button w3-red w3-block w3-round" :disabled="!btn_restore" x-on:click="restore()">restore  <i class="fa fa-arrow-left"></i></button>
                </td>
            </tr>
            <tr>
                <td class="w3-padding">
                    <a href="/setting/database/export" class="w3-button w3-red w3-block w3-round" :disabled="!btn_export">export  <i class="fa fa-download"></i></a>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <button class="w3-button w3-red w3-block w3-round" :disabled="!btn_reset">reset database <i class="fa fa-refresh"></i></button>
                </td>
                <td></td>
                <td><button class="w3-button w3-red w3-block w3-round" :disabled="!btn_delete" x-on:click="deleteBackup()">delete backup <i class="fa fa-trash-o"></i></button></td>
            </tr>
        </table>
    </div>
</div>