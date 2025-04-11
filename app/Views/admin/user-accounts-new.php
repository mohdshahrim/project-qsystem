<main>
    <h2>New user account</h2>

    <form method="post" action="/admin/user-accounts/create">
        <table>
            <tr>
                <td>id</td>
                <td>
                    <i>auto</i>
                </td>
            </tr>

            <!-- username -->
            <tr>
                <td>username</td>
                <td>
                    <input type="text" name="username" value=""/>
                </td>
            </tr>

            <!-- email -->
            <tr>
                <td>email</td>
                <td>
                    <input type="text" name="email" value=""/>
                </td>
            </tr>

            <!-- fullname -->
            <tr>
                <td>fullname</td>
                <td>
                    <input type="text" name="fullname" value=""/>
                </td>
            </tr>

            <!-- department -->
            <tr>
                <td>department</td>
                <td>
                    <input type="text" name="department" value=""/>
                </td>
            </tr>

            <!-- designation -->
            <tr>
                <td>designation</td>
                <td>
                    <input type="text" name="designation" value=""/>
                </td>
            </tr>

            <!-- telno -->
            <tr>
                <td>tel no.</td>
                <td>
                    <input type="text" name="telno" value=""/>
                </td>
            </tr>

            <!-- role -->
            <tr>
                <td>role</td>
                <td>
                    <input type="text" name="role" value=""/>
                </td>
            </tr>
        </table>

        <br>
        <a href="/admin/user-accounts/">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
    
</main>