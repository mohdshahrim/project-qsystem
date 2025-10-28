<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/w3.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <script src="js/minAjax.js" defer></script>
    <title>Qsystem</title>
    <style>
        .app-box {
            width: 200px;
            height: 200px;
            display: inline-block;
        }
        .app-box:hover {
            background-color: lightgray;
        }
        .app-box > div:nth-child(1) {
            height: 170px;
            position: relative;
        }
        .app-box > div:nth-child(1) > div:last-child {
            bottom: 0px;
            position: absolute;
            padding-right: 0.5em;
            font-size: small;
        }
        .app-box > div:nth-child(2) {
            height: 30px;
        }
        /* styling for header at topright */
        #header-topright {
            position: relative;
        }
        #header-topright > div:first-child {
            width: auto;
            height: 100%;
            display: inline-block;
            font-size: small;
        }
        #header-topright > div:last-child {
            right: 0px;
            width: auto;
            height: 100%;
            display: inline-block;
            padding: 4px;
            position: absolute;
        }
    </style>
</head>
<body>
    <header class="w3-margin-bottom">
        <div class="w3-flex">
            <div class="w3-border-bottom w3-padding" style="flex-grow: 1;">
                <img src="/favicon.ico" width="30" height="auto">
                Qsystem
            </div>
            <div class="w3-border-bottom" style="flex-grow: 6;"></div>
            <div id="header-topright" class="w3-border-bottom" style="flex-grow: 1;">
                <div id="sibu-temp">
                    
                </div>
                <div>
                    <a class="w3-button w3-red w3-round-large" href="/login">
                        <i class="fa fa-sign-in"></i>
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main class="w3-container w3-padding">
        <!-- CLAIMMAKER -->
        <div class="app-box w3-margin-right w3-margin-bottom">
            <div class="w3-border-top w3-border-right w3-border-left w3-padding">
                <div>
                    <h4>ClaimMaker</h4>
                </div>
                <div>
                    <p>fast and easy way to create claim form</p>
                </div>
            </div>
            <div class="w3-border w3-container">
                <a href="#">Go</a>
            </div>
        </div>

        <!-- RDS -->
        <div class="app-box w3-margin-right w3-margin-bottom">
            <div class="w3-border-top w3-border-right w3-border-left w3-padding">
                <div>
                    <h4>Report Delivery Status</h4>
                </div>
                <div>
                    <p>track delivery of LR and MR</p>
                </div>
            </div>
            <div class="w3-border w3-container">
                <a href="/public/rds">Go</a>
            </div>
        </div>

        <!-- eLeave Checker -->
        <div class="app-box w3-margin-right w3-margin-bottom">
            <div class="w3-border-top w3-border-right w3-border-left w3-padding">
                <div>
                    <h4>eLeave Checker</h4>
                </div>
                <div>
                    <p>check who's on-leave instantly</p>
                </div>
            </div>
            <div class="w3-border w3-container">
                <a href="/public/ec">Go</a>
            </div>
        </div>
    </main>
    <footer class="w3-container">
        
    </footer>

    <script>
        window.onload = () => {
            // submit to server for checking
            minAjax({
                url: "/getalltemp",
                type: "GET",
                success: function(response) {
                    let p_temp = document.getElementById("sibu-temp");
                    var data = JSON.parse(response);

                    switch(data["status"]) {
                        case "OK":
                            let sibu_temp = data['sibu_temp'];
                            let kuching_temp = data['kuching_temp'];
                            p_temp.innerHTML = `😺 Kuching ${kuching_temp}°C &nbsp;&nbsp; 🦢 Sibu ${sibu_temp}°C`;
                            break;
                        case "ERROR":
                            p_temp.innerHTML = "Error";
                            break;
                        default:
                            p_temp.innerHTML = "Error";
                            break;
                    }
                }
            });
        }
    </script>
</body>
</html>