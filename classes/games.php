<?php 
//Class to get game data from RAWG
class games{
    private $apiToken;
    private $gameData;
    private $genreData;
    private $platformData;
    private $devData;
    private $pubData;
    private $tagData;

    //constructor class
    public function __construct($token){
        $this->apiToken = $token;
    }

    //search for video game
    public function searchGames($searchTerm, $page=1){
        $abortSearch = $this->checkSearchTerm($searchTerm);
        if($abortSearch){
            return;
        }
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/games?search=$searchTerm&page=$page" . "&key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);

        curl_close($cRequest);

        $this->setGameData($output);
    }

    //set game data
    private function setGameData($data){
        $this->gameData = json_decode($data);
    }

    //retrieve game data
    public function getGameData(){
        return $this->gameData;
    }

    //retrieve game details from api
    public function getGameDetails($slug){
        $abortSearch = $this->checkSearchTerm($slug);
        if($abortSearch){
            return;
        }
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/games/$slug" . "?key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setGameData($output);
    }

    
    //retrieve Genre information
    public function getGenreGames($slug, $page=1){
        $abortSearch = $this->checkSearchTerm($slug);
        if($abortSearch){
            return;
        }
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/games?genres=$slug&page=$page" . "&key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setGameData($output);
    }

    //retrieve Developer games from API
    public function getDevGames($slug, $page=1){
        $abortSearch = $this->checkSearchTerm($slug);
        if($abortSearch){
            return;
        }
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/games?developers=$slug&page=$page" . "&key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setGameData($output);
    }

    //retrieve tag information
    public function getTagGames($slug, $page=1){
        $abortSearch = $this->checkSearchTerm($slug);
        if($abortSearch){
            return;
        }
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/games?tags=$slug&page=$page" . "&key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setGameData($output);
    }

    //retrieve publisher information
    public function getPubGames($slug, $page=1){
        $abortSearch = $this->checkSearchTerm($slug);
        if($abortSearch){
            return;
        }
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/games?publishers=$slug&page=$page" . "&key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setGameData($output);
    }

    //retrieve platform information
    public function getPlatformGames($id, $page=1){
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/games?platforms=$id&page=$page" . "&key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setGameData($output);
    }

    //get platform details from API
    public function getPlatformById($id){
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/platforms/$id" . "?key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setPlatformDetails($output);
    }

    //set platform details
    private function setPlatformDetails($data){
        $this->platformData = json_decode($data);
    }

    //return platform details
    public function getPlatformData(){
        return $this->platformData;
    }

    //get genre details from API
    public function getGenreDetails($id){
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/genres/$id" . "?key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setGenreDetails($output);
    }

    //set genre details
    private function setGenreDetails($data){
        $this->genreData = json_decode($data);
    }

    //return genre details
    public function getGenreData(){
        return $this->genreData;
    }

    //retrieve developer details from the API
    public function getDevDetails($id){
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/developers/$id" . "?key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setDevDetails($output);
    }

    //set genre details
    private function setDevDetails($data){
        $this->devData = json_decode($data);
    }

    //return genre details
    public function getDevData(){
        return $this->devData;
    }

    //retrieve publisher details from the API
    public function getPubDetails($id){
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/publishers/$id" . "?key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setPubDetails($output);
    }

    //set publisher details
    private function setPubDetails($data){
        $this->pubData = json_decode($data);
    }

    //return publisher details
    public function getPubData(){
        return $this->pubData;
    }

    //retrieve tag details from the API
    public function getTagDetails($id){
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/tags/$id" . "?key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setTagDetails($output);
    }

    //set tag details
    private function setTagDetails($data){
        $this->tagData = json_decode($data);
    }

    //return tag details
    public function getTagData(){
        return $this->tagData;
    }

    //retrieve platform data from API
    public function getPlatforms(){
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/platforms" . "?key=$this->apiToken");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setPlatformDetails($output);
    }
    
    //retrieve developer data from API
    public function getDevelopers($page=1){
        
        $paging = "";
        if($page > 1){
            $paging = "&page=$page";
        }
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/developers" . "?key=$this->apiToken$paging&page_size=25");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setDevDetails($output);
    }
    
    //retrieve publisher data from API
    public function getPublishers($page=1){
        
        $paging = "";
        if($page > 1){
            $paging = "&page=$page";
        }
        $cRequest = curl_init();
        curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/publishers" . "?key=$this->apiToken$paging&page_size=25");

        curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $output = curl_exec($cRequest);
        
        curl_close($cRequest);

        $this->setPubDetails($output);
    }
    
    //retrieve random image from API
    public function getRandomImage(){
                
        $found = false;
        while(!$found){
            $game_id = rand(1, 50000);
            $cRequest = curl_init();
            curl_setopt($cRequest, CURLOPT_URL, "https://api.rawg.io/api/games/$game_id?key=$this->apiToken");

            curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($cRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

            $output = curl_exec($cRequest);
            
            curl_close($cRequest);

            $this->setGameData($output);
            //printRdie($this->gameData);
            if(!isset($this->gameData->detail)){
                $found = $this->checkRating($this->gameData->esrb_rating);
            }
        }
        
        return $this->gameData->background_image;
    }
    
    //check game rating
    private function checkRating($rating){
        if(!empty($rating)){
            if($rating->name != "Adults Only"){
                return true;
            }
        }
    }
    
    private function checkSearchTerm($searchTerm){
        $bannedTerms = array("fuck", "sex", "shit");
        if(in_array($searchTerm, $bannedTerms)){
            return true;
        }else{
            return false;
        }
    }
}
?>