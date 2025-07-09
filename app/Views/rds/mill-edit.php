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
    <h3>New Mill/Processor</h3>

    <form method="post" action="/rds/mill/update">
        <table class="table-form">
            <tr>
                <td>id</td>
                <td><?= $mill['id']; ?></td>
            </tr>

            <!-- mill no -->
            <tr>
                <td>mill no</td>
                <td>
                    <input type="hidden" name="id" value="<?= $mill['id'] ?>"/>
                    <input type="text" name="millno" value="<?= $mill['mill_no'] ?>"/>
                </td>
            </tr>

            <!-- mill name -->
            <tr>
                <td>mill name</td>
                <td>
                    <input type="text" name="millname" value="<?= $mill['mill_name'] ?>"/>
                </td>
            </tr>

            <!-- email -->
            <tr>
                <td>email</td>
                <td>
                    <input type="text" name="email" value="<?= $mill['email'] ?>"/>
                </td>
            </tr>

            <!-- contact person -->
            <tr>
                <td>contact person</td>
                <td>
                    <input type="text" name="contactperson" value="<?= $mill['contact_person'] ?>"/>
                </td>
            </tr>

        </table>

        <br>

        <a href="/rds">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
</main>