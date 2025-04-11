<main>
    <h2>Database Administration</h2>
    <p>backup and restore</p>

    <div class="spacer"></div>

    <h3>Restore DB</h3>
    <p>CAREFUL. This feature is only to assist in testing.</p>
    <p>The system will replace the current DB with backup DB.</p>
    <p>Backup DB may not be up-to-date.</p>
    <button onclick="restoreDB()">restore db</button>

    <div class="spacer"></div>

    <h3>Backup DB (opposite of Restore DB)</h3>
    <p>CAREFUL. This feature is only to assist in testing.</p>
    <p>The system will replace the backup DB with current DB.</p>
    <p>Current DB may not be stable.</p>
    <button onclick="backupDB()">backup db</button>

    <div class="spacer"></div>
</main>

<script>
function restoreDB() {
    fetch('/admin/database/restore-db', {
        method: 'POST',
    })
}

function backupDB() {
    fetch('/admin/database/backup-db', {
        method: 'POST',
    })
}
</script>