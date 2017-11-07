<?php
/*! \file listingmanager.php
 *  \brief Internal library for the connection between the backend and the database for getting and adding listings.
 *  listingmanager.php provides easy way to add, remove and check the listings from the database.
 */
include_once "engine.php";

//TEST METHODS

//$listingmanager = new ListingManager();
//echo $listingmanager->getListings(null, null, "item_count", null, 0);
//echo $listingmanager->getListings(true, null, "item_count", null, 0);
//echo $listingmanager->addListing(365548, 233, rand(0,1), rand(1,100), rand(1,100), "I need this item");
//echo $listingmanager->removeListingWithID(29);
//echo $listingmanager->getItemByName("Donkey Ear reversal potion");

//! ListingManager class, contains all the functions to manipulate listings.
/*!
 * ListingManager provide the functions to get and send data to the database regarding listings.
 */
Class ListingManager {

  //! This function gets all the listings or only for a certain item.
public function getListings($buying = "both"/*!< Buying or selling */, $serverid = 0, $itemID = 0 /*!< Item ID to search on, when 0, get every item */, $column = "item_price" /*!< Column name to sort on */, $descending = false/*!< Sort descending or ascending */, $limit = 0/*!< Limit of rows returned */) {
      $PDO = getPDO();

      switch ($buying) {
        case "sell":
          $buying = 0;
          break;
        case "buy":
          $buying = 1;
          break;
        default:
          $buying = 2;
          break;
        }

      if (null === $serverid) $serverid = 0;
      if (null === $itemID) $itemID = 0;
      if (null === $column) $column = "item_price";
      if (null === $descending) $descending = false;
      if (null === $limit) $limit = 0;
      if (0 === $limit) $limit = ~PHP_INT_MIN;

      $sql = "SELECT listing.item_price, listing.item_count, `character`.character_name, item.item_nicename, listing.listing_type, listing.listing_id FROM listing " .
             "INNER JOIN `character` ON listing.lodestone_character_id = `character`.lodestone_character_id " .
             "INNER JOIN item ON listing.item_id = item.item_id " .
             "INNER JOIN server ON `character`.character_server = server.id " .
             "WHERE (listing.listing_type = " . ($buying < 2 ? $buying : "0 OR listing.listing_type = 1 ") .")" .
             "&& server.id = " . $serverid . " " .
             ($itemID == 0 ? "" : " && listing.item_id = " . $itemID . " ") .
             "ORDER BY " . $column . ", item_count " . ($descending ? "DESC " : "ASC ") .
             "LIMIT " . $limit;

      //return $sql;

      $stmt = $PDO->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();

      self::closeConnection($PDO, $stmt);

      return self::withJson($result);
  }

  //! This function adds a listing to the database.
  public function addListing($characterID/*!< Character ID */, $itemID/*!< Item ID */, $listingType/*!< Buying or Selling */, $itemPrice/*!< Price per Item */, $itemCount /*!<Item Count */, $comment = null/*!< The comment text */) {
      $PDO = getPDO();

      switch ($listingType) {
        case "sell":
          $listingType = 0;
          break;
        case "buy":
          $listingType = 1;
          break;

        default:
          break;
      }

      $sql = "INSERT INTO listing (lodestone_character_id, item_id, listing_type, item_price, item_count, comment) VALUES (:characterId, :itemId, :listingType, :item_price, :item_count, :comment)";

      $stmt = $PDO->prepare($sql);
      $stmt->bindValue(':characterId', $characterID);
      $stmt->bindValue(':itemId', $itemID);
      $stmt->bindValue(':listingType', $listingType);
      $stmt->bindValue(':item_price', $itemPrice);
      $stmt->bindValue(':item_count', $itemCount);
      $stmt->bindValue(':comment', $comment);

      $stmt->execute();
      $result = $stmt->fetchAll();

      self::closeConnection($PDO, $stmt);

      if($result !== false)
      {
        return "It worked";
      }
      else
      {
        return "It didn't work";
      }
  }

  //! This function removes a listing with the given ID.
  public function removeListingWithID($listingId/*!< The ID of the listing */) {

      $PDO = getPDO();

      $sql = "DELETE FROM listing WHERE listing.listing_id = " . $listingId;

      $stmt = $PDO->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();

      self::closeConnection($PDO, $stmt);

      if($result !== false)
      {
        return "It worked";
      }
      else
      {
        return "It didn't work";
      }
  }

  //! Gets function removes a listing with the given ID;
  public function getListingWithID($listingId/*!< The ID of the listing */) {

      $PDO = getPDO();

      $sql = "SELECT item.item_nicename, item.item_description, item.item_image_url, listing.item_price, listing.item_count, `character`.character_name, listing.comment, server.server AS server_name FROM listing " .
             "INNER JOIN `character` ON listing.lodestone_character_id = `character`.lodestone_character_id " .
             "INNER JOIN server ON `character`.character_server = server.id " .
             "INNER JOIN item ON listing.item_id = item.item_id " .
             "WHERE listing.listing_id = " . $listingId;

      $stmt = $PDO->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();

      self::closeConnection($PDO, $stmt);

      return self::withJson($result);
  }

  //! This is a method that converts any data to perfectly readable JSON and adds headers to secure the data type.
  public function withJson($data,$encodingOptions = 0) {

      $json = json_encode($data, $encodingOptions);

      // Ensure that the json encoding passed successfully
      if ($json === false)
      {
          throw new \RuntimeException(json_last_error_msg(), json_last_error());
      }

      return $json;
  }

  //! This method finds listings which contains certain characters.
public function getFilteredListings($serverid = 0, $searchValue = "") {
      $PDO = getPDO();
      if (null === $serverid) $serverid = 0;

      $likeValue = '%'. strtolower($searchValue) . '%';

      $sql = "SELECT listing.item_price, listing.item_count, `character`.character_name, item.item_nicename, listing.listing_type, listing.listing_id FROM listing " .
             "INNER JOIN `character` ON listing.lodestone_character_id = `character`.lodestone_character_id " .
             "INNER JOIN item ON listing.item_id = item.item_id " .
             "INNER JOIN server ON `character`.character_server = server.id " .
             "&& server.id = " . $serverid . " " .
             "WHERE lower(item.item_nicename) like ?";
             "ORDER BY item_price" .
             "LIMIT 100";

      //return $sql;

      $stmt = $PDO->prepare($sql);
      $stmt->execute([$likeValue]);
      $result = $stmt->fetchAll();

      self::closeConnection($PDO, $stmt);

      return self::withJson($result);
  }

  //! This method closes the connection to prevent leaks.
  public function closeConnection($dbo, $stmt)
  {
    $stmt = null;
    $dbo = null;
  }

  //! return false when the conditions aren't met. Returns true if the string contains number % 3 = 0 characters
  public function getItemNames($characters)
  {
    if(strlen($characters) > 0){
        $PDO = getPDO();
        $sql = 'SELECT `item_nicename` FROM item WHERE lower(item_nicename) like ? limit 5';
        $likeValue = '%'. strtolower($characters) . '%';

        $stmt = $PDO->prepare($sql);
        $stmt->execute([$likeValue]);
        $result = $stmt->fetchAll();
        return $result;

    }else{
      return false;
    }
  }

  public function getItemByName($name)
  {
    $PDO = getPDO();
    $sql = "SELECT item_id, item_nicename AS name, item_description AS description, item_image_url AS icon FROM item WHERE item_nicename = '$name'";

    $stmt = $PDO->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $imageIsSet = ($result[0]['icon'] == "" || $result[0]['icon'] == NULL) ? 0 : 1;

    if ($imageIsSet == 0)
    {
      $itemID = $result[0]['item_id'];
      $ch = curl_init('https://api.xivdb.com/item/' . $itemID);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      $data = curl_exec($ch);
      curl_close($ch);

      $json = json_decode($data,true);
      $url = $json['icon_hq'];
      $lodestone = $json['url_lodestone'];

      preg_match('/db\/item\/(\w+)/', $lodestone, $result);
      if($result)
      {
        $lodestone = $result[1];
      }
      else
      {
        $lodestone = null;
      }

      $sql = "UPDATE item SET item_image_url='$url', lodestone_item_id='$lodestone' WHERE item_id='$itemID'";

      $stmt = $PDO->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();

      $sql = "SELECT item_id, item_nicename AS name, item_description AS description, item_image_url AS icon FROM item WHERE item_nicename = '$name'";

      $stmt = $PDO->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
    }

    self::closeConnection($PDO, $stmt);

    return self::withJson($result);
  }
}
?>
