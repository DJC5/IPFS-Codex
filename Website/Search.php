<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Web Repository for IPFS CIDs Search">
        <meta name="author" content="DJC5">
        <meta name="keywords" content="IPFS, CID, IPFS CIDs, IPFS Codex, IPFS Database, p2p file sharing, interplanetary file system, peer to peer files, peer to peer technology, peer to peer networking">
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
            <form method="GET" class="search-form">
                <input type="text" name="keyword" placeholder="Keyword">
                <input type="text" name="filename" placeholder="Filename">
                <input type="text" name="extension" placeholder="Extension to search multiple extensions separate by comma *ex. zip,tar,mp4,jpg,bin,pdf*">
                <input type="text" name="cid" placeholder="CID">
                <input type="text" name="date" placeholder="yyyy-mm-dd">
                <textarea rows="4" cols="100" placeholder="Description" name="description"></textarea>
                <input type="checkbox" id="video" name="videotype" value="video">
                <label for="video">Video</label>
                <input type="checkbox" id="image" name="imagetype" value="image">
                <label for="image">Image</label>
                <input type="checkbox" id="audio" name="audiotype" value="audio">
                <label for="audio">Audio</label>
                <input type="checkbox" id="application" name="applicationtype" value="application">
                <label for="application">Application</label>
                <input type="checkbox" id="text" name="texttype" value="text">
                <label for="text">Text</label>
                <input type="checkbox" id="model" name="modeltype" value="model">
                <label for="model">Model</label>
                <input type="checkbox" id="font" name="fonttype" value="font">
                <label for="font">Font</label>
                <input type="checkbox" id="other" name="othertype" value="other">
                <label for="other">Other</label>
                <input type="submit" value="Search" name="Search">
            </form>
            <hr>
            <h2>Search Results</h2>
            <table class ="search-table">
            <?php
                //page switcher 
                $page = 1;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                }
                //Query Builder
                $selector = "";
                echo $type;
                if (isset($_GET['Search']) ) {
                    $selector = "";
                    $keyword = $_GET['keyword'];
                    if ($keyword != "") {
                        $selector = "filename LIKE '%$keyword%' OR ext LIKE '%$keyword%' OR description LIKE '%$keyword%' AND";
                    }
                    $filename = $_GET['filename'];
                    if ($filename != "") {
                        $selector = $selector . " filename LIKE '%$filename%' AND";
                    }
                    $extension = $_GET['extension'];
                    if ($extension != "") {
                        $extension = explode(",", $extension);
                        foreach ($extension as $type) {
                            $selector = $selector . " ext LIKE '%$type%' OR";
                        }
                        $selector = substr($selector, 0, -2) . " AND";
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
                    $type = array($_GET['videotype'], $_GET['imagetype'], $_GET['audiotype'], $_GET['applicationtype'], $_GET['texttype'], $_GET['modeltype'], $_GET['fonttype'], $_GET['othertype']);
                    foreach ($type as $value) {
                        if ($value != "") {
                            $selector = $selector . " type = '$value' OR";
                        }
                    }
                    $selector = substr($selector, 0, -3);
                    $selector = "WHERE $selector";
                }
                echo "$selector";
                $sql = "SELECT filename, ext, cid, link, creation_date, description FROM item_profile $selector LIMIT 100 OFFSET " . ($page - 1) * 100;
                $dbconn = pg_connect("host=localhost port=5432 dbname=cid_database user='phpdb' password='Djungelskog'") or die('Could not connect: ' . pg_last_error());
                $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
                $result = pg_fetch_all($result);
                pg_close($dbconn);
                //Display results
                echo "<tr><th>Filename</th><th>Extension</th><th>CID</th><th>Link</th><th>Date</th><th>Description</th></tr>";
                $count = count($result);
                foreach ($result as $row) {
                    echo "<tr><td>$row[filename]</td><td>$row[ext]</td><td>$row[cid]</td><td>$row[link]</td><td>$row[creation_date]</td><td class='table-description'>$row[description]</td></tr>";
                }
                echo "</table>";
                //page switcher
                if ($count >= 1) {
                    echo '<button id="next" type="button" onclick="nextPage()" value="' . $page + 1 . '" class="options">Next</button>';
                }
                if ($page > 1) {
                    echo '<button id="previous" type="button" onclick="previousPage()" value="' . $page . '" class="options">Previous</button>';
                }
            ?>
            <script>
                function nextPage() {
                    var page = document.getElementById("next").value;
                    if (page > 2) {
                        window.location.href = window.location.href.replace("?&page=" + (page - 1), "?&page=" + page);
                    }
                    else {
                    window.location.href = window.location.href + "?&page=" + page;
                    }
                }
                function previousPage() {
                    var page = document.getElementById("previous").value;
                    window.location.href = window.location.href.replace("?&page=" + page, "?&page=" + (page - 1));
                    if (page == 2) {
                        window.location.href = window.location.href.replace("?&page=2" , "");
                    }
                }
            </script>
        </main>
        <footer>
            <nav class="nav">
                <a href="https://github.com/DJC5/IPFS-Codex" target="_blank"><h3 style="display: inline;">GitHub</h3></a>
                <a href="https://ipfs.tech" target="_blank"><h3 style="display: inline;">IPFS Official</h3></a>
            </nav>
        </footer>
    </body>
</html>