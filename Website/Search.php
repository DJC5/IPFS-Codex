<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Web Repository for IPFS CIDs Search">
        <meta name="author" content="DJC5">
        <meta name="keywords" content="IPFS, CID, IPFS CIDs, IPFS Codex, IPFS Database, p2p file sharing, interplanetary file system, peer to peer files, peer to peer technology">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IPFS Codex | Search</title>
        <link rel="stylesheet" href="Style.css">
    </head>
    <body style="color:#383B4B;">
        <header>
            <br>
            <h1>IPFS Codex</h1>
            <img src="Resources/Logo.webp" alt="Logo" class="logo">
            <nav class="nav">
                <a href="index.html"><h3>Home</h3></a>
                <a href="Search.php"><h3>Search</h3></a>
                <a href="Form.html"><h3>Add to Database</h3></a>
                <a href="Guide.html"><h3>How To</h3></a>
                <a href="About.html"><h3>About</h3></a>
            </nav>
        </header>
        <main>
            <hr>
            <form action="Search.php" method="GET" class="search-form">
                <input type="text" name="filename" placeholder="Filename">
                <input type="text" name="extension" placeholder="Extension">
                <input type="text" name="cid" placeholder="CID">
                <input type="text" name="date" placeholder="yyyy-mm-dd">
                <textarea rows="4" cols="100" placeholder="Description" name="description"></textarea>
                <input type="submit" value="Search" name="Search">
            </form>
            <hr>
            <h2>Search Results</h2>
            <table class ="search-table">
            <?php
                $selector = "ORDER BY RANDOM() LIMIT 100";
                if (isset($_GET['Search']) ) {
                    $selector = "";
                    $filename = $_GET['filename'];
                    if ($filename != "") {
                        $selector = "filename LIKE '%$filename%' AND";
                    }
                    $extension = $_GET['extension'];
                    if ($extension != "") {
                        $selector = $selector . " ext LIKE '%$extension%' AND";
                    }
                    $cid = $_GET['cid'];
                    if ($cid != "") {
                        $selector = $selector . " cid LIKE '%$cid%' AND";
                    }
                    $date = $_GET['date'];
                    if ($date != "") {
                        $selector = $selector . " creation_date = '$date' AND";
                    }
                    $description = $_GET['description'];
                    if ($description != "") {
                        $selector = $selector . " description LIKE '%$description%' AND";
                    }
                    $selector = substr($selector, 0, -3);
                    $selector = "WHERE $selector LIMIT 200";
                }
                echo "$selector";
                $sql = "SELECT * FROM item_profile $selector";
                $dbconn = pg_connect("host=localhost port=5432 dbname=cid_database user='' password=''") or die('Could not connect: ' . pg_last_error());
                $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
                $result = pg_fetch_all($result);
                pg_close($dbconn);
                //Display results
                echo "<tr><th>Filename</th><th>Extension</th><th>CID</th><th>Link</th><th>Date</th><th>Description</th></tr>";
                foreach ($result as $row) {
                    echo "<tr><td>$row[filename]</td><td>$row[ext]</td><td>$row[cid]</td><td>$row[link]</td><td>$row[creation_date]</td><td class='table-description'>$row[description]</td></tr>";
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