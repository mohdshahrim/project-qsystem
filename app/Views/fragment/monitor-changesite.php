<div class="w3-container">
    <h1>Monitor Edit: Change Site</h1>

    <form action="/fragment/monitor/change-site/submit" method="post">
        <table class="w3-third">
            <tr>
                <td>ID</td>
                <td>
                    <?= $monitor['id'] ?>
                </td>
            </tr>        
            <tr>
                <td>Asset No</td>
                <td>
                    <?= $monitor['asset_no'] ?>
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
                        <input type="radio" name="site" value="<?= $row['id'] ?>" id="site_<?= $row['id'] ?>" <?php if ($row['id']==$monitor['site']) {echo "disabled";} ?>/>
                        <label for="site_<?= $row['id'] ?>"><?= $row['site_name'] ?> <?php if ($row['id']==$monitor['site']) {echo "(current)";} ?></label>
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
                    <a href="/fragment/monitor/edit/<?= $monitor['id'] ?>" class="w3-button w3-red w3-round">cancel</a>
                    <input type="hidden" name="id" value="<?= $monitor['id'] ?>" />
                    <button type="submit" id="button-submit" class="w3-button w3-asphalt w3-round" disabled>okay</button>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <p class="w3-small">changing site of a "hosted" monitor will unhost the monitor</p>
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