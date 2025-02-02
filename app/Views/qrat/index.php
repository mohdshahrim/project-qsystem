<style>
    /* div per device */
    .div-device {
        padding: 1em;
        border: 1px solid black;
        margin-bottom: 2em;
    }
    .device-ip {
        margin-top:0px;
    }
</style>

<div class="div-right">
    <h2>Qrat</h2>
    <p>PROTOTYPE VERSION</p>

    <div class="spacer"></div>

    <div class="div-device">
        <p class="device-ip">172.16.17.22 (Torchic)</p>
        <a href="/qrat/device/torchic/nircmd">nircmd</a>
        <form method="post" action="/qrat/device/torchic/custom">
            <p>custom command <input type="text" name="command"></p>
        </form>
    </div>

    <div class="div-device">
        <p class="device-ip">172.16.17.20</p>
    </div>
</div>