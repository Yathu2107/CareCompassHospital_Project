//Home page image slide
let currentSlide = 0;

function showSlide(index, direction) {
    const slides = document.querySelectorAll('.slide');
    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }

    slides.forEach((slide, i) => {
        if (i === currentSlide) {
            slide.classList.add('active');
            slide.style.transform = 'translateX(0)'; // Active slide reset transform 
        } else {
            slide.classList.remove('active');
            slide.style.transform = `translateX(${i > currentSlide ? '100%' : '-100%'})`; //Slide to the left 
        }
    });
}

function changeSlide(direction) {
    currentSlide += direction;
    showSlide(currentSlide);
}


//Initialize the first slide
showSlide(currentSlide);


//Auto slide changer
setInterval(() => {
    changeSlide(1);
}, 5000);


//sign-in popup
function openPopup() {
    document.getElementById('signPopup').style.display = 'block';
}

function closePopup() {
    document.getElementById('signPopup').style.display = 'none';
}

const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signup');

signUpButton.addEventListener('click', function () {
    signInForm.style.display = "none";
    signUpForm.style.display = "block";
})
signInButton.addEventListener('click', function () {
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
});


// Function to update the UI based on login status
function updateAuthUI() {
    const authButton = document.getElementById('authButton');
    const userGreeting = document.getElementById('userGreeting');
    const userLastName = document.getElementById('userLastName');

    // Check if the user is logged in 
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    const lastName = localStorage.getItem('lastName');

    if (isLoggedIn && lastName) {
        // User is logged in
        authButton.textContent = 'Log Out';
        authButton.onclick = () => {
            localStorage.removeItem('isLoggedIn'); // Clear login status
            localStorage.removeItem('lastName'); // Clear last name
            window.location.href = 'index.php'; // Reload the page
        };
        userGreeting.style.display = 'inline';
        userLastName.textContent = lastName;
    } else {
        // User is not logged in
        authButton.textContent = 'Sign In';
        authButton.onclick = openPopup;
        userGreeting.style.display = 'none';
    }
}

// Call the function when the page loads
document.addEventListener('DOMContentLoaded', updateAuthUI);

//logout
function logout() {
    fetch('logout.php') // Call the logout script
        .then(response => {
            if (response.ok) {
                // Clear localStorage and reload the page
                localStorage.removeItem('isLoggedIn');
                localStorage.removeItem('lastName');
                window.location.href = 'index.php'; // Reload the page
            } else {
                console.error('Logout failed');
            }
        })
        .catch(error => {
            console.error('Error during logout:', error);
        });
}

// Attach the logout function to the button
document.getElementById('authButton').addEventListener('click', function () {
    if (this.textContent === 'Log Out') {
        logout();
    } else {
        openPopup(); // Open the sign-in popup if not logged in
    }
});

// Patient portal access
function checkLogin(page) {
    let isLoggedIn = localStorage.getItem("isLoggedIn");

    if (isLoggedIn === "true") {
        window.location.href = page;
    } else {
        alert('You must be signed in to access this page!');
    }
}


// Rating and Feedback Box Logic
let selectedRating = 0;

function setRating(rating) {
    selectedRating = rating;

    // Update the visual representation of the stars
    document.querySelectorAll('.stars .star').forEach((star, index) => {
        star.classList.toggle('selected', index < rating);
    });

    // Update the hidden input field with the selected rating
    document.getElementById('rating').value = rating;
}

function showRateAndFeedbackBox(reportId) {
    const ratingBox = document.getElementById('rating-feedback-box');

    if (ratingBox) {
        document.getElementById('rating_feedback_report_id').value = reportId;
        ratingBox.style.display = 'flex'; // Using 'flex' for better centering if needed
    }
}

function closeRatingFeedbackBox() {
    const ratingBox = document.getElementById('rating-feedback-box');

    if (ratingBox) {
        ratingBox.style.display = 'none';
        
        // Optional: Reset rating and feedback fields when closing
        selectedRating = 0;
        document.getElementById('rating').value = '';
        document.querySelectorAll('.stars .star').forEach(star => star.classList.remove('selected'));
        document.getElementById('feedback-text').value = ''; // Assuming a textarea with this ID
    }
}