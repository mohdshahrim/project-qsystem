<div class="w3-container">
    <h1>Edit Site</h1>

    <br>

    <div>
        <form action="/fragment/site/update" method="post">
            <table>
                <!-- SITE ID -->
                <tr>
                    <td>
                        <label class="w3-label">Site ID / Code</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="hidden" name="id" value="<?= $site['id'] ?>"></input>
                        <input type="text" name="site_id" value="<?= $site['site_id'] ?>" class="w3-input w3-border"></input>
                        <span class="w3-text-red position-absolute right-0 top--10px font-size-2rem">*</span>
                    </td>
                </tr>

                <!-- SITE NAME -->
                <tr>
                    <td>
                        <label class="w3-label">Site Name</label>
                        &nbsp;
                    </td>
                    <td>
                        <input type="text" name="site_name" value="<?= $site['site_name'] ?>" class="w3-input w3-border"></input>
                    </td>
                </tr>

                <!-- SITE TYPE -->
                <tr>
                    <td>
                        <label class="w3-label">Site Type</label>
                        &nbsp;
                    </td>
                    <td>
                        <select name="site_type" class="w3-input w3-border">
                            <option value="2" <?php if($site['site_type']==2){echo "selected";}?>>Regional Office</option>
                            <option value="3" <?php if($site['site_type']==3){echo "selected";}?>>Sub-regional Office</option>
                            <option value="1" <?php if($site['site_type']==1){echo "selected";}?>>HQ</option>
                        </select>
                    </td>
                </tr>

                <!-- ADDRESS -->
                <tr>
                    <td>
                        <label class="w3-label">Address</label>
                        &nbsp;
                    </td>
                    <td>
                        <input type="text" name="address" value="<?= $site['address']?>" class="w3-input w3-border"></input>
                    </td>
                </tr>

                <!-- CITY -->
                <tr>
                    <td>
                        <label class="w3-label">City / Division</label>
                        &nbsp;
                    </td>
                    <td>
                        <select name="city" class="w3-input w3-border">
                            <option value="1" <?php if($site['city']==1){echo "selected";}?>>Kuching</option>
                            <option value="2" <?php if($site['city']==2){echo "selected";}?>>Sarikei</option>
                            <option value="3" <?php if($site['city']==3){echo "selected";}?>>Tanjung Manis</option>
                            <option value="4" <?php if($site['city']==4){echo "selected";}?>>Sibu</option>
                            <option value="5" <?php if($site['city']==5){echo "selected";}?>>Kapit</option>
                            <option value="6" <?php if($site['city']==6){echo "selected";}?>>Bintulu</option>
                            <option value="7" <?php if($site['city']==7){echo "selected";}?>>Miri</option>
                            <option value="8" <?php if($site['city']==8){echo "selected";}?>>Limbang</option>
                            <option value="9" <?php if($site['city']==9){echo "selected";}?>>Lawas</option>
                        </select>
                    </td>
                </tr>

                <!-- OIC -->
                <tr>
                    <td>
                        <label class="w3-label">Manager / EIC / OIC</label>
                        &nbsp;
                    </td>
                    <td>
                        <select name="oic" class="w3-input w3-border">
                            <option value="1">Default</option>
                        </select>
                    </td>
                </tr>

                <!-- [empty row, just to make margin] -->
                <tr>
                    <td></td>
                    <td>
                        &nbsp;
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <span class="w3-right">
                            <a href="/fragment/site">cancel</a>
                            &nbsp;
                            <button type="submit" class="w3-button w3-asphalt">Okay</button>
                        </span>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>