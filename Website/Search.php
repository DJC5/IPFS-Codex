<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Web Repository for IPFS CIDs">
        <meta name="author" content="DJC5">
        <meta name="keywords" content="IPFS, CID, IPFS CIDs, IPFS Codex, IPFS Database">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IPFS Codex | Home</title>
        <link rel="stylesheet" href="Style.css">
    </head>
    <body style="color:#383B4B;">
        <header>
            <br>
            <h1>IPFS Codex</h1>
            <nav class="nav">
                <a href="Index.html"><h3 style="display: inline;">Home</h3></a>
                <a href="Search.php"><h3 style="display: inline;">Search</h3></a>
                <a href="Form.html"><h3 style="display: inline;">Add to Database</h3></a>
                <a href="Guide.html"><h3 style="display: inline;">How To</h3></a>
                <a href="About.html"><h3 style="display: inline;">About</h3></a>
            </nav>
        </header>
        <main>
            <hr>
            <form action="Search.php" method="GET" class="search-form">
                <input type="text" name="filename" placeholder="Filename">
                <input type="text" name="extension" placeholder="Extension">
                <input type="text" name="cid" placeholder="CID">
                <input type="date" name="date">
                <textarea rows="4" cols="100" placeholder="Description" name="description"></textarea>
                <input type="submit" value="Search" name="Search">
            </form>
            <hr>
            <h2>Search Results</h2>
            <table>
            <?php
                if (isset($_GET['Search'])) {
                    $filename = $_GET['filename'];
                    $extension = $_GET['extension'];
                    $cid = $_GET['cid'];
                    $date = $_GET['date'];
                    $description = $_GET['description'];
                } else {
                    $sql = "SELECT * FROM item_profile ORDER BY RANDOM() LIMIT 100";
                    $dbconn = pg_connect("host=localhost port=5432 dbname=cid_database user='username_here' password='password_here'") or die('Could not connect: ' . pg_last_error());
                    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
                    $result = pg_fetch_all($result);
                    pg_close($dbconn);
                    echo print_r($result);
                }
            ?>
            </table>
        </main>
        <footer>
            <nav class="nav">
                <a href="https://github.com/DJC5/IPFS-Codex" target="_blank"><h3 style="display: inline;">GitHub</h3></a>
                <a href="https://ipfs.tech" target="_blank"><h3 style="display: inline;">IPFS Official</h3></a>
            </nav>
        </footer>
    </body>
</html>