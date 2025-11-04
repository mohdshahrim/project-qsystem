<style>
/* table for Quick Info */
.table-crud {
    border-collapse:collapse;
    border: 1px solid black;
    table-layout: fixed;
}
.table-crud tr td {
    padding: 0.2em;
    border: 1px solid black;
}
</style>
<main>
    <h2>Router Reset Record</h2>
    <p>reset request, physical access and other logs</p>

    <br>

    <p>
        <a href="/rr/log/new"><button>new</button></a>
    </p>

    <table class="table-crud">
        <tr>
            <td>&nbsp;</td>
            <td>action code</td>
            <td>datetime</td>
            <td>notes</td>
        </tr>
        <?php foreach ($logs as $key=>$row):?>
            <tr>
                <td><?= ($key+1) ?></td>
                <td><?= $row['action_code'] ?></td>
                <td><?= $row['datetime'] ?></td>
                <td><?= $row['notes'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</main>