<div class="div-right">
    <h2>System Administration</h2>
    <p>dedicated section to manage system behavior</p>

    <div class="spacer"></div>

    <h3>Clear all session</h3>
    <p>Including your own. Refreshing after clicking the button will redirect you out.</p>
    <button onclick="clearAllSession()">clear</button>

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
</div>

<script>
function clearAllSession() {
    fetch('/admin/clear-all-session', {
        method: 'POST',
    })
}

function restoreDB() {
    fetch('/admin/restore-db', {
        method: 'POST',
    })
}

function backupDB() {
    fetch('/admin/backup-db', {
        method: 'POST',
    })
}
</script>