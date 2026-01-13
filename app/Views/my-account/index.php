<div class="w3-container w3-padding-64">
    <h1>Account Info</h1>
    <br>
    <table class="w3-table w3-border w3-bordered w3-half">
        <tr class="w3-black">
            <th>Properties</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Display Name</td>
            <td><?= $display_name; ?></td>
        </tr>
        <tr>
            <td>Account Created</td>
            <td><?= $created_at; ?></td>
        </tr>
        <tr>
            <td>Account Last Updated</td>
            <td><?= $updated_at; ?></td>
        </tr>
    </table>
</div>