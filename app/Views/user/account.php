<main>
    <h2>Account</h2>
    <p>profile & settings</p>

    <div class="spacer"></div>

    <h3>Profile</h3>
    <table>
        <tr>
            <td>username</td>
            <td><?php echo $username;?></td>
        </tr>
        <tr>
            <td>email</td>
            <td><?php echo $email;?></td>
        </tr>
        <tr>
            <td>fullname</td>
            <td><?php echo $fullname;?></td>
        </tr>
        <tr>
            <td>department</td>
            <td><?php echo $department;?></td>
        </tr>
        <tr>
            <td>designation</td>
            <td><?php echo $designation;?></td>
        </tr>
        <tr>
            <td>telno</td>
            <td><?php echo $telno;?></td>
        </tr>
        <tr>
            <td>role</td>
            <td><?php echo $role;?></td>
        </tr>
    </table>

    <div class="spacer"></div>

    <h3>Update password</h3>
    <p>
        <?php
            if (isset($_SESSION['password_message']))
            {
                echo $_SESSION['password_message'];
            }
        ?>
    </p>
    <form method="post" action="/user/password/update">
        <table>
            <tr>
                <td>old password</td>
                <td>
                    <input type="password" name="oldpassword"/>
                </td>
            </tr>
            <tr>
                <td>new password</td>
                <td>
                    <input type="password" name="newpassword"/>
                </td>
            </tr>
            <tr>
                <td>confirm password</td>
                <td>
                    <input type="password" name="confirmpassword"/>
                </td>
            </tr>
        </table>

        <button type="submit">Okay</button>
    </form>
</main>