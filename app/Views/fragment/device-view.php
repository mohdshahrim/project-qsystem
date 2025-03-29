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
    <h3>Device (<a href="/fragment/device/edit/<?= $device['id']?>">edit</a>)</h3>

    <table class="table-form">
        <tr>
            <td>id</td>
            <td>
                <?= $device['id']?>
            </td>
        </tr>

        <!-- type -->
        <tr>
            <td>type</td>
            <td>
                <?= $device['type']?>
            </td>
        </tr>

        <!-- serial no -->
        <tr>
            <td>serial no</td>
            <td>
                <?= $device['serial_no']?>
            </td>
        </tr>

        <!-- model -->
        <tr>
            <td>model</td>
            <td>
                <?= $device['model']?>
            </td>
        </tr>

        <!-- date received -->
        <tr>
            <td>date received</td>
            <td>
                <?= $device['date_received']?>
            </td>
        </tr>

        <!-- current location -->
        <tr>
            <td>current location</td>
            <td>
                <?= $device['current_location']?>
            </td>
        </tr>

        <!-- status -->
        <tr>
            <td>status</td>
            <td>
                <?= $device['status']?>
            </td>
        </tr>

        <!-- hosted on -->
        <tr>
            <td>hosted on</td>
            <td>
                <?= $device['hosted_on']?>
            </td>
        </tr>

        <!-- codename -->
        <tr>
            <td>codename</td>
            <td>
                <?= $device['codename']?>
            </td>
        </tr>

        <!-- notes -->
        <tr>
            <td>notes</td>
            <td>
                <?= $device['notes']?>
            </td>
        </tr>

        <!-- created at -->
        <tr>
            <td>created at</td>
            <td>
                <?= $device['created_at']?>
            </td>
        </tr>

        <!-- updated at -->
        <tr>
            <td>updated at</td>
            <td>
                <?= $device['updated_at']?>
            </td>
        </tr>
    </table>
</main>