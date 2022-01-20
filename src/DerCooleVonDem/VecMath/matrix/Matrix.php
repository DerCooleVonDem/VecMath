<?php

namespace DerCooleVonDem\VecMath;

class Matrix{

	private int $rows;
	private int $cols;
	private array $data;

	public function __construct(int $rows, int $cols)
	{
		$this->rows = $rows;
		$this->cols = $cols;
		$this->data = array();
		for($i = 0; $i < $rows; $i++){
			$this->data[$i] = [];
			for($j = 0; $j < $cols; $j++){
				$this->data[$i][$j] = 0;
			}
		}
	}

	public function getRows(): int
	{

		return $this->rows;
	}

	public function getCols(): int
	{
		return $this->cols;
	}

	public function getData(): array
	{
		return $this->data;
	}

	public function setData(array $data): void
	{
		$this->data = $data;
	}

	public function get(int $row, int $col): float
	{
		return $this->data[$row][$col];
	}

	public function set(int $row, int $col, float $value): void
	{
		$this->data[$row][$col] = $value;
	}

	public function add(Matrix $matrix): Matrix
	{
		$result = new Matrix($this->rows, $this->cols);
		for($i = 0; $i < $this->rows; $i++){
			for($j = 0; $j < $this->cols; $j++){
				$result->set($i, $j, $this->get($i, $j) + $matrix->get($i, $j));
			}
		}
		return $result;
	}

	public function scalarAdd(float $scalar): Matrix
	{
		$result = new Matrix($this->rows, $this->cols);
		for($i = 0; $i < $this->rows; $i++){
			for($j = 0; $j < $this->cols; $j++){
				$result->set($i, $j, $this->get($i, $j) + $scalar);
			}
		}
		return $result;
	}

	public function sub(Matrix $matrix): Matrix
	{
		$result = new Matrix($this->rows, $this->cols);
		for($i = 0; $i < $this->rows; $i++){
			for($j = 0; $j < $this->cols; $j++){
				$result->set($i, $j, $this->get($i, $j) - $matrix->get($i, $j));
			}
		}
		return $result;
	}

	public function scalarSub(float $scalar): Matrix
	{
		$result = new Matrix($this->rows, $this->cols);
		for($i = 0; $i < $this->rows; $i++){
			for($j = 0; $j < $this->cols; $j++){
				$result->set($i, $j, $this->get($i, $j) - $scalar);
			}
		}
		return $result;
	}

	public function mul(Matrix $matrix): Matrix
	{
		$result = new Matrix($this->rows, $this->cols);
		for($i = 0; $i < $this->rows; $i++){
			for($j = 0; $j < $this->cols; $j++){
				$result->set($i, $j, $this->get($i, $j) * $matrix->get($i, $j));
			}
		}
		return $result;
	}

	public function scalarMul(float $scalar): Matrix
	{
		$result = new Matrix($this->rows, $this->cols);
		for($i = 0; $i < $this->rows; $i++){
			for($j = 0; $j < $this->cols; $j++){
				$result->set($i, $j, $this->get($i, $j) * $scalar);
			}
		}
		return $result;
	}

	public function div(Matrix $matrix): Matrix
	{
		$result = new Matrix($this->rows, $this->cols);
		for($i = 0; $i < $this->rows; $i++){
			for($j = 0; $j < $this->cols; $j++){
				$result->set($i, $j, $this->get($i, $j) / $matrix->get($i, $j));
			}
		}
		return $result;
	}

	public function scalarDiv(float $scalar): Matrix
	{
		$result = new Matrix($this->rows, $this->cols);
		for($i = 0; $i < $this->rows; $i++){
			for($j = 0; $j < $this->cols; $j++){
				$result->set($i, $j, $this->get($i, $j) / $scalar);
			}
		}
		return $result;
	}

	public function reflect(): Matrix
	{
		$result = new Matrix($this->rows, $this->cols);
		for($i = 0; $i < $this->rows; $i++){
			for($j = 0; $j < $this->cols; $j++){
				$result->set($i, $j, $this->get($i, $j) * -1);
			}
		}
		return $result;
	}

	public function transpose(): Matrix{
		$result = new Matrix($this->cols, $this->rows);
		for($i = 0; $i < $this->rows; $i++){
			for($j = 0; $j < $this->cols; $j++){
				$result->set($j, $i, $this->get($i, $j));
			}
		}
		return $result;
	}

	public function toString(): string
	{
		$result = "";
		for($i = 0; $i < $this->rows; $i++){
			for($j = 0; $j < $this->cols; $j++){
				$result .= $this->get($i, $j) . " ";
			}
			$result .= "\n";
		}
		return $result;
	}
}