<div class="w3-container">
    <h1>PC Edit: Change Site</h1>

    <form action="/fragment/pc/change-site/submit" method="post">
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
                <td colspan="2">Choose Site</td>
            </tr>
            <?php foreach($sites as $key=>$row): ?>
                <tr>
                    <td colspan="2">
                        <input type="radio" name="site" value="<?= $row['id'] ?>" id="site_<?= $row['id'] ?>" <?php if ($row['id']==$pc['site']) {echo "disabled";} ?>/>
                        <label for="site_<?= $row['id'] ?>"><?= $row['site_name'] ?> <?php if ($row['id']==$pc['site']) {echo "(current)";} ?></label>
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
                    <p class="w3-small">changing site of a PC will unhost all its monitor(s)</p>
                </td>
            </tr>
        </table>
    </form>

    <script>
        // assist script to enhance UX on selecting radio inputs
        var inputRadioSites = document.getElementsByName('site');
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