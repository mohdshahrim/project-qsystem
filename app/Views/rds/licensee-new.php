<style>
.table-form {
    border-collapse: collapse;
    table-layout: fixed;
}
.table-form tr th,td {
    padding: 0.2em;
}
.table-form tr:hover {
    background-color: lightgray;
}
</style>
<main>
    <h3>New Licensee</h3>

    <form method="post" action="/rds/licensee/create">
        <table class="table-form">
            <!-- license no -->
            <tr>
                <td>license no</td>
                <td>
                    <input type="text" name="license_no" value=""/>
                </td>
            </tr>

            <!-- licensee name -->
            <tr>
                <td>licensee name</td>
                <td>
                    <input type="text" name="licensee_name" value=""/>
                </td>
            </tr>

            <!-- email -->
            <tr>
                <td>email</td>
                <td>
                    <input type="text" name="email" value=""/>
                </td>
            </tr>

            <!-- contact person -->
            <tr>
                <td>contact person</td>
                <td>
                    <input type="text" name="contactperson" value=""/>
                </td>
            </tr>

        </table>

        <br>

        <a href="/rds">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
</main>