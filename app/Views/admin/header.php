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
            header {
                padding: 0.5em;
                background-color: buttonface;
            }
            main {
                padding: 0.5em 2em;
            }
            
            .spacer {
                height: 50px;
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
                /*background-color: #475569;*/
                background-color: blue;
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
        <header>
            <a href="/user/home">(x)</a>
            &nbsp;
            <a href="/admin">main</a>
            &nbsp;
            <a href="/admin/user-accounts">user accounts</a>
            &nbsp;
            <a href="/admin/database">database</a>
            &nbsp;
            <a href="/user/logout">logout</a>
        </header>
