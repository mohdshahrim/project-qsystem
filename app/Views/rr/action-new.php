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
    <h3>New Action</h3>

    <form method="post" action="/rr/action/create">
        <table class="table-form">
            <!-- action code -->
            <tr>
                <td>Action Code</td>
                <td>
                    <input type="text" name="action_code" value=""/>
                </td>
            </tr>

            <!-- description -->
            <tr>
                <td>Description</td>
                <td>
                    <input type="text" name="description" value=""/>
                </td>
            </tr>
        </table>

        <br>

        <a href="/rr/setting/">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
</main>