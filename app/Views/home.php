<!DOCTYPE html>
<html lang="en">
<head>
    <title>Qsystem</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/w3.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <style>
        header {
            height: 30px;
        }

        /* statscard styling */
        .statscard {
            border-radius: 18px;
        }
        .statscard-link {
            text-decoration: none;
            display: block;
            width: 100%;
            height: 100%;
            padding: 1em;
        }
        .statscard-name {
            margin: 0;            
        }
        .statscard-total {
            margin: 0;
            font-size: 4rem;
        }

        /* network status */
        .networkstatus-bar {
            grid-template-columns: 150px 400px;
        }
        .networkstatus-name {
            border-top-left-radius: 18px;
            border-bottom-left-radius: 18px;
        }
        .networkstatus-status {
            border-top-right-radius: 18px;
            border-bottom-right-radius: 18px;
            text-align: right;
        }

        /* utilities */
        .text-decoration-none {
            text-decoration: none;
        }
        .display-block {
            display: block;
        }
        .width-full {
            width: 100%;
        }
        .height-full {
            height: 100%;
        }
        .padding-0 {
            padding: 0;
        }
        .margin-0 {
            margin: 0;
        }
    </style>
</head>
<body>
    <header class="">

    </header>
    <main class="w3-grid" style="grid-template-columns: 200px auto">
        <!-- left block -->
        <div class="" style="padding: 1em;">
            <div class="w3-border w3-round-large">

                <!-- special functions -->
                <div class="w3-center">
                    <button class="w3-button">
                        <i class="fa fa-gear"></i>
                    </button>
                    <button class="w3-button">
                        <i class="fa fa-home"></i>
                    </button>
                    <button class="w3-button">
                        <i class="fa fa-power-off"></i>
                    </button>
                </div>

                <!-- menu -->
                <h3 class="w3-center margin-0">menu</h3>

                <br>

                <p class="margin-0"><a href="#" class="w3-button display-block">PC</a></p>
                <p class="margin-0"><a href="#" class="w3-button display-block">Devices</a></p>
                <p class="margin-0"><a href="#" class="w3-button display-block">Office</a></p>
                <p class="margin-0"><a href="#" class="w3-button display-block">Users</a></p>

                <br>

                <p class="w3-center w3-small w3-text-gray">version 1.0</p>
            </div>
        </div>

        <!-- right block -->
        <div class="w3-padding" style="">
            <!-- section title -->
            <h1>Dashboard</h1> 

            <!-- section: display inventory counts -->
            <div class="w3-grid" style="grid-template-columns: repeat(auto-fill, 150px); column-gap: 20px;">
                <div class="w3-black statscard" style="height: 150px;">
                    <a class="statscard-link" href="#">
                        <p class="statscard-name">PC</p>
                        <p class="statscard-total">59</p>
                    </a>
                </div>

                <div class="w3-black statscard" style="height: 150px;">
                    <a class="statscard-link" href="#">
                        <p class="statscard-name">Laptop</p>
                        <p class="statscard-total">2</p>
                    </a>
                </div>

                <div class="w3-black statscard" style="height: 150px;">
                    <a class="statscard-link" href="#">
                        <p class="statscard-name">Printer</p>
                        <p class="statscard-total">15</p>
                    </a>
                </div>

                <div class="w3-black statscard" style="height: 150px;">
                    <a class="statscard-link" href="#">
                        <p class="statscard-name">Office</p>
                        <p class="statscard-total">4</p>
                    </a>
                </div>

                <div class="w3-black statscard" style="height: 150px;">
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
    </main>
</body>
</html>