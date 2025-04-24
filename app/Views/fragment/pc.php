<?php
function get_office() {
    if (isset($_GET['office'])) {
        return $_GET['office'];
    } else {
        return "all";
    }
}
?>
<script src="/js/htmx.min.js"></script>
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
    <h3>PC (<?php echo get_office(); ?>)</h3>

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
                <th onclick="sortTable(4)">type</th>
                <th onclick="sortTable(5)">cpu model</th>
                <th onclick="sortTable(6)">cpu no</th>
                <th onclick="sortTable(7)">monitor model</th>
                <th onclick="sortTable(8)">monitor no</th>
                <th onclick="sortTable(9)">hosted devices</th>
                <th onclick="sortTable(10)">user</th>
                <th onclick="sortTable(11)">department</th>
                <th onclick="sortTable(12)">notes</th>
                <th onclick="sortTable(13)">office</th>
                <th>options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pc as $row):?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['hostname'] ?></td>
                    <td><?= $row['ip_address'] ?></td>
                    <td><?= $row['os'] ?></td>
                    <td><?= $row['type'] ?></td>
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
</script>