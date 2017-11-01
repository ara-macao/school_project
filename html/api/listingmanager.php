<?php

include_once "engine.php";
$listingmanager = new ListingManager();

//TEST METHODS

//echo $listingmanager->addListing(365548, 233, rand(0,1), rand(1,100), rand(1,100), "I need this item");
//echo $listingmanager->getListings(true, 233, "item_price");
//echo $listingmanager->removeListingWithID(29);
//echo $listingmanager->getListingWithID(1);

Class ListingManager
{
  /*
   * This function gets all the listings.
   * If the desired listing type is given, it will only get the buying OR selling results.
   * If an item ID is given, it will only return the listings regarding that item.
   * The results can be sorted using the name of the column and a true or false for ascending or descending.
   * The standard limit of orders will be 50, but this limit can also be lowered or raised.
   */
  public function getListings($buying = true, $itemID = 0, $column = "listing_id", $descending = true, $limit = 50)
  {
      $PDO = getPDO();

      $sql = "SELECT * FROM listing " .
              "WHERE listing_type = " . (int)$buying .
              ($itemID == 0 ? " " : " && item_id = " . $itemID . " ") .
              "ORDER BY " . $column . " " . ($descending ? "DESC " : "ASC ") .
              "LIMIT " . $limit;

      $stmt = $PDO->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();

      self::closeConnection($PDO, $stmt);

      return self::withJson($result);
  }

  /*
   * This function adds a listing to the database using a given in-game character ID, an item ID, a Listing type
   * (buying or selling), an item price, an item count and comment;
   */
  public function addListing($characterID, $itemID, $listingType, $itemPrice, $itemCount, $comment = null)
  {
      $PDO = getPDO();

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

  /*
   * This function removes a listing with the given ID;
   */
  public function removeListingWithID($listingId)
  {
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

  /*
   * Gets function removes a listing with the given ID;
   */
  public function getListingWithID($listingId)
  {
      $PDO = getPDO();

      $sql = "SELECT * FROM listing WHERE listing.listing_id = " . $listingId;

      $stmt = $PDO->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();

      self::closeConnection($PDO, $stmt);

      return self::withJson($result);
  }

  /*
   * This is a method that converts any data to perfectly readable JSON and adds headers to secure the data type.
   */
  public function withJson($data,$encodingOptions = 0)
  {
      $json = json_encode($data, $encodingOptions);

      // Ensure that the json encoding passed successfully
      if ($json === false)
      {
          throw new \RuntimeException(json_last_error_msg(), json_last_error());
      }

      return $json;
  }

  /*
   * This method closes the connection to prevent leaks.
   */
  public function closeConnection($dbo, $stmt)
  {
    $stmt = null;
    $dbo = null;
  }
}
?>
