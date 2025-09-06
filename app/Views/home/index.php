<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qsystem</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <script src="js/minAjax.js" defer></script>
    <style>
        /* */
    </style>
</head>
<body class="bg-light">
    <header class="mb-3 border-bottom">
        <nav class="navbar bg-white">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="/favicon.ico" alt="Bootstrap" width="30" height="auto" class="d-inline-block align-text-top">
                    Qsystem
                </a>

                
                <div>
                    <!-- temperature display -->
                    <p id="sibu-temp" class="float-start me-5 text-body-secondary" style="font-size: smaller;"></p>

                    &nbsp;

                    <a href="/login" class="btn btn-primary" role="button">
                        login
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">

            <div class="row">
                

                <!-- RDS -->
                <div class="card h-100 me-3" style="width: 16rem;">
                    <div class="card-body">
                        <h5 class="card-title">RDS</h5>
                        <p class="card-text">Report Delivery Status for MR and LR</p>
                    </div>
                    <div class="card-footer bg-body">
                        <a href="#" class="btn btn-primary btn-sm card-link align-bottom">Go</a>
                    </div>
                </div>

                <!-- eLeave Checker -->
                <div class="card h-100 me-3" style="width: 16rem;">
                    <div class="card-body">
                        <h5 class="card-title">eLeave Checker</h5>
                        <p class="card-text">check who's on-leave today instantly</p>
                    </div>
                    <div class="card-footer bg-body">
                        <a href="#" class="btn btn-primary btn-sm card-link align-bottom">Go</a>
                    </div>
                </div>

                <!-- eLeave Checker -->
                <div class="card h-100 me-3" style="width: 16rem;">
                    <div class="card-body">
                        <h5 class="card-title">ClaimMaker</h5>
                        <p class="card-text">fast and easy way to create claim form</p>
                    </div>
                    <div class="card-footer bg-body">
                        <a href="#" class="btn btn-primary btn-sm card-link align-bottom">Go</a>
                    </div>
                </div>

            </div>

        </div>
    </main>
    <footer>

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