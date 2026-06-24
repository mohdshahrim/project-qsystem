<div class="w3-container"
x-data="">
    <h1>Add IP</h1>

    <br>

    <div>
        <form action="/pulseman/ip/create" method="post">
            <table>
                <colgroup>
                    <col>
                    <col width="350px">
                </colgroup>
                <!-- IP NAME -->
                <tr>
                    <td>
                        <label class="w3-label">Label</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="text" name="label" class="w3-input w3-border"></input>
                        <span class="w3-text-red position-absolute right-0 top--10px font-size-2rem user-select-none">*</span>
                    </td>
                </tr>

                <!-- IP ADDRESS -->
                <tr>
                    <td>
                        <label class="w3-label">IP address</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="text" name="ip_address" class="w3-input w3-border"></input>
                        <span class="w3-text-red position-absolute right-0 top--10px font-size-2rem user-select-none">*</span>
                    </td>
                </tr>

                <!-- DESCRIPTION -->
                <tr>
                    <td>
                        <label class="w3-label">Description</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="text" name="description" class="w3-input w3-border"></input>
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
                            <a href="/pulseman/ip">cancel</a>
                            &nbsp;
                            <button type="submit" class="w3-button w3-asphalt w3-round">Okay</button>
                        </span>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>