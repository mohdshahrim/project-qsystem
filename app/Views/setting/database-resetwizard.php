<div class="w3-container">
    <h1>Database Reset Wizard</h1>

    <form method="post" action="/setting/database/reset-wizard/submit">
        <table>
            <tr>
                <td>Display name</td>
                <td>
                    <input type="text" name="display_name" class="w3-input w3-border"/>
                </td>
            </tr>

            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password" class="w3-input w3-border"/>
                </td>
            </tr>

            <tr>
                <td>Confirm password &nbsp;</td>
                <td>
                    <input type="password" name="confirm_password" class="w3-input w3-border"/>
                </td>
            </tr>

            <tr>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td colspan="2">
                    <button class="w3-button w3-red w3-right w3-round">Okay</button>
                </td>
            </tr>
        </table>
    </form>
</div>