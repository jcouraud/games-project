<?php
//File includes
include "includes/functions.php";
include "includes/apitoken.php";
require_once "classes/games.php";

$searchTerm = "";
$searchBy = "";

//Get form data
if(!empty($_POST)){
  $searchTerm = filter_input(INPUT_POST, "searchTerm", FILTER_SANITIZE_STRING);
  $searchBy = filter_input(INPUT_POST, "searchBy", FILTER_SANITIZE_STRING);
  $page = 1;
}else{
  $searchTerm = filter_input(INPUT_GET, "searchTerm", FILTER_SANITIZE_STRING);
  $searchBy = filter_input(INPUT_GET, "searchBy", FILTER_SANITIZE_STRING);
  $page = isset($_GET["page"]) ? filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRING) : 1;
}

//Instantiate class
$games = new games(API_TOKEN);
$title = "";

if($searchBy == "game"){
  $games->searchGames($searchTerm, $page);
  $title = strtoupper($searchTerm);
}elseif($searchBy == "genre"){

}elseif($searchBy == "developer"){

}elseif($searchBy == "tags"){

}elseif($searchBy == "publisher"){

}elseif($searchBy == "platform"){

}

$gameData = $games->getGameData();
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
        <title>My Video Game Project - Search Results</title>
    </head>
    <body>
        <h1>Results for <?php echo $title;?></h1>
        <div id="results">
          <?php
          if(!empty($gameData) && !isset($gameData->detail)){
          ?>
          <table id="results">
            <thead>
              <tr>
                <th>Name</th>
                <th>Released</th>
                <th>Rating</th>
                <th>ESRB</th>
                <th>Platform</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($gameData->results as $game){
              ?>
              <tr>
                <td><a href="game_details.php?gameSlug=<?php echo $game->slug;?>&searchBy=<?php echo $searchBy;?>&searchTerm=<?php echo $searchTerm;?>&page=<?php echo $page;?>" title="<?php echo $game->name;?>" target="_self"><?php echo $game->name;?></a></td>
                <td><?php echo $game->released;?></td>
                <td><?php echo $game->rating;?></td>
                <td><?php
                if(!empty($game->esrb_rating)){
                  echo $game->esrb_rating->name;
                }
                ?></td>
                <td><?php
                if(!empty($game->platforms)){
                  foreach($game->platforms as $platform){
                    echo $platform->platform->name . " | ";
                  }
                }
                ?></td>
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
          <?php
          }else{
            ?>
            <div id="warning">No results found</div>
            <?php
          }
          ?>
          <div id="nav">
            <a href="results.php" title="Previous Page" target="_self">&lt;PREVIOUS</a> |  <a href="index.php" title="New Search" target="_self">NEW SEARCH</a> | <a href="results.php" title="Next Page" target="_self">NEXT&gt;</a>
          </div>
        </div>
    </body>
</html>
