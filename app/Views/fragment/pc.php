<?php
function get_office() {
    if (isset($_GET['office'])) {
        return $_GET['office'];
    } else {
        return "all";
    }
}

function columnIndex() {

}
?>
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
    <h3 style="display:inline-block; margin-right:1.5em;">PC <?php echo get_office(); ?></h3>
    <p style="font-size:small;display:inline-block;">
        <a href="/fragment/pc">all</a>&nbsp;
        <a href="/fragment/pc?office=sibu">sibu</a>&nbsp;
        <a href="/fragment/pc?office=kapit">kapit</a>&nbsp;
        <a href="/fragment/pc?office=sarikei">sarikei</a>&nbsp;
        <a href="/fragment/pc?office=tgmanis">tgmanis</a>
    </p>

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

    <table id="table-pc" class="table-pc">
        <thead>
            <tr>
                <th onclick="sortTable(0)">id</th>
                <th onclick="sortTable(1)">hostname</th>
                <th onclick="sortTable(2)">ip address</th>
                <th onclick="sortTable(3)">os</th>
                <th style="display:<?= $settingpc['pc_type']?'':'none' ?>;" onclick="sortTable(4)">type</th>
                <th style="display:<?= $settingpc['pc_cpumodel']?'':'none' ?>;" onclick="sortTable(5)">cpu model</th>
                <th onclick="sortTable(6)">cpu no</th>
                <th style="display:<?= $settingpc['pc_monitormodel']?'':'none' ?>;" onclick="sortTable(7)">monitor model</th>
                <th onclick="sortTable(8)">monitor no</th>
                <th style="display:<?= $settingpc['pc_hosteddevices']?'':'none' ?>;" onclick="sortTable(9)">hosted devices</th>
                <th style="display:<?= $settingpc['pc_user']?'':'none' ?>;" onclick="sortTable(10)">user</th>
                <th style="display:<?= $settingpc['pc_department']?'':'none' ?>;" onclick="sortTable(11)">department</th>
                <th style="display:<?= $settingpc['pc_notes']?'':'none' ?>;" onclick="sortTable(12)">notes</th>
                <th style="display:<?= $settingpc['pc_office']?'':'none' ?>;" onclick="sortTable(13)">office</th>
                <th>options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pc as $key=>$row):?>
                <tr>
                    <td><?= ($key+1) ?></td>
                    <td><?= $row['hostname'] ?></td>
                    <td><?= $row['ip_address'] ?></td>
                    <td><?= $row['os'] ?></td>
                    <td style="display:<?= $settingpc['pc_type']?'':'none'?>;"><?= $row['type'] ?></td>
                    <td style="display:<?= $settingpc['pc_cpumodel']?'':'none'?>;"><?= $row['cpu_model'] ?></td>
                    <td><?= $row['cpu_no'] ?></td>
                    <td style="display:<?= $settingpc['pc_monitormodel']?'':'none'?>;"><?= $row['monitor_model'] ?></td>
                    <td><?= $row['monitor_no'] ?></td>
                    <td style="display:<?= $settingpc['pc_hosteddevices']?'':'none'?>;"><?= $row['hosted_devices'] ?></td>
                    <td style="display:<?= $settingpc['pc_user']?'':'none'?>;"><?= $row['user'] ?></td>
                    <td style="display:<?= $settingpc['pc_department']?'':'none'?>;"><?= $row['department'] ?></td>
                    <td style="display:<?= $settingpc['pc_notes']?'':'none'?>;"><?= $row['notes'] ?></td>
                    <td style="display:<?= $settingpc['pc_office']?'':'none'?>;"><?= $row['office'] ?></td>
                    <td>
                        <a href="/fragment/pc/view/<?= $row['id'] ?>">view</a>
                        &nbsp;
                        <a href="/fragment/pc/edit/<?= $row['id'] ?>">edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <div class="spacer"></div>
    <div class="spacer"></div>
</main>

<script>
    function showOfficeSelection() {
        document.getElementById('div-office').style.display='block';
        document.getElementById('button-newpc').disabled = true;
        document.getElementById('span-newpc').style.display = "inline";
    }

    // sorting functions
    let sortDirection = {};

    function sortTable(colIndex) {
        const table = document.getElementById("table-pc");
        const tbody = table.tBodies[0];
        const rows = Array.from(tbody.rows);
        
        const currentDirection = sortDirection[colIndex] || "asc";
        const newDirection = currentDirection === "asc" ? "desc" : "asc";
        sortDirection[colIndex] = newDirection;

        rows.sort((a, b) => {
            let valA = a.cells[colIndex].innerText.trim();
            let valB = b.cells[colIndex].innerText.trim();

            // Convert to numbers or dates if possible
            if (!isNaN(valA) && !isNaN(valB)) {
            valA = parseFloat(valA);
            valB = parseFloat(valB);
            } else if (!isNaN(Date.parse(valA)) && !isNaN(Date.parse(valB))) {
            valA = new Date(valA);
            valB = new Date(valB);
            }

            if (valA < valB) return newDirection === "asc" ? -1 : 1;
            if (valA > valB) return newDirection === "asc" ? 1 : -1;
            return 0;
        });

        // Re-attach sorted rows
        rows.forEach(row => tbody.appendChild(row));
    }

    function getClickedColumnIndex(event) {
        const cell = event.target.closest('td, th');
        if (!cell) return -1; // Not a table cell
        return cell.cellIndex;
    }   
</script>