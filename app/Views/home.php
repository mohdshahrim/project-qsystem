<!-- right block -->
<div class="w3-padding" style="">
    <!-- section title -->
    <h1>Dashboard</h1> 

    <!-- section: display inventory counts -->
    <div class="w3-grid" style="grid-template-columns: repeat(auto-fill, 150px); column-gap: 20px;">
        <div class="w3-asphalt statscard" style="height: 150px;">
            <a class="statscard-link" href="#">
                <p class="statscard-name">PC</p>
                <p class="statscard-total">59</p>
            </a>
        </div>

        <div class="w3-asphalt statscard" style="height: 150px;">
            <a class="statscard-link" href="#">
                <p class="statscard-name">Laptop</p>
                <p class="statscard-total">2</p>
            </a>
        </div>

        <div class="w3-asphalt statscard" style="height: 150px;">
            <a class="statscard-link" href="#">
                <p class="statscard-name">Printer</p>
                <p class="statscard-total">15</p>
            </a>
        </div>

        <div class="w3-asphalt statscard" style="height: 150px;">
            <a class="statscard-link" href="#">
                <p class="statscard-name">Office</p>
                <p class="statscard-total">4</p>
            </a>
        </div>

        <div class="w3-asphalt statscard" style="height: 150px;">
            <a class="statscard-link" href="#">
                <p class="statscard-name">Users</p>
                <p class="statscard-total">80</p>
            </a>
        </div>
    </div>

    <br>

    <!-- section: network statuses -->
    <h1>Network Status</h1>

    <div class="">
        <!-- networkstatus -->
        <div class="networkstatus-bar w3-grid w3-margin-bottom">
            <div class="networkstatus-name w3-green w3-padding w3-border-left w3-border-top w3-border-bottom">
                <p class="margin-0">HTSB05</p>
                <p class="margin-0">172.16.1.10</p>
            </div>
            <div class="networkstatus-status w3-green w3-padding w3-border-right w3-border-top w3-border-bottom">
                <p>
                    Operational
                    <i class="fa fa-check"></i>
                </p>
            </div>
        </div>

        <div class="networkstatus-bar w3-grid w3-margin-bottom">
            <div class="networkstatus-name w3-red w3-padding w3-border-left w3-border-top w3-border-bottom">
                <p class="margin-0">HTSB05</p>
                <p class="margin-0">172.16.1.10</p>
            </div>
            <div class="networkstatus-status w3-red w3-padding w3-border-right w3-border-top w3-border-bottom">
                <p>
                    Down
                    <i class="fa fa-times"></i>
                </p>
            </div>
        </div>
    </div>
</div>