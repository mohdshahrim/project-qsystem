<main>
    <h2>Update user account</h2>

    <form method="post" action="/admin/user-accounts/update">
        <table>
            <tr>
                <td>id</td>
                <td>
                    <?= $user['id']?>
                    <input type="hidden" name="id" value="<?= $user['id']?>"/>
                    <input type="hidden" name="returnlink" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
                </td>
            </tr>

            <!-- username -->
            <tr>
                <td>username</td>
                <td>
                    <input type="text" name="username" value="<?= $user['username'] ?>"/>
                </td>
            </tr>

            <!-- email -->
            <tr>
                <td>email</td>
                <td>
                    <input type="text" name="email" value="<?= $user['email'] ?>"/>
                </td>
            </tr>

            <!-- fullname -->
            <tr>
                <td>fullname</td>
                <td>
                    <input type="text" name="fullname" value="<?= $user['fullname'] ?>"/>
                </td>
            </tr>

            <!-- department -->
            <tr>
                <td>department</td>
                <td>
                    <input type="text" name="department" value="<?= $user['department'] ?>"/>
                </td>
            </tr>

            <!-- designation -->
            <tr>
                <td>designation</td>
                <td>
                    <input type="text" name="designation" value="<?= $user['designation'] ?>"/>
                </td>
            </tr>

            <!-- telno -->
            <tr>
                <td>tel no.</td>
                <td>
                    <input type="text" name="telno" value="<?= $user['telno'] ?>"/>
                </td>
            </tr>

            <!-- role -->
            <tr>
                <td>role</td>
                <td>
                    <input type="text" name="role" value="<?= $user['role'] ?>"/>
                </td>
            </tr>
        </table>

        <br>
        <a href="/admin/user-accounts/">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
    
</main>