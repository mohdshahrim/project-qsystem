<style>
    /* table for PC */
    .table-crud {
        border-collapse: collapse;
        border: 1px solid black;
        table-layout: fixed;
    }
    .table-crud tr th,td {
        padding: 0.2em;
        border: 1px solid black;
    }
    .table-crud tr:hover {
        background-color: lightgray;
    }
</style>

<main>
    <h2>Router Reset Record Setting</h2>
    
    <br>

    <h2>Action</h2>
    <p><a href="/rr/action/new"><button>add action</button></a></p>
    <table class="table-crud">
        <tr>
            <td>&nbsp;</td>
            <td>action code</td>
            <td>description</td>
            <td>options</td>
        </tr>
        <?php foreach ($actions as $key=>$row):?>
            <tr>
                <td><?= ($key+1) ?></td>
                <td><?= $row['action_code'] ?></td>
                <td><?= $row['description'] ?></td>
                <td>
                    <a href="/rr/action/edit/<?= $row['id'] ?>">edit</a>
                    &nbsp;
                    <form action="/rr/action/delete" method="post">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                        <input type="submit" value="delete"/>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</main>