<?php

class Validation
{
    private $errors = [];
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validateRequired(string $field): void
    {
        if (empty(trim($this->data[$field]))) {
            $this->addError($field, "{$field} is required.");
        }
    }

    public function validateEmail(string $field): void
    {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "{$field} is not a valid email address");
        }
    }

    public function validateStringLength(string $field, int $min, int $max): void
    {
        $length = strlen($this->data[$field]);
        if ($length < $min || $length > $max) {
            $this->addError($field, "{$field} must be between {$min} and {$max} characters");
        }
    }

    public function validateImage(string $field, array $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif']): void
    {
        if (!isset($_FILES[$field]['error']) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
            $this->addError($field, "Error uploading image.");
        } elseif (!in_array($_FILES[$field]['type'], $allowedMimeTypes)) {
            $this->addError($field, "Invalid image file type.");
        }
    }

    public function validatePrice(string $field): void
    {
        if (!is_numeric($this->data[$field]) || $this->data[$field] <= 0) {
            $this->addError($field, "{$field} must be a positive number.");
        }
    }

    public function validateUnique(string $field, string $table, string $column): void
    {
        $db = new Database();
        $query = "SELECT COUNT(*) as count FROM {$table} WHERE {$column} = :{$field}";
        $params = [":{$field}" => $this->data[$field]];
        $result = $db->fetch($query, $params);
        if ($result[0]['count'] > 0) {
            $this->addError($field, "{$field} already exists");
        }
    }

    public function validateNumeric(string $field): void
    {
        if (!is_numeric($this->data[$field])) {
            $this->addError($field, "{$field} must be a number.");
        }
    }

    public function validateAlphabetic(string $field): void
    {
        if (!ctype_alpha($this->data[$field])) {
            $this->addError($field, "{$field} must contain only alphabetic characters.");
        }
    }

    public function validatePasswordMatches(string $password, string $passwordMatch): void
    {
        if ($this->data[$password] !== $this->data[$passwordMatch]) {
            $this->addError($password, "Passwords do not match.");
        }
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function addError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }
}