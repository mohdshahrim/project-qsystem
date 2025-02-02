<div class="div-right">
        <h2>Welcome to Qsystem</h2>
        <p>Qsystem is part of Project Quartermaster</p>
        <p>you're logged as <?php echo session('username');?></p>

        <!-- div to contain array of app shortcuts -->
        <div class="div-appcontainer">
            <a class="div-app" href="/claimmaker">
                <div class="app-info">
                    <b>Claimmaker</b>
                    <p class="app-info-p">fast & easy way to create claim form</p>
                </div>
            </a>

            <a class="div-app" href="/claimmaker">
                <div class="app-info">
                    <b>Router Reset Record</b>
                    <p class="app-info-p">keep record of router reset</p>
                </div>
            </a>

            <a class="div-app" href="/qrat">
                <div class="app-info">
                    <b>Qrat</b>
                    <p class="app-info-p">simple Remote Administration Tool</p>
                </div>
            </a>

            <a class="div-app" href="/fragment">
                <div class="app-info">
                    <b>Fragment</b>
                    <p class="app-info-p">IT inventory database</p>
                </div>
            </a>
        </div>

    </div>