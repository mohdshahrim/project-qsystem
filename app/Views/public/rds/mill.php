<div>
    <div>
        <p>
            <a href="/">home</a>
            >
            <a href="/public/rds">rds</a>        
            >
            <a href="/public/rds/mill">mill</a>
        </p>
    </div>

    <div>
        <h1>Mill</h1>
    </div>

    <br>

    <div>
        <table id="table-report" class="w3-table w3-border w3-bordered">
            <tr>
                <th>No.</th>
                <th>Mill No.</th>
                <th>Mill Name</th>
                <th>Email</th>
                <th>Contact person</th>
            </tr>
            <tbody>
                <?php foreach ($mills as $key=>$row):?>
                    <tr>
                        <td><?= ($key+1) ?></td>
                        <td><?= $row['mill_no'] ?></td>
                        <td><?= $row['mill_name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['contact_person'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>