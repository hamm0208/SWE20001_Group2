<?php
class Item{
    public $name;
    public $description;
    public $price;
    public $category;
    function __construct($name, $description, $price, $category) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
      }
}
?>