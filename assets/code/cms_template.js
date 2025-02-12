

const toggleForm = (formId, button) => {
    document.querySelectorAll(".form-container").forEach(form => form.classList.remove("active"));
    document.getElementById(formId).classList.add("active");

    document.querySelectorAll(".menu button").forEach(btn => btn.classList.remove("active"));
    button.classList.add("active");
}

const enableRowEditing = (editButton, carId) => {
    const row = editButton.closest('tr');
    const isEditing = editButton.textContent === 'Save';

    if (isEditing) {
        // Save changes
        const updatedData = {};
        row.querySelectorAll('[data-editable]').forEach(cell => {
            cell.contentEditable = false;
            updatedData[cell.dataset.field] = cell.textContent.trim();
        });

        // Send the updateCar request
        const formData = new FormData();
        formData.append('action', 'update_car');
        formData.append('car_id', carId);
        Object.keys(updatedData).forEach(key => {
            formData.append(key, updatedData[key]);
        });

        fetch('', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                console.log('Update response:', data);
                location.reload(); // Reload to reflect changes
            })
            .catch(error => console.error('Error updating car:', error));

        editButton.textContent = 'Edit';
    } else {
        // Enable editing
        row.querySelectorAll('[data-editable]').forEach(cell => {
            cell.contentEditable = true;
        });
        editButton.textContent = 'Save';
    }
};

// Menubar functionality for from and table

document.addEventListener('DOMContentLoaded', () => {
    const showAddCarForm = document.getElementById('showForm');
    const showEditTable = document.getElementById('showTable');
    const addCarForm = document.getElementById('addForm');
    const editTable = document.getElementById('editTable');

    // Show the Add Car form
    showAddCarForm.addEventListener('click', () => {
        addCarForm.classList.add('active');
        editTable.classList.remove('active');
    });

    // Show the Edit Table
    showEditTable.addEventListener('click', () => {
        editTable.classList.add('active');
        addCarForm.classList.remove('active');
    });
});

document.getElementById('fileInput').addEventListener('change', function(event) {
    const imagePreviewContainer = document.getElementById('imagePreview');
    imagePreviewContainer.innerHTML = ''; // Clear previous previews
    
    const files = event.target.files; // Get the selected files

    Array.from(files).forEach(file => {
        if (file.type.startsWith('image/')) { // Ensure the file is an image
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result; // Set the image source
                imagePreviewContainer.appendChild(imgElement); // Add image to preview container
            };
            reader.readAsDataURL(file); // Read the image file as a data URL
        }
    });
});

// Searchbar functionality

document.getElementById('searchBar').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#modelTable tbody tr');
    
    rows.forEach(row => {
        const modelName = row.cells[1].textContent.toLowerCase();
        if (modelName.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Image Managerfunctionality