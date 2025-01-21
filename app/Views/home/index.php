<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quartermaster</title>
    <style>
        body{
            padding:5em 3em 2em 3em;
        }
    </style>
</head>
<body>
    <h3>Welcome to Quartermaster</h3>
    <br>
    <table>
        <form method="post" action="/user/login">
        <p>{{.Message}}</p>
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
    <p style="font-size:0.8em;">version {{.Version_no}} ({{.Version_date}})</p>
</body>
</html>