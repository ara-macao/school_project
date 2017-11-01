<?php
/*! \file listingmanager.php
 *  \This file is the connection between the backend and the database for getting and adding listings.
 *  listingmanager.php provides easy way to add, remove and check the listings from the database.
 */
include_once "engine.php";

//! Instantiates the ListingManager class so it can be used instantly.
$listingmanager = new ListingManager();

//TEST METHODS

//echo $listingmanager->getListings(true, 0, "item_price");
//echo $listingmanager->addListing(365548, 233, rand(0,1), rand(1,100), rand(1,100), "I need this item");
//echo $listingmanager->removeListingWithID(29);
//echo $listingmanager->getListingWithID(4);

//! ListingManager class, contains all the functions to manipulate listings.
/*!
 * Class that contains the functions to get and send data to the database regarding listings.
 */
Class ListingManager
{
  //! This function gets all the listings or only for a certain item.
  public function getListings($buying = true/*!< Buying or selling */, $itemID = 0 /*!< Item ID to search on, when 0, get every item */, $column = "item_price" /*!< Column name to sort on */, $descending = true/*!< Sort descending or ascending */, $limit = 50/*!< Limit of rows returned */)
  {
      $PDO = getPDO();

      $sql = "SELECT listing.item_price, listing.item_count, `character`.character_name, item.item_nicename FROM listing " .
             "INNER JOIN `character` ON listing.lodestone_character_id = `character`.lodestone_character_id " .
             "INNER JOIN item ON listing.item_id = item.item_id " .
             "WHERE listing.listing_type = " . (int)$buying .
             ($itemID == 0 ? " " : " && listing.item_id = " . $itemID . " ") .
             "ORDER BY " . $column . " " . ($descending ? "DESC " : "ASC ") .
             "LIMIT " . $limit;

      //return $sql;

      $stmt = $PDO->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();

      self::closeConnection($PDO, $stmt);

      return self::withJson($result);
  }

  //! This function adds a listing to the database.
  public function addListing($characterID/*!< Character ID */, $itemID/*!< Item ID */, $listingType/*!< Buying or Selling */, $itemPrice/*!< Price per Item */, $itemCount /*!<Item Count */, $comment = null/*!< The comment text */)
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

  //! This function removes a listing with the given ID.
  public function removeListingWithID($listingId/*!< The ID of the listing */)
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

  //! Gets function removes a listing with the given ID;
  public function getListingWithID($listingId/*!< The ID of the listing */)
  {
      $PDO = getPDO();

      $sql = "SELECT item.item_nicename, item.item_description, item.item_image_url, listing.item_price, listing.item_count, `character`.character_name, listing.comment FROM listing " .
             "INNER JOIN `character` ON listing.lodestone_character_id = `character`.lodestone_character_id " .
             "INNER JOIN item ON listing.item_id = item.item_id " .
             "WHERE listing.listing_id = " . $listingId;

      $stmt = $PDO->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();

      self::closeConnection($PDO, $stmt);

      return self::withJson($result);
  }


  //! This is a method that converts any data to perfectly readable JSON and adds headers to secure the data type.
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


  //! This method closes the connection to prevent leaks.
  public function closeConnection($dbo, $stmt)
  {
    $stmt = null;
    $dbo = null;
  }
}
?>
