<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qsystem</title>
    <style>
        body{
            padding:5em 3em 2em 3em;
        }
    </style>
</head>
<body>
    <h2 style="margin-bottom:0px;">Welcome to Qsystem</h2>
    <p style="font-size:small; margin-top:0px;">part of Project Quartermaster</p>
    <br>
    <table>
        <form method="post" action="/user/login">
            <p><?php echo $loginmessage; ?></p>
            <tr>
                <td>username</td>
                <td>
                    <input name="username" type="text" tabindex="1"></input>
                </td>
            </tr>
            <tr>
                <td>password</td>
                <td>
                    <input name="password" type="password" tabindex="2"></input>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align:right;">
                    <button type="submit">login</button>
                </td>
            </tr>
        </form>
    </table>
    <p style="font-size:0.8em;">version <?php echo QSYSTEM_VERSION_NO; ?> (<?php echo QSYSTEM_VERSION_DATE; ?>)</p>
</body>
</html>