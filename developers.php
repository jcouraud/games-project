<?php
//File includes
include "includes/functions.php";
include "includes/apitoken.php";
require_once "classes/games.php";

$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRING);

//Retrieve developer details
$game = new games(API_TOKEN);
$game->getDevelopers($page);
$developers = $game->getDevData();
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
        <title>Developer Search Results</title>
    </head>
    <body>
        <h1>Available Developers</h1>
        <?php
        if(!empty($developers)){
        ?>
        <table>
          <thead>
            <tr>
              <th>Developers</th>
              <th>Games Count</th>
            </tr>
          </thead>
          <tbody>
          <?php
        foreach ($developers->results as $developer){
            ?>
            <tr>
              <td><a href="results.php?searchBy=developer&searchTerm=<?php echo $developer->slug;?>" title="Details for <?php echo $developer->name;?>" target="_self"><?php echo $developer->name;?></a></td>
              <td><?php echo $developer->games_count;?></td>
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
    <?php
    //Paging
    if(!empty($developers->previous)){
        $temp = explode("&", $developers->previous);
        $previous = array_key_exists(1, $temp) ? explode("=", $temp[1]) : "";
        $page = "";
        if(array_key_exists(1, $temp)){
            if(is_numeric($previous[1])){
                $page = "?page=$previous[1]";
            }
        }
        ?>
        <a href="developers.php<?php echo $page;?>" title="Previous Page" target="_self">< PREVIOUS</a>
        <?php
    }else{
        ?>
        < PREVIOUS
        <?php
    }
    ?>
          | <a href="index.php" title="New Search" target="_self">NEW SEARCH</a> |
    <?php

    $next = "";
    if(!empty($developers->next)){
        $temp = explode("&", $developers->next);
        $next = explode("=", $temp[1]);
        ?>
        <a href="developers.php?page=<?php echo $next[1];?>" title="Next Page" target="_self">NEXT ></a>
        <?php
    }else{
        ?>
        NEXT >
        <?php
    }
    ?>
        </div>
    </body>
</html>
