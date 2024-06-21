// Add event listener to the Submit button to validate the form on submission
document.querySelector("button").addEventListener("click", validateForm);

// Add event listeners to validate inputs as the user fills them out
document.querySelectorAll("input, textarea").forEach((input) => {
    input.addEventListener("blur", validateInput);
});

function validateInput(event) {
    const input = event.target;
    const value = input.value;
    let errorMessage = "";

    switch (input.id) {
        case "first-name":
            errorMessage = validateName(value, "First name");
            break;
        case "last-name":
            errorMessage = validateName(value, "Last name");
            break;
        case "email":
            errorMessage = validateEmail(value);
            break;
        case "message":
            errorMessage = validateMessage(value);
            break;
        case "address":
            errorMessage = validateAddress(value);
            break;
        case "postcode":
            errorMessage = validatePostcode(value);
            break;
        case "city":
            errorMessage = validateCity(value);
            break;
    }

    displayError(input, errorMessage);
}

function validateForm(event) {
    event.preventDefault();

    let data = {};
    let validationErrors = {};

    data.firstName = document.querySelector("#first-name").value;
    data.lastName = document.querySelector("#last-name").value;
    data.email = document.querySelector("#email").value;
    data.message = document.querySelector("#message").value;
    data.address = document.querySelector("#address").value;
    data.postcode = document.querySelector("#postcode").value;
    data.city = document.querySelector("#city").value;

    // Remove existing error messages
    if (document.querySelector("form span")) {
        document.querySelectorAll("form span").forEach((element) => {
            element.remove();
        });
    }

    validationErrors.firstName = validateName(data.firstName, "First name");
    validationErrors.lastName = validateName(data.lastName, "Last name");
    validationErrors.email = validateEmail(data.email);
    validationErrors.message = validateMessage(data.message);
    validationErrors.address = validateAddress(data.address);
    validationErrors.postcode = validatePostcode(data.postcode);
    validationErrors.city = validateCity(data.city);

    if (Object.keys(validationErrors).every(key => !validationErrors[key])) {
        console.log(data);
    } else {
        displayErrors(validationErrors);
    }
}

function validateName(name, fieldName) {
    if (!name) {
        return `No ${fieldName.toLowerCase()} provided`;
    } else if (name.length <= 3) {
        return `${fieldName} must be at least 3 characters long`;
    }
    return "";
}

function validateEmail(email) {
    if (!email) {
        return "No email provided";
    } else {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            return "Email is invalid, please check again";
        }
    }
    return "";
}

function validateMessage(message) {
    if (message !== "" && message.length < 31) {
        return "The message must be at least 30 characters long";
    }
    return "";
}

function validateAddress(address) {
    if (!address) {
        return "No address provided";
    }
    return "";
}

function validatePostcode(postcode) {
    if (!postcode) {
        return "No postcode provided";
    } else {
        const swissPostcodeRegex = /^[1-9]\d{3}$/;
        if (!swissPostcodeRegex.test(postcode)) {
            return "Postcode is invalid";
        }
    }
    return "";
}

function validateCity(city) {
    if (!city) {
        return "No city provided";
    }
    return "";
}

function displayError(input, errorMessage) {
    if (errorMessage) {
        let errContainer = input.nextElementSibling;
        if (!errContainer || errContainer.tagName !== "SPAN") {
            errContainer = document.createElement("span");
            input.after(errContainer);
        }
        errContainer.innerHTML = errorMessage;
    } else {
        const errContainer = input.nextElementSibling;
        if (errContainer && errContainer.tagName === "SPAN") {
            errContainer.remove();
        }
    }
}

function displayErrors(errors) {
    for (const key in errors) {
        if (errors[key]) {
            const input = document.querySelector(`#${key}`);
            displayError(input, errors[key]);
        }
    }
}
