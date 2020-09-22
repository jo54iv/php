<?php

class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $price;

    /**
     * @param string $name
     * @param int $priceCode
     */
     public function __construct($title, $priceCode) {
           $this->title = $title;
           $this->setPrice($priceCode);
       }
       /**
 * @return string
 */
       public function getPriceCode() {
           return $this->price->getPriceCode();
       }
       /**
   * @return int
   */
       public function setPrice($priceCode) {

           switch ($priceCode) {
               case self::REGULAR:
                   $this->price = new RegularPrice();
                   break;

               case self::CHILDRENS:
                   $this->price = new ChildrensPrice();
                   break;

               case self::NEW_RELEASE:
                   $this->price = new NewReleasePrice();
                   break;

               default:
                   throw new Exception('Incorrect Price Code.');
                   break;
           }
       }

       public function getTitle() {
           return $this->title;
       }

       public function getCharge($daysRented) {
           return $this->price->getCharge($daysRented);
       }

       public function getFrequentRenterPoints($daysRented) {
           return $this->price->getFrequentRenterPoints($daysRented);
       }
   }
