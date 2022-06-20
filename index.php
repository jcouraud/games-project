<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Press+Start+2P">
        <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=DotGothic16">
        <link href="styles/styles.css" rel="stylesheet" type="text/css"/>
        <title>My Video Game Project</title>
    </head>
    <body>
        <!-- Search Form -->
        <div id="main">
          <form action="results.php" method="post" enctype="multipart/form-data" name="searchForm">
            <label for="searchTerm"></label>
            <input type="text" id="searchTerm" name="searchTerm" placeholder="SEARCH" /><br />
            <label for="searchBy">Search By:</label>
            <input type="radio" id="game" name="searchBy" value="game" checked="checked" />
            <label for="game">Name</label>
            <input type="radio" id="genre" name="searchBy" value="genre" />
            <label for="genre">Genre</label>
            <input type="radio" id="tag" name="searchBy" value="tags" />
            <label for="tag">Tag</label><br />
            <input id="submit" type="submit" />
          </form>
          <div id="category">
            <ul>
              <li>View All:</li>
              <li><a href="platforms.php" title="Search by Platform" target="_self">Platforms</a></li>
              <li><a href="developers.php" title="Search by Developer" target="_self">Developers</a></li>
              <li><a href="publishers.php" title="Search by Publisher" target="_self">Publishers</a></li>
            </ul>
          </div>
        </div>
    </body>
</html>
