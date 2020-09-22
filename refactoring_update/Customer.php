<?php

class Customer
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Rental[]
     */
    private $rentals;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param Rental $rental
     */
    public function addRental(Rental $rental)
    {
        $this->rentals[] = $rental;
    }

    /**
     * @return string
     */
    public function statementText() {
        $result = 'Rental Record for ' . $this->getName() . PHP_EOL;
    #check later.
          foreach ($this->rentals as $rental) {
        #changed this
            $result .= "\t" . str_pad($rental->movie()-getTitle(), 30, ' ', STR_PAD_RIGHT) . "\t" . Rental::getCharge() . PHP_EOL;
        }
    // footer lines
       $result .= 'Amount owed is ' . $this->getTotalCharge() . PHP_EOL;
       $result .= 'You earned ' . $this->getTotalFrequentRenterPoints() . ' frequent renter points' . PHP_EOL;

        return $result;
    }
    public function statementHtml() {
        $result = "<h1>Rental Record for <em>" . $this->getName() . "</em></h1><p>\n";

        foreach ($this->rentals as $rental) {
            $result .= $rental->movie->getTitle() . " " . $rental->getCharge() . "<br />\n";
        }

    // footer lines
      $result .= "<p>Amount owed is <em>" . $this->getTotalCharge() . "</em></p>\n";
      $result .= "<p>You earned <em>" . $this->getTotalFrequentRenterPoints() . "</em> frequent renter points</p>";

    return $result;
}
    // Made this Query for the total Frequent Renter Points.
    private function getTotalFrequentRenterPoints() {
      $result = 0;

      foreach ($this->rentals as $rental){
        $result += $rental->getFrequentRenterPoints();
      }
      return $result;
    }

    // Made this Query for getting the total charge
    private function getTotalCharge() {
      $result = 0;

      foreach ($this->rentals as $rental) {
        $result += $rental->getCharge();
      }
      return $result;

    }
}
