<?php 
class FormValidator {
    public $username = "";
    public $lastname = "";
    public $firstname = "";
    public $email = "";
    public $password = "";
    public $country = "";
    public $comment = "";
    public $title = "";
    public $terms = false;

    public $errors = [];

    public function validateForm($postData) {
        $this->title = $this->sanitizeInput($postData["title"]);
        $this->username = $this->sanitizeInput($postData["username"]);
        $this->lastname = $this->sanitizeInput($postData["last-name"]);
        $this->firstname = $this->sanitizeInput($postData["first-name"]);
        $this->email = $this->sanitizeInput($postData["email"]);
        $this->password = $this->sanitizeInput($postData["password"]);
        $this->country = $this->sanitizeInput($postData["country"]);
        $this->comment = $this->sanitizeInput($postData["comment"]);
        $this->terms = isset($postData["checkbox"]);

        $this->validateTitle();
        $this->validateUsername();
        $this->validateLastname();
        $this->validateFirstname();
        $this->validateEmail();
        $this->validatePassword();
        $this->validateCountry();
        $this->validateTerms();

        return empty($this->errors);
    }

    private function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    private function validateTitle() {
        if (empty($this->title)) {
            $this->errors['title'] = "Title is required.";
        }
    }

    private function validateUsername() {
        if (empty($this->username)) {
            $this->errors['username'] = "Username is required.";
        } elseif (strlen($this->username) < 4 || strlen($this->username) > 16) {
            $this->errors['username'] = "Username must be between 4 and 16 characters.";
        } elseif (preg_match('/\s/', $this->username)) {
            $this->errors['username'] = "Username should not contain spaces.";
        }
    }

    private function validateFirstname() {
        if (empty($this->firstname)) {
            $this->errors['firstname'] = "Firstname is required.";
        }
    }

    private function validateLastname() {
        if (empty($this->lastname)) {
            $this->errors['lastname'] = "Lastname is required.";
        }
    }

    private function validateEmail() {
        if (empty($this->email)) {
            $this->errors['email'] = "Email is required.";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format.";
        }
    }

    private function validatePassword() {
        if (empty($this->password)) {
            $this->errors['password'] = "Password is required.";
        } elseif (strlen($this->password) < 8 || !preg_match('/[A-Z]/', $this->password) || !preg_match('/\d/', $this->password) || !preg_match('/[\W]/', $this->password)) {
            $this->errors['password'] = "Password must contain at least 8 characters, one uppercase letter, one number, and one special character.";
        }
    }

    private function validateCountry() {
        if (empty($this->country)) {
            $this->errors['country'] = "Country is required.";
        }
    }

    private function validateTerms() {
        if (!$this->terms) {
            $this->errors['terms'] = "You must accept the terms and conditions.";
        }
    }

    public function getError($field) {
        return isset($this->errors[$field]) ? $this->errors[$field] : '';
    }
}

