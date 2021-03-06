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
  $games->getGenreDetails($searchTerm);
  $genre = $games->getGenreData();
  if(isset($genre->name)){
    $title = $genre->name;
  }else{
    $title = strtoupper($searchTerm);
  }
  $games->getGenreGames($searchTerm, $page);
}elseif($searchBy == "developer"){
  $games->getDevDetails($searchTerm);
  $dev = $games->getDevData();
  $title = $dev->name;
  $games->getDevGames($searchTerm, $page);
}elseif($searchBy == "tags"){
  $games->getTagDetails($searchTerm);
  $tag = $games->getTagData();
  if(isset($tag->name)){
    $title = $tag->name;
  }else{
    $title = strtoupper($searchTerm);
  }
  $games->getTagGames($searchTerm, $page);
}elseif($searchBy == "publisher"){
  $games->getPubDetails($searchTerm);
  $publisher = $games->getPubData();
  $title = $publisher->name;
  $games->getPubGames($searchTerm, $page);
}elseif($searchBy == "platform"){
  if(is_numeric($searchTerm)){
    $games->getPlatformById($searchTerm);
    $platform = $games->getPlatformData();
    $title = $platform->name;
  }else{
    $games->searchPlatform($searchTerm);
        $platform = $games->getPlatformData();
  }
  $games->getPlatformGames($searchTerm, $page);
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
        if($gameData->count > 0){
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
            <?php
            //Paging
            if(!empty($gameData->previous)){
              $temp = explode("&", $gameData->previous);
              if(array_key_exists(1, $temp) && strpos($temp[1], "page")){
                $previous = "&" . $temp[1];
              }else{
                $previous = "";
              }
            ?>
            <a href="results.php?searchBy=<?php echo $searchBy;?>&searchTerm=<?php echo $searchTerm; echo $previous;?>" title="Previous Page" target="_self">< PREVIOUS</a>
            <?php
            }else{
              ?>
              < PREVIOUS
              <?php
            }
            ?>
            | <a href="index.php" title="New Search" target="_self">NEW SEARCH</a> |
            <?php
            if(!empty($gameData->next)){
              $temp = explode("&", $gameData->next);
              $next = array_key_exists(1, $temp) ? "&" . $temp[1] : "";
            ?>
            <a href="results.php?searchBy=<?php echo $searchBy;?>&searchTerm=<?php echo $searchTerm; echo $next;?>" title="Next Page" target="_self">NEXT ></a>
          <?php
            }else{
              ?>
              NEXT >
              <?php
            }
          ?>
          </div>
        </div>
    </body>
</html>
