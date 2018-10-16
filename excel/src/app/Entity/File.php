<?php

namespace Src\App\Entity;

use \Datetime;

/**
 * File
 * Table : FileTable
 */
class File
{
  protected $id;
  protected $name;
  protected $uploadDate;

  function __construct(string $name)
  {
    $this->name = $name;
    $this->uploadDate = (new DateTime('now'))->format('Y-m-d H:i:s');
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

  public function getUploadDate()
  {
    return $this->uploadDate;
  }

  public function setUploadDate($uploadDate)
  {
    $this->uploadDate = $uploadDate;

    return $this->uploadDate;
  }
}

?>
