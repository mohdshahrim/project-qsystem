<style>
/* table for PC */
.table-office {
    border-collapse: collapse;
    border: 1px solid black;
    table-layout: fixed;
}
.table-office tr th,td {
    padding: 0.5em;
    border: 1px solid black;
    width: 180px;
}
.table-office tr:hover {
    background-color: lightgray;
}

</style>
<main>
    <h3>Offices</h3>

    <table class="table-office">
        <tr>
            <th></th>
            <?php foreach ($office as $row):?>
            <th><a href="/fragment/office/edit/<?= $row['id'] ?>"><?= $row['office_name'] ?></a></th>
            <?php endforeach ?>
        </tr>
        <tr>
            <td>ID</td>
            <?php foreach ($office as $row):?>
            <td><?= $row['id'] ?></td>
            <?php endforeach ?>
        </tr>
        <tr>
            <td>Address</td>
            <?php foreach ($office as $row):?>
            <td><?= $row['address'] ?></td>
            <?php endforeach ?>
        </tr>
        <tr>
            <td>Manager/EIC/OIC</td>
            <?php foreach ($office as $row):?>
            <td><?= $row['manager'] ?></td>
            <?php endforeach ?>
        </tr>
        <tr>
            <td>Total employee</td>
            <?php foreach ($office as $row):?>
            <td><?= $row['total_employee'] ?></td>
            <?php endforeach ?>
        </tr>
        <tr>
            <td>Office type</td>
            <?php foreach ($office as $row):?>
            <td><?= $row['office_type'] ?></td>
            <?php endforeach ?>
        </tr>
        <tr>
            <td>Updated at</td>
            <?php foreach ($office as $row):?>
            <td><?= $row['updated_at'] ?></td>
            <?php endforeach ?>
        </tr>
    </table>
</main>