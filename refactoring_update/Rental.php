<?php

class Rental
{
    /**
     * @var Movie
     */
    private $movie;

    /**
     * @var int
     */
    private $daysRented;

    /**
     * @param Movie $movie
     * @param int $daysRented
     */

    public function __construct(Movie $movie, $daysRented) {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    public function getDaysRented() {
        return $this->daysRented;
    }

    public function getMovie() {
        return $this->movie;
    }

    public function getCharge() {
        return $this->movie->getCharge($this->getDaysRented());
    }

    public function getFrequentRenterPoints() {
        return $this->movie->getFrequentRenterPoints($this->getDaysRented());
    }
}

abstract class Price {
    abstract protected function getPriceCode();

    abstract protected function getCharge($daysRented);

    public function getFrequentRenterPoints($daysRented) {
        return 1;
    }
}

class ChildrensPrice extends Price {
    public function getPriceCode() {
        return Movie::CHILDRENS;
    }

    public function getCharge($daysRented) {
        $result = 1.5;
        if ($daysRented > 3) {
            $result += ($daysRented - 3) * 1.5;
        }

        return $result;
    }
}

class NewReleasePrice extends Price {
    public function getPriceCode() {
        return Movie::NEW_RELEASE;
    }

    public function getCharge($daysRented) {
        return $daysRented * 3;
    }

    public function getFrequentRenterPoints($daysRented) {
        return ($daysRented > 1) ? 2 : 1;
    }
}

class RegularPrice extends Price {
    public function getPriceCode() {
        return Movie::REGULAR;
    }

    public function getCharge($daysRented) {
        $result = 2;
        if ($daysRented > 2) {
            $result += ($daysRented - 2) * 1.5;
        }

        return $result;
    }
}
