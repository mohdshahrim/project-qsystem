<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <style>
        /* */
        .container {
            display: flex;
            justify-content: center; /* Centers horizontally */
            align-items: center;     /* Centers vertically */
            height: 80vh;           /* Ensures the container takes up the full viewport height */
        }
        .text-align-center {
            text-align: center;
        }
        .margin-0 {
            margin: 0;
        }
    </style>
</head>
<body>
    <header></header>
    <main class="container">
        <div style="">
        <form method="post" action="/login">
            <table>
                <tr>
                    <td colspan="2">
                        <p class="text-align-center margin-0">
                            <img src="/favicon.ico" width="70" height="auto">
                        </p>
                        <br>
                        <p class="text-align-center w3-small">
                            <?php echo $loginmessage; ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="password" type="password" class="text-align-center" tabindex="1"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" class="w3-button w3-black w3-round w3-block" tabindex="2">login</button>
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </main>
    <footer></footer>
</body>
</html>