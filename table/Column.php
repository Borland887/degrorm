<?php

class Column {
	private array $params;

	private bool $isValid = true;

	public function __construct (array $params) {
		$this->params['name'] = $params['name'] ?? null;
		$this->params['type'] = $params['type'] ?? null;
		$this->params['nullable'] = $params['nullable'] ?? null;
		$this->params['key'] = $params['key'] ?? null;
		$this->params['default'] = $params['default'] ?? null;
		$this->params['extra'] = $params['extra'] ?? null;

		$this->validate();

		if ($this->isValid === false) {
			throw new RuntimeException("Invalid value for Column");
		}
	}

	public function getDescription () : string {
		return " " . trim(implode(" ", $this->params)) . ",";
	}

	// Тут типо тоже валидация по значению
	private function validate () : void {
		if (is_null($this->params['name'])) {
			$this->isValid = false;
		}
		if (is_null($this->params['type'])) {
			$this->isValid = false;
		}
		if (is_null($this->params['nullable'])) {
			$this->params['nullable'] = 'null';
		}
	}
}