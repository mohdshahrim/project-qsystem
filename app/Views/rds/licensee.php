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
    <h3>Licensee list</h3>

    <div>
        <a href="/rds/licensee/new"><button>new Licensee</button></a>
    </div>

    <br>

    <div>
        <table class="table-mill">
            <tr>
                <td>&nbsp;</td>
                <td>License No</td>
                <td>Licensee Name</td>
                <td>Email</td>
                <td>Contact Person</td>
                <td>options</td>
            </tr>
            <?php foreach ($licensees as $key=>$row):?>
                <tr>
                    <td><?= ($key+1) ?></td>
                    <td><?= $row['license_no'] ?></td>
                    <td><?= $row['licensee_name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['contact_person'] ?></td>
                    <td>
                        <a href="/rds/licensee/edit/<?= $row['id'] ?>">edit</a>
                        &nbsp;
                        <form action="/rds/licensee/delete" method="post">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                            <input type="submit" value="delete"/>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</main>