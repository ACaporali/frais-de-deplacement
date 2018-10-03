<?php

namespace App\Entity;

/**
 * City
 * Table : CityTable
 */
class City
{
  protected $id;
  protected $name;

  function __construct()
  {
    // code...
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;

    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;

    return $this->name;
  }
}

?>
