<?php

function select_by_name($name)
{

  require_once('database.php');
  $res = array();

  try {

    $dbh = new PDO(PDO_DSN, PDO_USER, PDO_PASSWD);
    $sql = 'SELECT * FROM users WHERE name = :name';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {

    echo $e->getMessage();
  } finally {

    $dbh = null;
    return $res;
  }
};

function insert_new($name, $password)
{

  require_once('database.php');
  $res_count = 0;

  try {

    $dbh = new PDO(PDO_DSN, PDO_USER, PDO_PASSWD);
    $dbh->beginTransaction();
    $sql = 'INSERT INTO users ( name,password ) VALUES ( :name,:password )';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $res = $stmt->execute();
    if ($res) {
      $dbh->commit();
    }
    // echo $res;
  } catch (PDOException $e) {

    echo $e->getMessage();
    $dbh->rollBack();
  } finally {

    $dbh = null;
    return $res;
  }
};

function query_update($argSQL)
{
};

function query_delete($argSQL)
{
};
