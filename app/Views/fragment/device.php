<style>
/* table for Device */
.table-device {
    border-collapse: collapse;
    border: 1px solid black;
    table-layout: fixed;
}
.table-device tr th,td {
    padding: 0.2em;
    border: 1px solid black;
}
.table-device tr:hover {
    background-color: lightgray;
}
</style>
<main>
    <h3>Device (all)</h3>

    <p><a href="/fragment/device/new"><button>new Device</button></a></p>

    <table class="table-device">
        <tr>
            <th>id</th>
            <th>type</th>
            <th>serial no</th>
            <th>model</th>
            <th>date received</th>
            <th>current location</th>
            <th>status</th>
            <th>hosted on</th>
            <th>codename</th>
            <th>notes</th>
            <th>created at</th>
            <th>updated at</th>
            <th>options</th>
        </tr>
        <?php foreach ($device as $row):?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['type'] ?></td>
                <td><?= $row['serial_no'] ?></td>
                <td><?= $row['model'] ?></td>
                <td><?= $row['date_received'] ?></td>
                <td><?= $row['current_location'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['hosted_on'] ?></td>
                <td><?= $row['codename'] ?></td>
                <td><?= $row['notes'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <td><?= $row['updated_at'] ?></td>
                <td>
                    <a href="/fragment/device/view/<?= $row['id'] ?>">view</a>
                    &nbsp;
                    <a href="/fragment/device/edit/<?= $row['id'] ?>">edit</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</main>