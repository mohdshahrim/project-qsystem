<style>
/* acc = account (as in user account) */
.acctable {
    border-collapse:collapse;
}
.acctable-td {
    border:1px solid black;
    padding:1em;
}
</style>

<div class="div-right">
    <h2>User Accounts</h2>
    <p>management and settings</p>

    <div class="spacer"></div>

    <a href="/admin/user-accounts/create"><button>new account</button></a>

    <div class="spacer"></div>

    <table class="acctable">
        <tr>
            <td class="acctable-td">no</td>
            <td class="acctable-td">id</td>
            <td class="acctable-td">username</td>
            <td class="acctable-td">email</td>
            <td class="acctable-td">fullname</td>
            <td class="acctable-td">department</td>
            <td class="acctable-td">designation</td>
            <td class="acctable-td">telno</td>
            <td class="acctable-td">role</td>
            <td class="acctable-td">created_at</td>
            <td class="acctable-td">updated_at</td>
            <td class="acctable-td">deleted_at</td>
            <td class="acctable-td">edit</td>
        </tr>
        <?php foreach ($accounts as $row):?>
            <tr>
                <td class="acctable-td"><?= $row['id'] ?></td>
                <td class="acctable-td"><?= $row['id'] ?></td>
                <td class="acctable-td"><?= $row['username'] ?></td>
                <td class="acctable-td"><?= $row['email'] ?></td>
                <td class="acctable-td"><?= $row['fullname'] ?></td>
                <td class="acctable-td"><?= $row['department'] ?></td>
                <td class="acctable-td"><?= $row['designation'] ?></td>
                <td class="acctable-td"><?= $row['telno'] ?></td>
                <td class="acctable-td"><?= $row['role'] ?></td>
                <td class="acctable-td"><?= $row['created_at'] ?></td>
                <td class="acctable-td"><?= $row['updated_at'] ?></td>
                <td class="acctable-td"><?= $row['deleted_at'] ?></td>
                <td class="acctable-td"><a href="/admin/user-accounts/edit/<?= $row['id'] ?>">edit</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>