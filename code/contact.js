document.querySelector("button").addEventListener("click", validateForm);

document.querySelectorAll("input, textarea").forEach((input) => {
    input.addEventListener("blur", validateInput);
});

document.querySelectorAll("input[type='radio']").forEach((radio) => {
    radio.addEventListener("change", () => {
        displayError(radio.closest(".radio-group").querySelector(".error"), "");
    });
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

    displayError(input.nextElementSibling, errorMessage);
}

function validateForm(event) {
    event.preventDefault();

    let data = {
        title: document.querySelector("input[name='title']:checked"),
        firstName: document.querySelector("#first-name"),
        lastName: document.querySelector("#last-name"),
        email: document.querySelector("#email"),
        address: document.querySelector("#address"),
        postcode: document.querySelector("#postcode"),
        city: document.querySelector("#city"),
        message: document.querySelector("#message")
    };

    let isValid = true;

    if (!data.title) {
        isValid = false;
        displayError(document.querySelector(".radio-group .error"), "Please select a title.");
    } else {
        displayError(document.querySelector(".radio-group .error"), "");
    }

    Object.values(data).forEach((input) => {
        if (input && input.id) {
            const event = new Event("blur");
            input.dispatchEvent(event);
            if (input.nextElementSibling.textContent !== "") {
                isValid = false;
            }
        }
    });

    if (isValid) {
        const formData = {
            title: data.title.value,
            firstName: data.firstName.value,
            lastName: data.lastName.value,
            email: data.email.value,
            address: data.address.value,
            postcode: data.postcode.value,
            city: data.city.value,
            message: data.message.value
        };
        console.log("Form is valid", formData);
        // Handle form submission with formData
    } else {
        console.log("Form has errors");
    }
}

function validateName(value, fieldName) {
    if (value.trim() === "") {
        return `${fieldName} is required.`;
    }
    return "";
}

function validateEmail(value) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (value.trim() === "") {
        return "Email is required.";
    }
    if (!emailRegex.test(value)) {
        return "Please enter a valid email address.";
    }
    return "";
}

function validateMessage(value) {
    if (value.trim() === "") {
        return "Message is required.";
    }
    return "";
}

function validateAddress(value) {
    if (value.trim() === "") {
        return "Address is required.";
    }
    return "";
}

function validatePostcode(value) {
    if (value.trim() === "") {
        return "Postcode is required.";
    }
    return "";
}

function validateCity(value) {
    if (value.trim() === "") {
        return "City is required.";
    }
    return "";
}

function displayError(spanElement, message) {
    spanElement.textContent = message;
}
