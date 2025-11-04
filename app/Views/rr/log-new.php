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
    <h2>Router Reset Record</h2>

    <br>

    <h3>add new log</h3>

    <form method="post" action="/rr/log/create">
        <table class="table-form">
            <!-- action code -->
            <tr>
                <td>Action Code</td>
                <td>
                    <select name="action">
                        <?php foreach ($actions as $key=>$row):?>
                            <option value="<?= $row['id'] ?>"><?= $row['action_code'] ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
            </tr>

            <!-- datetime of the log -->
            <tr>
                <td>Datetime</td>
                <td>
                    <input type="datetime-local" name="datetime" value=""/>
                </td>
            </tr>

            <!-- some notes -->
            <tr>
                <td>Notes</td>
                <td>
                    <input type="text" name="notes" value=""/>
                </td>
            </tr>
        </table>

        <br>

        <a href="/rr/">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
</main>