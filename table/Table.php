<?php

class Table {
	public const DEFAULT_CHARSET = "utf8mb4";
	public const DEFAULT_COLLATE = "utf8mb4";

	private array $params;
	private array $columns;

	private bool $isValid = true;

	public function __construct (array $params) {
		$this->params['name'] = $params['name'] ?? null;
		$this->params['charset'] = "DEFAULT CHARSET " . $params['charset'] ?? self::DEFAULT_CHARSET;
		$this->params['collate'] = "COLLATE " . $params['collate'] ?? self::DEFAULT_COLLATE;

		$this->validate();

		if ($this->isValid === false) {
			throw new RuntimeException("Invalid value for Table");
		}
	}

	public function setColumns (Column ...$column) : void {
		$this->columns = $column;
	}

	public function getTableCreateQuery () : string {
		$query [] = "CREATE TABLE " . $this->params['name'] . "(";

		foreach ($this->columns as $column) {
			$query [] = $column->getDescription();
		}

		$query [] =  $this->params['charset'];
		$query [] =  $this->params['collate'];

		return implode($query);
	}

	// Тут еще якобы валидация по значениям
	private function validate () : void {
		if (is_null($this->params['name'])) {
			$this->isValid = false;
		}
	}
}