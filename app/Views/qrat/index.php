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
        <p class="device-ip">Custom command</p>
        <p>use comma to separate argument</p>
        <form method="post" action="/qrat/c">
            <p>target <input type="text" name="target"></p>
            <p>command <input type="text" name="command"></p>
            <button type="submit">okay</button>
        </form>
    </div>

    <p><?php echo $getheader;?></p>
    <p><?php echo $getbody;?></p>
</div>