<?php

Class ordermanager
{
  /*
  This is a method that converts any PDO result to perfect JSON and adds headers to secure the data type.
  */
  public function getLatestOrders($pdo, $amount = 5)
  {
      $query = 'SELECT * FROM order LIMIT "$amount"';

      $stmt = $pdo->prepare($query);
      $stmt->execute();
      $result = $stmt->fetch();

      return withJson($result)
  }

  public function postOrder($pdo)
  {
      $stmt = 'INSERT';

      $pdo->prepare($stmt);
      $stmt->execute();
      $result = $stmt->fetch();

      return withJson($result);
  }

  public function removeOrderWithID($pdo)
  {
      $stmt = 'DELETE';

      $pdo->prepare($stmt);
      $stmt->execute();
      $result = $stmt->fetch();
  }

  public function getOrderWithID($pdo, $id)
  {
      $stmt = 'SELECT * FROM order WHERE ID = "$id"';

      $pdo->prepare($stmt);
      $stmt->execute();
      $result = $stmt->fetch();
  }

  /*
  This is a method that converts any data to perfectly readable JSON and adds headers to secure the data type.
  */
  public function withJson($data, $status = null, $encodingOptions = 0)
  {
      $response = $this->withBody(new Body(fopen('php://temp', 'r+')));
      $response->body->write($json = json_encode($data, $encodingOptions));

      // Ensure that the json encoding passed successfully
      if ($json === false)
      {
          throw new \RuntimeException(json_last_error_msg(), json_last_error());
      }

      $responseWithJson = $response->withHeader('Content-Type', 'application/json;charset=utf-8');
      if (isset($status))
      {
          return $responseWithJson->withStatus($status);
      }
      return $responseWithJson;
  }
}
?>
