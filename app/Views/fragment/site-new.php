<div class="w3-container">
    <h1>New Site</h1>

    <br>

    <div>
        <form action="/fragment/site/create" method="post">
            <table>
                <!-- SITE ID -->
                <tr>
                    <td>
                        <label class="w3-label">Site ID / Code</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="text" name="site_id" class="w3-input w3-border"></input>
                        <span class="w3-text-red position-absolute right-0 top--10px font-size-2rem user-select-none">*</span>
                    </td>
                </tr>

                <!-- SITE NAME -->
                <tr>
                    <td>
                        <label class="w3-label">Site Name</label>
                        &nbsp;
                    </td>
                    <td>
                        <input type="text" name="site_name" class="w3-input w3-border"></input>
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
                            <option value="2">Regional Office</option>
                            <option value="3">Sub-regional Office</option>
                            <option value="1">HQ</option>
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
                        <input type="text" name="address" class="w3-input w3-border"></input>
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
                            <option value="1">Kuching</option>
                            <option value="2">Sarikei</option>
                            <option value="3">Tanjung Manis</option>
                            <option value="4">Sibu</option>
                            <option value="5">Kapit</option>
                            <option value="6">Bintulu</option>
                            <option value="7">Miri</option>
                            <option value="8">Limbang</option>
                            <option value="9">Lawas</option>
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
                            <button type="submit" class="w3-button w3-asphalt w3-round">Okay</button>
                        </span>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>