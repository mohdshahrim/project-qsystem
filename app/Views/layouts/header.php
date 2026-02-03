<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $this->renderSection('title') ?> | Qsystem</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/w3.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <style>
        header {
            height: 30px;
        }
        body {
            background-color: #F6F5F8FF;
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
            <div class="w3-border w3-white w3-round-large">

                <!-- system logo -->
                <div class="w3-center w3-padding w3-margin-top">
                    <img src="/favicon.ico" width="45" height="auto">
                </div>

                <!-- special functions -->
                <div class="w3-center">
                    <a href="/setting" class="w3-button w3-text-dark-grey">
                        <i class="fa fa-gear"></i>
                    </a>
                    <a href="/home" class="w3-button w3-text-dark-grey">
                        <i class="fa fa-home"></i>
                    </a>
                    <a href="/logout" class="w3-button w3-text-red">
                        <i class="fa fa-power-off"></i>
                    </a>
                </div>

                <!-- menu -->
                <h3 class="w3-center margin-0">
                    <?= $this->renderSection('menu') ?>    
                </h3>

                <br>

                <?= $this->renderSection('sidebar') ?>

                <br>

                <p class="w3-center w3-small w3-text-gray">version 1.0</p>
            </div>
        </div>

        <!-- right block -->