<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/w3.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <script src="/js/minAjax.js" defer></script>
    <script src="/js/alpinejs.min.js" defer></script>
    <title>Qsystem | EleaveChecker</title>
    <style>
        .app-box {
            width: 160px;
            height: 160px;
            display: inline-block;
        }
        .app-box:hover {
            background-color: lightgray;
        }
        .app-box > div:nth-child(1) {
            height: 130px;
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
                <img src="/favicon.ico" width="30" height="auto" class="hidden-print">
                Qsystem | EleaveChecker (EC)
            </div>
        </div>
    </header>
    <main class="w3-container w3-padding">