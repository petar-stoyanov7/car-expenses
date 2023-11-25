<?php

namespace Application\Classes;

class Expense 
{
	private int $userId;
	private int $carId;
	private string $date;
	private int $mileage;
	private int $expenseType;
	private int $price;
	private int $fuelType;
	private int $liters;
	private int $insuranceType;
	private string $partName;
	private string $notes;

	public function __construct(
        $userId = 0,
        $carId = 0,
        $date = 0,
        $mileage = 0,
        $expense_type = 0,
        $price = 0,
        $fuelType = 0,
        $liters = 0,
        $insuranceType = 0,
        $partName = "",
        $notes=""
    )
    {
		$this->userId = $userId;
		$this->carId = $carId;
		$this->date = $date;
		$this->mileage = $mileage;
		$this->expenseType = $expense_type;
		$this->price = $price;
		$this->fuelType = $fuelType;
		$this->liters = $liters;
		$this->insuranceType = $insuranceType;
		$this->partName = $partName;
		$this->notes = sanitize($notes,1);
	}

	public function getProperty($property)
    {
		if (property_exists($this, $property)) {
			return $this->$property;
		} else {
			die("Non existent property");
		}
	}

	public function setProperty($property, $value)
    {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		} else {
			die("Non existent property");
		}
	}

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getCarId(): int
    {
        return $this->carId;
    }

    public function setCarId(int $carId): void
    {
        $this->carId = $carId;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getMileage(): int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): void
    {
        $this->mileage = $mileage;
    }

    public function getExpenseType(): int
    {
        return $this->expenseType;
    }

    public function setExpenseType(int $expenseType): void
    {
        $this->expenseType = $expenseType;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getFuelType(): int
    {
        return $this->fuelType;
    }

    public function setFuelType(int $fuelType): void
    {
        $this->fuelType = $fuelType;
    }

    public function getLiters(): int
    {
        return $this->liters;
    }

    public function setLiters(int $liters): void
    {
        $this->liters = $liters;
    }

    public function getInsuranceType(): int
    {
        return $this->insuranceType;
    }

    public function setInsuranceType(int $insuranceType): void
    {
        $this->insuranceType = $insuranceType;
    }

    public function getPartName(): string
    {
        return $this->partName;
    }

    public function setPartName(string $partName): void
    {
        $this->partName = $partName;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }
}