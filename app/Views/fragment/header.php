<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qsystem</title>
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .spacer {
            height: 50px;
        }
        .div-left {
            top: 0;
            padding-left: 5px;
            padding-right: 5px;
            display: block;
            position: absolute;
            width: 150px;
            height: 100%;
            border-right: 1px black solid;
        }
        .div-right {
            top: 0;
            margin-left: 200px;
            margin-right: 50px;
        }
        .div-menu {
            margin-top: 50px;
            width: 100%;
            padding-left: 5px;
        }
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
            background-color: #475569;
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
    </style>
</head>
<body>
    <div class="div-left">
        <h4 style="text-align:center;">Fragment</h4>
        <div class="div-menu">
            <p><a href="/fragment">home</a></p>

            <div class="spacer"></div>
            <div class="spacer"></div>

            <p><a href="/user/home">return to Qsystem</a></p>
            <p><a href="/user/logout">logout</a></p>
        </div>
    </div>