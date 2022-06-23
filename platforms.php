<?php
//File includes
include "includes/functions.php";
include "includes/apitoken.php";
require_once "classes/games.php";

//Retrieve platform details
$game = new games(API_TOKEN);
$game->getPlatforms();
$platforms = $game->getPlatformData();
?>
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
        <title>Platform Search Results</title>
    </head>
    <body>
        <h1>Available Platforms</h1>
        <?php
        if(!empty($platforms)){
        ?>
        <table>
          <thead>
            <tr>
              <th>Platforms</th>
              <th>Games Count</th>
            </tr>
          </thead>
          <tbody>
            <?php
        foreach ($platforms->results as $platform){
            ?>
            <tr>
              <td><a href="results.php?searchBy=platform&searchTerm=<?php echo $platform->id;?>" title="Details for <?php echo $platform->name;?>" target="_self"><?php echo $platform->name;?></a></td>
              <td><?php echo $platform->games_count;?></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <?php
        }
        ?>
        <div id="nav">
          <a href="index.php" title="New Search" target="_self">NEW SEARCH</a>
        </div>
    </body>
</html>
