<div class="w3-container">
    <h1>Staffs</h1>

    <div>
        <a href="/fragment/staff/new" class="w3-button w3-asphalt w3-round">add staff</a>
    </div>

    <br>

    <div>
        <table class="w3-table w3-white w3-border w3-bordered w3-hoverable">
            <tr>
                <td class="w3-border-right">no.</td>
                <td class="w3-border-right">fullname</td>
                <td class="w3-border-right">staff id</td>
                <td class="w3-border-right">birthdate</td>
                <td class="w3-border-right">age</td>
                <td class="w3-border-right">tel no.</td>
                <td class="w3-border-right">email</td>
                <td class="w3-border-right">designation</td>
                <td class="w3-border-right">department</td>
                <td class="w3-border-right">site</td>
                <td class="w3-center">options</td>
            </tr>
            <?php foreach ($staffs as $key=>$row): ?>
                <tr class="w3-small">
                    <td class="w3-border-right"><?= ($key+1) ?></td>
                    <td class="w3-border-right">
                        <a href="/fragment/staff/<?= $row['id'] ?>" class="text-decoration-none"><?= $row['fullname'] ?></a>
                    </td>
                    <td class="w3-border-right"><?= $row['staff_id'] ?></td>
                    <td class="w3-border-right"><?= $row['birthdate'] ?></td>
                    <td class="w3-border-right"><?= $row['age'] ?></td>
                    <td class="w3-border-right"><?= $row['telno'] ?></td>
                    <td class="w3-border-right"><?= $row['email'] ?></td>
                    <td class="w3-border-right"><?= $row['designation_name'] ?></td>
                    <td class="w3-border-right"><?= $row['department_name'] ?></td>
                    <td class="w3-border-right"><?= $row['site_id'] ?></td>
                    <td class="w3-center">
                        <a href="/fragment/staff/<?= $row['id'] ?>">view</a>
                        &nbsp;
                        <a href="/fragment/staff/edit/<?= $row['id'] ?>">edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>