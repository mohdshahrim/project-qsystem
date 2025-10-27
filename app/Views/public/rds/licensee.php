<div>
    <div>
        <p>
            <a href="/">home</a>
            >
            <a href="/public/rds">rds</a>        
            >
            <a href="/public/rds/licensee">licensee</a>
        </p>
    </div>

    <div>
        <h1>Licensee</h1>
    </div>

    <br>

    <div class="w3-grid w3-grid-padding" style="grid-template-columns: 250px 200px; align-items: center;">
        <div class="hidden-print">
            <a target="_blank" class="w3-button w3-blue w3-round-large" href="/rds/print/1">
                <i class="fa fa-print"></i>
                Print
            </a>
        </div>
    </div>

    <br>

    <div>
        <table id="table-report" class="w3-table w3-border w3-bordered">
            <tr>
                <th>No.</th>
                <th>License No.</th>
                <th>Licensee Name</th>
                <th>Email</th>
                <th>Contact person</th>
            </tr>
            <tbody>
                <?php foreach ($licensees as $key=>$row):?>
                    <tr>
                        <td><?= ($key+1) ?></td>
                        <td><?= $row['license_no'] ?></td>
                        <td><?= $row['licensee_name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['contact_person'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>