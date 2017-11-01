<?php
/*! \file listingmanager.php
 *  \brief Internal library for the connection between the backend and the database for getting and adding listings.
 *  listingmanager.php provides easy way to add, remove and check the listings from the database.
 */
include_once "engine.php";

//TEST METHODS

//echo $listingmanager->getListings(null, null, "item_count", null, 0);
//echo $listingmanager->getListings(true, null, "item_count", null, 0);
//echo $listingmanager->addListing(365548, 233, rand(0,1), rand(1,100), rand(1,100), "I need this item");
//echo $listingmanager->removeListingWithID(29);
//echo $listingmanager->getListingWithID(4);

//! ListingManager class, contains all the functions to manipulate listings.
/*!
 * ListingManager provide the functions to get and send data to the database regarding listings.
 */
Class ListingManager {

  //! This function gets all the listings or only for a certain item.
public function getListings($buying = "both"/*!< Buying or selling */, $itemID = 0 /*!< Item ID to search on, when 0, get every item */, $column = "item_price" /*!< Column name to sort on */, $descending = false/*!< Sort descending or ascending */, $limit = 100/*!< Limit of rows returned */) {
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

      if (null === $itemID) $itemID = 0;
      if (null === $column) $column = "item_price";
      if (null === $descending) $descending = false;
      if (null === $limit) $limit = 100;
      if (0 === $limit) $limit = ~PHP_INT_MIN;

      $sql = "SELECT listing.item_price, listing.item_count, `character`.character_name, item.item_nicename FROM listing " .
             "INNER JOIN `character` ON listing.lodestone_character_id = `character`.lodestone_character_id " .
             "INNER JOIN item ON listing.item_id = item.item_id " .
             "WHERE listing.listing_type = " . ($buying < 2 ? $buying : "0 OR listing.listing_type = 1") .
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
          return "Please supply sell or buy as listingtype";
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
  public function withJson($data,$encodingOptions = 0) {

      $json = json_encode($data, $encodingOptions);

      // Ensure that the json encoding passed successfully
      if ($json === false)
      {
          throw new \RuntimeException(json_last_error_msg(), json_last_error());
      }

      return $json;
  }

  //! This method closes the connection to prevent leaks.
  public function closeConnection($dbo, $stmt) {

    $stmt = null;
    $dbo = null;
  }
}
?>
