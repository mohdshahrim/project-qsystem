<style>
/* table for PC */
.table-pc {
    border-collapse: collapse;
    border: 1px solid black;
    table-layout: fixed;
}
.table-pc tr th,td {
    padding: 0.2em;
    border: 1px solid black;
}
</style>
<main>
    <h3>PC</h3>
    <p>list of all PC</p>

    <table class="table-pc">
        <tr>
            <th>id</th>
            <th>hostname</th>
            <th>ip address</th>
            <th>cpu model</th>
            <th>cpu no</th>
            <th>monitor model</th>
            <th>monitor no</th>
            <th>hosted devices</th>
            <th>user</th>
            <th>department</th>
            <th>notes</th>
        </tr>
        <?php foreach ($pc as $row):?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['hostname'] ?></td>
                <td><?= $row['ip_address'] ?></td>
                <td><?= $row['cpu_model'] ?></td>
                <td><?= $row['cpu_no'] ?></td>
                <td><?= $row['monitor_model'] ?></td>
                <td><?= $row['monitor_no'] ?></td>
                <td><?= $row['hosted_devices'] ?></td>
                <td><?= $row['user'] ?></td>
                <td><?= $row['department'] ?></td>
                <td><?= $row['notes'] ?></td>

            </tr>
        <?php endforeach ?>
    </table>
</main>