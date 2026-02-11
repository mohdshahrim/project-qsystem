<div class="w3-container">
    <h1>Add Staff</h1>

    <br>

    <div>
        <form action="/fragment/staff/create" method="post">
            <table>
                <colgroup>
                    <col>
                    <col width="350px">
                </colgroup>
                <!-- FULLNAME -->
                <tr>
                    <td>
                        <label class="w3-label">Fullname</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="text" name="fullname" class="w3-input w3-border"></input>
                        <span class="w3-text-red position-absolute right-0 top--10px font-size-2rem user-select-none">*</span>
                    </td>
                </tr>

                <!-- STAFF ID / STAFF NO -->
                <tr>
                    <td>
                        <label class="w3-label">Staff ID / No.</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="text" name="staff_id" class="w3-input w3-border"></input>
                    </td>
                </tr>

                <!-- TEL NO -->
                <tr>
                    <td>
                        <label class="w3-label">Tel no.</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="text" name="telno" class="w3-input w3-border"></input>
                    </td>
                </tr>

                <!-- EMAIL -->
                <tr>
                    <td>
                        <label class="w3-label">Email</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="text" name="email" class="w3-input w3-border"></input>
                    </td>
                </tr>

                <!-- BIRTHDATE -->
                <tr>
                    <td>
                        <label class="w3-label">Birthdate</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <input type="date" name="birthdate" class="w3-input w3-border"></input>
                    </td>
                </tr>

                <!-- DESIGNATION -->
                <tr>
                    <td>
                        <label class="w3-label">Designation</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <select name="designation" class="w3-input w3-border">
                            <option value="1">DEFAULT</option>
                        </select>
                    </td>
                </tr>

                <!-- DEPARTMENT -->
                <tr>
                    <td>
                        <label class="w3-label">Department</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <select name="department" class="w3-input w3-border">
                            <option value="1">DEFAULT</option>
                        </select>
                    </td>
                </tr>

                <!-- SITE -->
                <tr>
                    <td>
                        <label class="w3-label">Site</label>
                        &nbsp;
                    </td>
                    <td class="position-relative">
                        <select name="site" class="w3-input w3-border">
                            <option value="1">DEFAULT</option>
                        </select>
                    </td>
                </tr>

                <!-- [empty row, just to make margin] -->
                <tr>
                    <td></td>
                    <td>
                        &nbsp;
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <span class="w3-right">
                            <a href="/fragment/staff">cancel</a>
                            &nbsp;
                            <button type="submit" class="w3-button w3-asphalt w3-round">Okay</button>
                        </span>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <br>

    <div class="w3-third">
        <p class="w3-small w3-text-gray">Note: for your convenience, any successful add will automatically redirect back to /fragment/staff</p>
    </div>
</div>
