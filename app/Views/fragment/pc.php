<style>
/* table for PC */
.table-pc {
    border-collapse: collapse;
    border: 1px solid black;
    table-layout: fixed;
}
.table-pc tr th,td {
    padding: 0.2em;
    border: 1px solid black;
}
.table-pc tr:hover {
    background-color: lightgray;
}
</style>
<main>
    <h3>PC (all)</h3>

    <p><button id="button-newpc" onclick="showOfficeSelection()">new PC</button>&nbsp;<span id="span-newpc" style="display:none;">new PC for which office?</span></p>

    <div id="div-office" style="display:none;">
        <p>
            <a href="/fragment/pc/new?office=sibu"><button>Sibu</button></a>
            &nbsp;
            <a href="/fragment/pc/new?office=kapit"><button>Kapit</button></a>
            &nbsp;
            <a href="/fragment/pc/new?office=sarikei"><button>Sarikei</button></a>
            &nbsp;
            <a href="/fragment/pc/new?office=tgmanis"><button>Tg. Manis</button></a>
        </p>
    </div>

    <table class="table-pc">
        <tr>
            <th>id</th>
            <th>hostname</th>
            <th>ip address</th>
            <th>os</th>
            <th>cpu model</th>
            <th>cpu no</th>
            <th>monitor model</th>
            <th>monitor no</th>
            <th>hosted devices</th>
            <th>user</th>
            <th>department</th>
            <th>notes</th>
            <th>office</th>
            <th>options</th>
        </tr>
        <?php foreach ($pc as $row):?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['hostname'] ?></td>
                <td><?= $row['ip_address'] ?></td>
                <td><?= $row['os'] ?></td>
                <td><?= $row['cpu_model'] ?></td>
                <td><?= $row['cpu_no'] ?></td>
                <td><?= $row['monitor_model'] ?></td>
                <td><?= $row['monitor_no'] ?></td>
                <td><?= $row['hosted_devices'] ?></td>
                <td><?= $row['user'] ?></td>
                <td><?= $row['department'] ?></td>
                <td><?= $row['notes'] ?></td>
                <td><?= $row['office'] ?></td>
                <td>
                    <a href="/fragment/pc/view/<?= $row['id'] ?>">view</a>
                    &nbsp;
                    <a href="/fragment/pc/edit/<?= $row['id'] ?>">edit</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</main>

<script>
    function showOfficeSelection() {
        document.getElementById('div-office').style.display='block';
        document.getElementById('button-newpc').disabled = true;
        document.getElementById('span-newpc').style.display = "inline";
    }
</script>