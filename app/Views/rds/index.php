<style>
    .div-appcontainer {
        width: 100%;
        padding-top: 35px;
        display: inline-flex;
    }
    .div-app {
        color: black;
        display: block;
        width: 120px;
        height: 120px;
        border-radius: 6px;
        border: 1px gray solid;
        margin-right: 15px;
        margin-top: 15px;
        padding: 5px;
        text-decoration: none;
    }
    .div-app:hover {
        color: white;
        /*background-color: #475569;*/
        background-color: gray;
    }
    .app-info {
        position: relative;
        height: 100%;
    }
    .app-info-p {
        position: absolute;
        bottom: 0;
        margin: 0;
        font-size: small;
    }
    .app-image {
        background-size: 90px;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

<main>
    <h3>Report Delivery Status (RDS)</h3>
    <p>for LR and MR</p>

    <div class="div-appcontainer">

        <a class="div-app app-image" href="/rds/lr" style="background-image:url('/img/rds/lr.png');">
            <div class="app-info">
                <b>LR</b>
                <p class="app-info-p">Licensee Report</p>
            </div>
        </a>

        <a class="div-app app-image" href="/rds/mr" style="background-image:url('/img/rds/mr.png');">
            <div class="app-info">
                <b>MR</b>
                <p class="app-info-p">Mill Report</p>
            </div>
        </a>

        <a class="div-app app-image" href="/rds/licensee" style="background-image:url('/img/rds/llist.png');">
            <div class="app-info">
                <b>Licensee List</b>
                <p class="app-info-p">list of licensees</p>
            </div>
        </a>

        <a class="div-app app-image" href="/rds/mill" style="background-image:url('/img/rds/mlist.png');">
            <div class="app-info">
                <b>Mill List</b>
                <p class="app-info-p">list of mills</p>
            </div>
        </a>
    
    </div>
</main>