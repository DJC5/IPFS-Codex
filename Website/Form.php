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
            <?php
            $filename = $_POST['filename'];
            $cid = $_POST['cid'];
            $link = $_POST['link'];
            $description = $_POST['description'];
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            //Validation
            if ($filename == "" || $cid == "") {
                echo "Please fill out all the required fields";
                exit();
            }
            //CIDs are 46 characters long
            if (strlen($cid) > 46 || strlen($cid) < 46) {
                echo 'CID is either too short or too long';
                exit();
            }
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $filename = pathinfo($filename, PATHINFO_FILENAME);
            if ($extension == "") {
            echo 'Could not get extension: Make sure you include the extension in the filename';
            exit();
            }
            if (substr($link, 0, 7) != 'http://' && substr($link, 0, 8) != 'https://' && $link != "") {
                echo 'Share link is not valid';
                exit();
            }
            //PostgreDatabase
            $sql = "INSERT INTO item_profile (filename, cid, link, description, ext) VALUES ('$filename', '$cid', '$link', '$description', '$extension')";
            $dbconn = pg_connect("host=localhost port=5432 dbname=cid_database user='username_here' password='password_here'") or die('Could not connect: ' . pg_last_error());
            $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
            pg_close($dbconn);
            echo 'Your CID has been added to the database';
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