<div class="w3-container">
    <h1>Printer Edit: Change Site</h1>

    <form action="/fragment/printer/change-site/submit" method="post">
        <table class="w3-third">
            <tr>
                <td>ID</td>
                <td>
                    <?= $printer['id'] ?>
                </td>
            </tr>        
            <tr>
                <td>Model</td>
                <td>
                    <?= $printer['model'] ?>
                </td>
            </tr>
            <tr>
                <td>Serial No</td>
                <td>
                    <?= $printer['serial_no'] ?>
                </td>
            </tr>
            <tr>
                <td>Nickname</td>
                <td>
                    <?= $printer['nickname'] ?>
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
                        <input type="radio" name="site" value="<?= $row['id'] ?>" id="site_<?= $row['id'] ?>" <?php if ($printer['site']==$row['id']) {echo "disabled";} ?>/>
                        <label for="site_<?= $row['id'] ?>"><?= $row['site_id'] ?> <?php if ($printer['site']==$row['id']) {echo "(current)";} ?></label>
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
                    <a href="/fragment/printer/<?= $printer['id'] ?>" class="w3-button w3-red w3-round">cancel</a>
                    <input type="hidden" name="id" value="<?= $printer['id'] ?>" />
                    <button type="submit" id="button-submit" class="w3-button w3-asphalt w3-round" disabled>okay</button>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <p class="w3-small"></p>
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