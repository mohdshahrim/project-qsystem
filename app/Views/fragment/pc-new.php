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
    <h3>New PC</h3>

    <form method="post" action="/fragment/pc/create">
        <table class="table-form">
            <!-- hostname -->
            <tr>
                <td>hostname</td>
                <td>
                    <input type="text" name="hostname" value=""/>
                </td>
            </tr>

            <!-- ip address -->
            <tr>
                <td>ip address</td>
                <td>
                    <input type="text" name="ip_address" value=""/>
                </td>
            </tr>

            <!-- os -->
            <tr>
                <td>os</td>
                <td>
                    <input type="text" name="os" value=""/>
                </td>
            </tr>

            <!-- cpu model -->
            <tr>
                <td>cpu model</td>
                <td>
                    <input type="text" name="cpu_model" value=""/>
                </td>
            </tr>

            <!-- cpu no -->
            <tr>
                <td>cpu no</td>
                <td>
                    <input type="text" name="cpu_no" value=""/>
                </td>
            </tr>

            <!-- monitor model -->
            <tr>
                <td>monitor model</td>
                <td>
                    <input type="text" name="monitor_model" value=""/>
                </td>
            </tr>

            <!-- monitor no -->
            <tr>
                <td>monitor no</td>
                <td>
                    <input type="text" name="monitor_no" value=""/>
                </td>
            </tr>

            <!-- hosted devices -->
            <tr>
                <td>hosted devices</td>
                <td>
                    <input type="text" name="hosted_devices" value=""/>
                </td>
            </tr>

            <!-- user -->
            <tr>
                <td>user</td>
                <td>
                    <input type="text" name="user" value=""/>
                </td>
            </tr>

            <!-- department -->
            <tr>
                <td>department</td>
                <td>
                    <input type="text" name="department" value=""/>
                </td>
            </tr>

            <!-- notes -->
            <tr>
                <td>notes</td>
                <td>
                    <textarea type="text" name="notes" value=""></textarea>
                </td>
            </tr>

            <!-- office -->
            <tr>
                <td>office</td>
                <td>
                    <input type="text" name="office" value=""/>
                </td>
            </tr>
        </table>

        <br>

        <a href="/fragment/pc/">cancel</a>
        &nbsp;
        <button type="submit">Okay</button>
    </form>
</main>