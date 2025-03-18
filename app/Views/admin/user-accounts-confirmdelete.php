<div class="div-right">
    <h2>Are you sure you want to delete this user account?</h2>

    <form method="post" action="/admin/user-accounts/delete/">
        <table>
            <tr>
                <td>id</td>
                <td>
                    <?= $user['id']?>
                    <input type="hidden" name="id" value="<?= $user['id']?>"/>
                </td>
            </tr>

            <!-- username -->
            <tr>
                <td>username</td>
                <td>
                    <input type="text" name="username" value="<?= $user['username'] ?>"/>
                </td>
            </tr>

            <!-- username -->
            <tr>
                <td>email</td>
                <td>
                    <input type="text" name="username" value="<?= $user['email'] ?>"/>
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
        <button type="submit">Confirm delete</button>
    </form>
    
</div>