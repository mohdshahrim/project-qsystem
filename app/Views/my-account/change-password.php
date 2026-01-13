<div class="w3-container w3-padding-64">
    <h1>Change Password</h1>
    <br>
    <form action="/my-account/change-password/update" method="post" class="w3-quarter">
        <label>Old password</label>
        <input type="password" name="old_password" tabindex="1" class="w3-input w3-border w3-small"/>

        <br>

        <label>New password</label>
        <input type="password" name="new_password" tabindex="2" class="w3-input w3-border w3-small"/>

        <br>

        <label>Confirm password</label>
        <input type="password" name="confirm_password" tabindex="3" class="w3-input w3-border w3-small"/>

        <br>

        <button type="submit" class="w3-button w3-red w3-right w3-round" tabindex="4">Okay</button>
    </form>
</div>