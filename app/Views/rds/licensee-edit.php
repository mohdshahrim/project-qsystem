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
    <h3>Update Licensee</h3>

    <form method="post" action="/rds/licensee/update">
        <table class="table-form">
            <tr>
                <td>id</td>
                <td><?= $licensee['id']; ?></td>
            </tr>

            <!-- license no -->
            <tr>
                <td>license no</td>
                <td>
                    <input type="hidden" name="id" value="<?= $licensee['id'] ?>"/>
                    <input type="text" name="millno" value="<?= $licensee['license_no'] ?>"/>
                </td>
            </tr>

            <!-- licensee name -->
            <tr>
                <td>licensee name</td>
                <td>
                    <input type="text" name="licensee_name" value="<?= $licensee['licensee_name'] ?>"/>
                </td>
            </tr>

            <!-- email -->
            <tr>
                <td>email</td>
                <td>
                    <input type="text" name="email" value="<?= $licensee['email'] ?>"/>
                </td>
            </tr>

            <!-- contact person -->
            <tr>
                <td>contact person</td>
                <td>
                    <input type="text" name="contactperson" value="<?= $licensee['contact_person'] ?>"/>
                </td>
            </tr>

        </table>

        <br>

        <a href="/rds">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
</main>