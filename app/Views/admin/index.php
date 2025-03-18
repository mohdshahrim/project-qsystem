<div class="div-right">
    <h2>System Administration</h2>
    <p>dedicated section to manage system behavior</p>

    <div class="spacer"></div>

    <h3>Clear all session</h3>
    <p>Including your own. Refreshing after clicking the button will redirect you out.</p>
    <button onclick="clearAllSession()">clear</button>

    <div class="spacer"></div>
</div>

<script>
function clearAllSession() {
    fetch('/admin/clear-all-session', {
        method: 'POST',
    })
}
</script>