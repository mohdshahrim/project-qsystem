<main>
    <h2>Welcome to Qsystem</h2>
    <p>Qsystem is part of Project Quartermaster</p>
    <p>you're logged as <?php echo session('username');?></p>

    <!-- div to contain array of app shortcuts -->
    <div class="div-appcontainer">
        <?php if (env("ci_environment")==="production"): ?> 
        <a class="div-app" href="/claimmaker">
            <div class="app-info">
                <b>Claimmaker</b>
                <p class="app-info-p">fast & easy way to create claim form</p>
            </div>
        </a>
        <?php endif ?>

        <?php if (session("role")=="admin"): ?>
        <a class="div-app" href="/claimmaker">
            <div class="app-info">
                <b>Router Reset Record</b>
                <p class="app-info-p">keep record of router reset</p>
            </div>
        </a>
        <?php endif ?>

        <?php if (session("role")=="admin"): ?>
        <a class="div-app" href="/qrat">
            <div class="app-info">
                <b>Qrat</b>
                <p class="app-info-p">simple Remote Administration Tool</p>
            </div>
        </a>
        <?php endif ?>

        <?php if (session("role")=="admin"): ?>
        <a class="div-app" href="/qrat">
            <div class="app-info">
                <b>ITDOC</b>
                <p class="app-info-p">IT Unit document & file numbering system</p>
            </div>
        </a>
        <?php endif ?>

        <?php if (session("role")=="admin"): ?>
        <a class="div-app" href="/fragment">
            <div class="app-info">
                <b>Fragment</b>
                <p class="app-info-p">IT inventory database</p>
            </div>
        </a>
        <?php endif ?>
    </div>
</main>