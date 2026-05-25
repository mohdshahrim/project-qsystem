<div class="w3-container">
    <h1>PC Edit: Change User</h1>

    <form action="/fragment/pc/change-user/submit" method="post">
        <table class="w3-third">
            <tr>
                <td>ID</td>
                <td>
                    <?= $pc['id'] ?>
                </td>
            </tr>
            <tr>
                <td>Hostname</td>
                <td>
                    <?= $pc['hostname'] ?>
                </td>
            </tr>
            <tr>
                <td>Asset No</td>
                <td>
                    <?= $pc['asset_no'] ?>
                </td>
            </tr>

            <!-- SPACE -->
            <tr>
                <td colspan="2">
                    &nbsp;
                </td>
            </tr>

            <tr>
                <td colspan="2">Choose User</td>
            </tr>
            <?php foreach($users as $key=>$row): ?>
                <tr>
                    <td colspan="2">
                        <input type="radio" name="user" value="<?= $row['id'] ?>" id="user_<?= $row['id'] ?>" <?php if ($row['id']==$pc['assigned_user']) {echo "disabled";} ?>/>
                        <label for="user_<?= $row['id'] ?>"><?= $row['fullname'] ?> <?php if ($row['id']==$pc['assigned_user']) {echo "(current)";} ?></label>
                    </td>
                </tr>
            <?php endforeach ?>

            <!-- SPACE -->
            <tr>
                <td colspan="2">
                    &nbsp;
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <a href="/fragment/pc/<?= $pc['id'] ?>" class="w3-button w3-red w3-round">cancel</a>
                    <input type="hidden" name="id" value="<?= $pc['id'] ?>" />
                    <button type="submit" id="button-submit" class="w3-button w3-asphalt w3-round" disabled>okay</button>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <p class="w3-small">only users from the site <?= $pc['site_id'] ?> are shown here</p>
                </td>
            </tr>
        </table>
    </form>

    <script>
        // assist script to enhance UX on selecting radio inputs
        var inputRadioSites = document.getElementsByName('user');
        const buttonSubmit = document.getElementById('button-submit');

        inputRadioSites.forEach(
            function (currentValue, currentIndex) {
                //console.log(`${currentValue} ${currentIndex}`);
                currentValue.addEventListener('change',
                    ()=>{
                        buttonSubmit.disabled=false;
                    }
                );
            }
        );
    </script>
</div>