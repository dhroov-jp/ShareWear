console.log('JavaScript is running');

function updateProgress(currentStep, totalSteps) {
    const progressPercentage = (currentStep / totalSteps) * 100;
    document.querySelector('.progress').style.width = `${progressPercentage}%`;
}

function highlightStep(stepIndex) {
    const steps = document.querySelectorAll('.progress-steps li');
    steps.forEach((step, index) => {
        step.classList.remove('active', 'completed');
        if (index < stepIndex) {
            step.classList.add('completed');
        } else if (index === stepIndex) {
            step.classList.add('active');
        }
    });
}

document.getElementById('location-form').onsubmit = function (event) {
    event.preventDefault();
    document.getElementById('location-section').style.display = 'none';
    document.getElementById('upload-section').style.display = 'block';
    updateProgress(1, 4);
    highlightStep(1);
};

document.getElementById('uploadClothesForm').onsubmit = function (event) {
    event.preventDefault();
    document.getElementById('upload-section').style.display = 'none';
    document.getElementById('quantity-size-section').style.display = 'block';
    document.getElementById('cloth-detail-container').style.display = 'block';
    document.getElementById('continue-button').style.display = 'inline-block';
    updateProgress(2, 4);
    highlightStep(2);
};

document.getElementById('uploadVideosButton').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('upload-section').style.display = 'none';
    document.getElementById('quantity-size-section').style.display = 'block';
    document.getElementById('cloth-detail-container').style.display = 'block';
    document.getElementById('continue-button').style.display = 'inline-block';
    updateProgress(2, 4);
    highlightStep(2);
});

const quantityInput = document.getElementById("quantity");
const clothDetailContainer = document.getElementById("cloth-detail-container");
const prevButton = document.querySelector(".prev-button");
const nextButton = document.querySelector(".next-button");
const continueButton = document.getElementById("continue-button");

let quantity = 0;
let currentIndex = 0;
let clothDetails = [];

quantityInput.addEventListener("input", () => {
    quantity = parseInt(quantityInput.value);
    if (quantity > 0) {
        clothDetails = Array.from({ length: quantity }, () => ({}));
        currentIndex = 0;
        updateClothDetails();
    } else {
        clothDetails = [];
        clothDetailContainer.innerHTML = "";
    }
});

function updateClothDetails() {
    clothDetailContainer.innerHTML = "";
    const clothDetail = document.createElement("div");
    clothDetail.className = "cloth-detail";
    clothDetail.innerHTML = `
        <h2>Cloth ${currentIndex + 1}</h2>
        <div class="input-group">
            <label for="cloth-type-${currentIndex + 1}">Type:</label>
            <select id="cloth-type-${currentIndex + 1}" name="cloth-type" required>
                <option value="" disabled selected>Select Type</option>
                <option value="tshirt">T-Shirt</option>
                <option value="shirt">Shirt</option>
                <option value="trousers">Trousers</option>
                <option value="shorts">Shorts</option>
                <option value="socks">Socks</option>
                <option value="sweater">Sweater</option>
            </select>
        </div>
        <div class="input-group">
            <label for="age-group-${currentIndex + 1}">Age Group:</label>
            <select id="age-group-${currentIndex + 1}" name="age-group" required>
                <option value="" disabled selected>Select Age Group</option>
                <option value="newborn">Newborn: Up to 3 months old</option>
                <option value="infant">Infant: 3 - 12 months old</option>
                <option value="toddler">Toddler: 1-5 years old</option>
                <option value="kids">Kids: 5-16 years old</option>
                <option value="adult">Adult: 16 years or older</option>
            </select>
        </div>
        <div class="input-group">
            <label for="size-${currentIndex + 1}">Size:</label>
            <select id="size-${currentIndex + 1}" name="size" required>
                <option value="" disabled selected>Select Size</option>
                <option value="Extra Small">XS</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
                <option value="Extra Large">XL</option>
                <option value="XXL">XXL</option>
            </select>
        </div>
        <div class="input-group">
            <label for="Quality-${currentIndex + 1}">Quality:</label>
            <select id="Quality-${currentIndex + 1}" name="Quality" required>
                <option value="" disabled selected>Select Quality</option>
                <option value="brand-new">Brand New</option>
                <option value="very-good">Very Good</option>
                <option value="good">Good</option>
                <option value="average">Average</option>
            </select>
        </div>
    `;
    clothDetailContainer.appendChild(clothDetail); 
}

nextButton.addEventListener("click", () => {
    if (areClothDetailsFilled(currentIndex)) {
        saveCurrentClothDetails();
        if (currentIndex < quantity - 1) {
            currentIndex++;
            updateClothDetails();
        } else {
            alert("You have reached the last cloth.");
        }
    } else {
        alert(`Please fill all details for Cloth ${currentIndex + 1}.`);
    }
});

prevButton.addEventListener("click", () => {
    if (currentIndex > 0) {
        saveCurrentClothDetails();
        currentIndex--;
        updateClothDetails();
    } else {
        alert("You are already on the first cloth.");
    }
});

function areClothDetailsFilled(index) {
    const clothType = document.getElementById(`cloth-type-${index + 1}`);
    const ageGroup = document.getElementById(`age-group-${index + 1}`);
    const size = document.getElementById(`size-${index + 1}`);
    const Quality = document.getElementById(`Quality-${index + 1}`);
    return clothType.value && ageGroup.value && size.value && Quality.value;
}

function saveCurrentClothDetails() {
    const clothType = document.getElementById(`cloth-type-${currentIndex + 1}`);
    const ageGroup = document.getElementById(`age-group-${currentIndex + 1}`);
    const size = document.getElementById(`size-${currentIndex + 1}`);
    const Quality = document.getElementById(`Quality-${currentIndex + 1}`);
    clothDetails[currentIndex] = {
        type: clothType.value,
        ageGroup: ageGroup.value,
        size: size.value,
        Quality: Quality.value,
    };
}

continueButton.addEventListener("click", () => {
    if (areClothDetailsFilled(currentIndex)) {
        document.getElementById('quantity-size-section').style.display = 'none';
        document.getElementById('dropoff-time-section').style.display = 'block';
        updateProgress(3, 4);
        highlightStep(3);
    } else {
        alert(`Please fill all details for Cloth ${currentIndex + 1} before continuing.`);
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const dropoffSlots = document.querySelectorAll('.dropoff-slot');
    const dropoffDateInput = document.getElementById('dropoff-date');
    const submitButton = document.getElementById('submitButton');
    const thankYouSection = document.getElementById('thankyou-section');
    const dropoffTimeSection = document.getElementById('dropoff-time-section');
    const stepsContainer = document.getElementById('steps-container');
    const returnHomeButton = document.getElementById('return-home-button');

    let selectedSlot = null;
    let selectedDate = null;

    dropoffSlots.forEach(slot => {
        slot.addEventListener('click', function() {
            dropoffSlots.forEach(s => s.classList.remove('active'));
            this.classList.add('active');
            selectedSlot = this.textContent.trim();
        });
    });

    dropoffDateInput.addEventListener('change', function() {
        selectedDate = this.value;
    });

    submitButton.addEventListener('click', function(event) {
        event.preventDefault();
        if (!selectedSlot || !selectedDate) {
            alert("Please select both a dropoff slot and a dropoff date.");
            return;
        }
        dropoffTimeSection.style.display = "none";
        thankYouSection.style.display = "block";
        stepsContainer.style.display = "none";
    });

    returnHomeButton.addEventListener('click', function() {
        window.location.href = 'grp26.html';
    });
});
