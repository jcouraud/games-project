<?php
//File includes
include "includes/functions.php";
include "includes/apitoken.php";
require_once "classes/games.php";

//Retrieve game identifier
$gameSlug = filter_input(INPUT_GET, "gameSlug", FILTER_SANITIZE_STRING);
$searchBy = filter_input(INPUT_GET, "searchBy", FILTER_SANITIZE_STRING);
$searchTerm = filter_input(INPUT_GET, "searchTerm", FILTER_SANITIZE_STRING);
$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);

//Retrieve game details
$game = new games(API_TOKEN);
$game->getGameDetails($gameSlug);
$gameDetails = $game->getGameData();
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
        <title>Details for <?php echo $gameDetails->name;?></title>
        <style>
          #background_image {
            max-height: 250px;
          }
        </style>
    </head>
    <body>
        <div>
          <h1><?php echo $gameDetails->name;?></h1>
          <!-- Display game details -->
          <table id="gameDetails">
            <tr>
              <td colspan="2" style="text-align:center;"><img id="background_image" src="<?php echo $gameDetails->background_image;?>" /></td>
            </tr>
            <?php
            if(!empty($gameDetails->website)){
            ?>
            <tr>
              <th>Website</th>
              <td><a href="<?php echo $gameDetails->website;?>" title="Website for <?php echo $gameDetails->name;?>" target="_blank"><?php echo $gameDetails->website;?></a></td>
            </tr>
            <?php
            }
            ?>
            <tr>
              <th>Description</th>
              <td><?php echo $gameDetails->description;?></td>
            </tr>
            <tr>
              <th>Released</th>
              <td><?php echo $gameDetails->released;?></td>
            </tr>
            <tr>
              <th>Platforms</th>
              <td>
              <?php
              //display available platforms
              foreach($gameDetails->platforms as $platform){
                ?>
                <a href="results.php?searchBy=platform&searchTerm=<?php echo $platform->platform->id;?>" title="Details for <?php echo $platform->platform->name;?>" target="_self"><?php echo $platform->platform->name;?></a> | 
                <?php
              }
              ?>
              </td>
            </tr>
            <tr>
              <th>Metacritic Ratings</th>
              <td><?php echo $gameDetails->metacritic;?></td>
            </tr>
            <tr>
              <th>Avg User Ratings</th>
              <td><?php echo $gameDetails->rating;?></td>
            </tr>
            <tr>
              <th>ESRB Rating</th>
              <td><?php
              if(isset($gameDetails->esrb_rating->name)){
                echo $gameDetails->esrb_rating->name;
              }
              ?></td>
            </tr>
            <tr>
              <th>Developers</th>
              <td>
              <?php
                //create links for developers
              foreach($gameDetails->developers as $developer){
                ?>
                <a href="results.php?searchBy=developer&searchTerm=<?php echo $developer->slug;?>" title="Details for <?php echo $developer->name;?>" target="_self"><?php echo $developer->name;?></a> | 
                <?php
              }
              ?>
              </td>
            </tr>
            <tr>
              <th>Genres</th>
              <td>
              <?php
              //create links for genres
              foreach($gameDetails->genres as $genre){
                ?>
                <a href="results.php?searchBy=genre&searchTerm=<?php echo $genre->slug;?>" title="Details for <?php echo $genre->name;?>" target="_self"><?php echo $genre->name;?></a> |
                <?php
              }
              ?>
              </td>
            </tr>
            <tr>
              <th>Tags</th>
              <td>
              <?php
              //display tag information
              foreach($gameDetails->tags as $tag){
                ?>
                <a href="results.php?searchBy=tags&searchTerm=<?php echo $tag->slug;?>" title="Details for <?php echo $tag->name;?>" target="_self"><?php echo $tag->name;?></a> | 
                <?php
              }
              ?>
              </td>
            </tr>
            <tr>
              <th>Publishers</th>
              <td>
              <?php
                //display publishers
                foreach($gameDetails->publishers as $publisher){
                ?>
                    <a href="results.php?searchBy=publisher&searchTerm=<?php echo $publisher->slug;?>" title="Link to <?php echo $publisher->name;?>" target="_self"><?php echo $publisher->name;?></a> | 
                <?php
              }
              ?>
              </td>
            </tr>
            <?php
            //display store information
            foreach($gameDetails->stores as $store){
            ?>
            <tr>
              <th><?php echo $store->store->name;?></th>
              <td><a href="http://<?php echo $store->store->domain;?>" title="Link to <?php echo $store->store->name;?>" target="_blank"><?php echo $store->store->name;?></a></td>
            </tr>
            <?php
            }
            ?>
          </table>
          <div id="nav"> <a href="results.php?searchBy=<?php echo $searchBy;?>&searchTerm=<?php echo $searchTerm;?>&page=<?php echo $page;?>" title="Return to Results" target="_self">Return to Results</a> | <a href="index.php" title="New Search" target="_self">NEW SEARCH</a></div>
        </div>
    </body>
</html>
