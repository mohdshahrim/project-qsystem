<div class="w3-container">
    <h1>Staff #<?= $staff['id'] ?></h1>

    <br>

    <table>
        <colgroup>
            <col width="150px"></col>
            <col></col>
        </colgroup>
        <tr>
            <td>Fullname</td>
            <td><?= $staff['fullname'] ?></td>
        </tr>

        <tr>
            <td>Site Name</td>
            <td><?= $staff['staff_id'] ?></td>
        </tr>

        <tr>
            <td>Tel No.</td>
            <td><?= $staff['telno'] ?></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><?= $staff['email'] ?></td>
        </tr>

        <tr>
            <td>Birthdate</td>
            <td><?= $staff['birthdate'] ?></td>
        </tr>

        <tr>
            <td>Age</td>
            <td><?= $staff['age'] ?></td>
        </tr>

        <tr>
            <td>Designation</td>
            <td><?= $staff['designation'] ?></td>
        </tr>

        <tr>
            <td>Department</td>
            <td><?= $staff['department'] ?></td>
        </tr>

        <tr>
            <td>Site</td>
            <td><?= $staff['site'] ?></td>
        </tr>

        <tr>
            <td>created_at</td>
            <td><?= $staff['created_at'] ?></td>
        </tr>

        <tr>
            <td>updated_at</td>
            <td><?= $staff['updated_at'] ?></td>
        </tr>

        <tr>
            <td>deleted_at</td>
            <td><?= $staff['deleted_at'] ?></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td>
                <span class="w3-left">
                    <form action="/fragment/staff/delete" method="post">
                        <input type="hidden" name="id" value="<?= $staff['id'] ?>"></input>
                        <button type="submit" class="w3-button w3-red w3-round">delete</button>
                    </form>
                </span>
            </td>
            <td>
                <span class="w3-right">
                    <a href="/fragment/staff">cancel</a>
                    &nbsp;
                    <a href="/fragment/staff/edit/<?= $staff['id'] ?>" class="w3-button w3-asphalt w3-round">Edit</a>
                </span>
            </td>
        </tr>
    </table>
</div>