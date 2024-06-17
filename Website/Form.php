<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Submitted</title>
        <link rel="stylesheet" href="Style.css">
    </head>
    <body style="color:#383B4B;">
        <header>
            <br>
            <h1>Addition Form</h1>
            <nav class="nav">
                <a href="Index.html"><h3 style="display: inline;">Home</h3></a>
                <a href="Form.html"><h3 style="display: inline;">Add to Database</h3></a>
                <a href="Guide.html"><h3 style="display: inline;">How To</h3></a>
                <a href="About.html"><h3 style="display: inline;">About</h3></a>
            </nav>
        </header>
        <main>
            <hr>
            <h3><i>Submitted<i></h3>
            <?php
            $filename = $_POST['filename'];
            $cid = $_POST['cid'];
            $link = $_POST['link'];
            $description = $_POST['description'];
            ?>
        </main>
        <footer>
            <nav class="nav">
                <a href="https://github.com/DJC5/IPFS-Codex" target="_blank"><h3 style="display: inline;">GitHub</h3></a>
                <a href="https://ipfs.tech" target="_blank"><h3 style="display: inline;">IPFS Official</h3></a>
            </nav>
        </footer>
    </body>
</html>