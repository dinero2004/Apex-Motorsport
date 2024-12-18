<?php 

class FormValidator
{
    public $data = [
        'personal_info' => [
            'username' => '',
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'password' => '',
        ],
        'additional_info' => [
            'country' => '',
            'title' => '',
            'comment' => '',
        ],
        'preferences' => [
            'terms' => false,
        ]
    ];

    public $errors = [];

    public function validateForm($postData)
    {
        // Sanitize inputs
        $this->data['additional_info']['title'] = $this->sanitizeInput($postData["title"], 'ENUM');
        $this->data['personal_info']['username'] = $this->sanitizeInput($postData["username"], 'VARCHAR');
        $this->data['personal_info']['lastname'] = $this->sanitizeInput($postData["last-name"], 'VARCHAR');
        $this->data['personal_info']['firstname'] = $this->sanitizeInput($postData["first-name"], 'VARCHAR');
        $this->data['personal_info']['email'] = $this->sanitizeInput($postData["email"], 'VARCHAR');
        $this->data['personal_info']['password'] = $this->sanitizeInput($postData["password"], 'VARCHAR');
        $this->data['additional_info']['country'] = $this->sanitizeInput($postData["country"], 'VARCHAR');
        $this->data['additional_info']['comment'] = $this->sanitizeInput($postData["comment"], 'TEXT');
        $this->data['preferences']['terms'] = isset($postData["checkbox"]);

        // Perform validations
        $this->validateTitle();
        $this->validateUsername();
        $this->validateLastname();
        $this->validateFirstname();
        $this->validateEmail();
        $this->validatePassword();
        $this->validateCountry();
        $this->validateTerms();

        return empty($this->errors);  // Returns true if no errors found
    }

    public function sanitizeInput($data, string $type)
    {
        // Ensure input is a string to avoid unexpected behavior
        $data = (string) $data;
    
        switch (strtoupper($type)) {
            case 'VARCHAR':
                // For VARCHAR, we trim whitespace, remove HTML tags, escape special characters, and limit the length.
                $data = trim($data);
                $data = strip_tags($data); // Removes any HTML tags
                $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Prevents XSS attacks by converting special characters
                $data = mb_substr($data, 0, 255); // Limit length to 255 characters
                break;
    
            case 'INT':
                // For INT, sanitize as a number and cast to integer
                $data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
                $data = (int) $data; // Cast the sanitized data to integer
                break;
    
            case 'TEXT':
                // For TEXT, trim and sanitize special characters, but no length limitation.
                $data = trim($data);
                $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Prevents XSS
                break;
    
            case 'EMAIL':
                // For EMAIL, sanitize the input using filter_var
                $data = filter_var($data, FILTER_SANITIZE_EMAIL);
                break;
    
            case 'URL':
                // For URL, sanitize using filter_var
                $data = filter_var($data, FILTER_SANITIZE_URL);
                break;
    
            default:
                // For unknown types, apply basic sanitization
                $data = trim($data);
                $data = strip_tags($data);
                $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
                break;
        }
    
        return $data;
    }

    private function validateTitle() {
        if (empty($this->data['additional_info']['title'])) {
            $this->errors['title'] = "Title is required.";
        }
    }

     function validateUsername() {
        $username = $this->data['personal_info']['username'];
        if (empty($username)) {
            $this->errors['username'] = "Username is required.";
        } elseif (strlen($username) < 4 || strlen($username) > 16) {
            $this->errors['username'] = "Username must be between 4 and 16 characters.";
        } elseif (preg_match('/\s/', $username)) {
            $this->errors['username'] = "Username should not contain spaces.";
        }
    }

    private function validateFirstname() {
        if (empty($this->data['personal_info']['firstname'])) {
            $this->errors['firstname'] = "Firstname is required.";
        }
    }

    private function validateLastname() {
        if (empty($this->data['personal_info']['lastname'])) {
            $this->errors['lastname'] = "Lastname is required.";
        }
    }

    private function validateEmail() {
        $email = $this->data['personal_info']['email'];
        if (empty($email)) {
            $this->errors['email'] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format.";
        }
    }

     function validatePassword() {
        $password = $this->data['personal_info']['password'];
        if (empty($password)) {
            $this->errors['password'] = "Password is required.";
        } elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[\W]/', $password)) {
            $this->errors['password'] = "Password must contain at least 8 characters, one uppercase letter, one number, and one special character.";
        }
    }

    private function validateCountry() {
        if (empty($this->data['additional_info']['country'])) {
            $this->errors['country'] = "Country is required.";
        }
    }

    private function validateTerms() {
        if (!$this->data['preferences']['terms']) {
            $this->errors['terms'] = "You must accept the terms and conditions.";
        }
    }

    public function getError($field) {
        return isset($this->errors[$field]) ? $this->errors[$field] : '';
    }
}
