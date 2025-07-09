<style>
    /* table for PC */
    .table-mill {
        border-collapse: collapse;
        border: 1px solid black;
        table-layout: fixed;
    }
    .table-mill tr th,td {
        padding: 0.2em;
        border: 1px solid black;
    }
    .table-mill tr:hover {
        background-color: lightgray;
    }
</style>

<main>
    <h3>Mill list</h3>

    <div>
        <a href="/rds/mill/new"><button>new mill</button></a>
    </div>

    <br>

    <div>
        <table class="table-mill">
            <tr>
                <td>&nbsp;</td>
                <td>Mill No</td>
                <td>Mill Name</td>
                <td>Email</td>
                <td>Contact Person</td>
                <td>options</td>
            </tr>
            <?php foreach ($mills as $key=>$row):?>
                <tr>
                    <td><?= ($key+1) ?></td>
                    <td><?= $row['mill_no'] ?></td>
                    <td><?= $row['mill_name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['contact_person'] ?></td>
                    <td>
                        <a href="/rds/mill/edit/<?= $row['id'] ?>">edit</a>
                        &nbsp;
                        <form action="/rds/mill/delete" method="post">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                            <input type="submit" />
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</main>