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
    <h3>New Device</h3>

    <form method="post" action="/fragment/device/create">
        <table class="table-form">
            <!-- type -->
            <tr>
                <td>type</td>
                <td>
                    <input type="text" name="type" value="" placeholder="printer, scanner"/>
                </td>
            </tr>

            <!-- serial no -->
            <tr>
                <td>serial no</td>
                <td>
                    <input type="text" name="serial_no" value=""/>
                </td>
            </tr>

            <!-- model -->
            <tr>
                <td>model</td>
                <td>
                    <input type="text" name="model" value=""/>
                </td>
            </tr>

            <!-- date received -->
            <tr>
                <td>date received</td>
                <td>
                    <input type="date" name="date_received" value=""/>
                </td>
            </tr>

            <!-- current location -->
            <tr>
                <td>current location</td>
                <td>
                    <input type="text" name="current_location" value=""/>
                </td>
            </tr>

            <!-- status -->
            <tr>
                <td>status</td>
                <td>
                    <input type="text" name="status" value=""/>
                </td>
            </tr>

            <!-- hosted on -->
            <tr>
                <td>hosted on</td>
                <td>
                    <input type="text" name="hosted_on" value=""/>
                </td>
            </tr>

            <!-- nickname -->
            <tr>
                <td>nickname</td>
                <td>
                    <input type="text" name="nickname" value=""/>
                </td>
            </tr>

            <!-- notes -->
            <tr>
                <td>notes</td>
                <td>
                    <input type="text" name="notes" value=""/>
                </td>
            </tr>
        </table>

        <br>

        <a href="/fragment/device/">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
</main>