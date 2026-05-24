<?php
    $session = session();
    if ($session->getFlashData('message')) {
        $message = $session->getFlashData('message');
        echo "<div style=\"width:auto; height:auto; position:absolute; top:2em; place-self:center;\" class=\"w3-yellow w3-padding w3-round\">";
        echo $message;
        echo "</div>";
    }
?>

<div class="w3-container">
    <h1>PC #<?= $pc['id'] ?></h1>

    <br>

    <div class="w3-third">
        <form action="/fragment/pc/update" method="post">
            <table>
                <colgroup>
                    <col width="150px"></col>
                    <col></col>
                </colgroup>
                <tr>
                    <td>Hostname</td>
                    <td>
                        <input type="hidden" name="id" value="<?= $pc['id'] ?>" />
                        <input type="text" name="hostname" class="w3-input w3-border" value="<?= $pc['hostname'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Asset no</td>
                    <td>
                        <input type="text" name="asset_no" class="w3-input w3-border" value="<?= $pc['asset_no'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Serial No.</td>
                    <td>
                        <input type="text" name="serial_no" class="w3-input w3-border" value="<?= $pc['serial_no'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Model</td>
                    <td>
                        <input type="text" name="model" class="w3-input w3-border" value="<?= $pc['model'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>OS</td>
                    <td>
                        <input type="text" name="os" class="w3-input w3-border" value="<?= $pc['os'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>IP address</td>
                    <td>
                        <input type="text" name="ip_address" class="w3-input w3-border" value="<?= $pc['ip_address'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>computer type</td>
                    <td>
                        <input type="text" name="computer_type" class="w3-input w3-border" value="<?= $pc['computer_type'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Assigned user</td>
                    <td>
                        <a href="/fragment/pc/change-user/<?= $pc['id'] ?>" class="w3-button w3-light-gray w3-round w3-block" title="click to assign or change users">
                            <?php
                                if ($pc['assigned_user']=="") {
                                    echo "user not assigned";
                                } else {
                                    echo $pc['assigned_user'];
                                }
                            ?>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>Site</td>
                    <td>
                        <a href="/fragment/pc/change-site/<?= $pc['id'] ?>" class="w3-button w3-light-gray w3-round w3-block" title="click to change Site">
                            <?php
                                if ($pc['site_id']=="") {
                                    echo "site not set";
                                } else {
                                    echo $pc['site_id'];
                                }
                            ?>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>Physical location</td>
                    <td>
                        <input type="text" name="physical_location" class="w3-input w3-border" value="<?= $pc['physical_location'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Notes</td>
                    <td>
                        <input type="text" name="notes" class="w3-input w3-border" value="<?= $pc['notes'] ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>created_at</td>
                    <td><?= $pc['created_at'] ?></td>
                </tr>

                <tr>
                    <td>updated_at</td>
                    <td><?= $pc['updated_at'] ?></td>
                </tr>

                <tr>
                    <td>deleted_at</td>
                    <td><?= $pc['deleted_at'] ?></td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="2">
                        <a href="/fragment/pc/delete/<?= $pc['id'] ?>" class="w3-button w3-text-red w3-round">delete</a>
                        <a href="/fragment/pc/" class="w3-button w3-red w3-round">cancel</a>
                        <button type="submit" class="w3-button w3-asphalt w3-round">update</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div class="w3-third"
        x-data="{
            uploadImage(input){
                const file = input.files[0];

                const formData = new FormData();
                formData.append('file', file);
                formData.append('id', <?= $pc['id'] ?>);

                fetch('/fragment/pc/img/create', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(()=>{
                        window.location.reload();
                    })
            },
            deleteImage(imgid) {
                minAjax({
                    url: '/fragment/pc/img/delete',
                    type: 'POST',
                    data: {
                        imgid: imgid,
                    },
                    success: (response) => {
                        window.location.reload();
                    }
                });
            },
        }">
        <style>
            .hidden{display:none;}
        </style>
        <input type="file" x-ref="pcimg" class="hidden" x-on:change="uploadImage($refs.pcimg)">

        <table>
            <?php for($i=0; $i<2; $i++): ?>
                <tr>
                    <td class="position-relative">
                        <span style="top:0;right:0;" class="position-absolute">
                            <?php if (isset($pcimg[$i]['file_path'])) {echo "<button x-on:click=\"deleteImage(".$pcimg[$i]['id'].")\" class=\"w3-button w3-red w3-round\"><i class=\"fa fa-close\"></i></button>";} else {echo "<button x-on:click=\"\$refs.pcimg.click()\" class=\"w3-button w3-asphalt w3-round\">+</button>";} ?>
                        </span>
                        <img src="<?php if (isset($pcimg[$i]['file_path'])) {echo "/uploads/fragment_pcimg/".$pcimg[$i]['file_path'];} else {echo "/img/600x400.png";} ?>" class="w3-image"></img>
                    </td>
                </tr>
            <?php endfor ?>
        </table>
    </div>
</div>