const icon = document.querySelector(".check-icon");
const nav = document.querySelector(".navbar");
let bookingButton = document.querySelector(".book-button");
let bookingForm = document.querySelector(".booking-form");
let dataNode = bookingForm.querySelectorAll(".data_input");
let overlay = document.querySelector(".overlay");
let errorBox = document.querySelector(".box-error");
let alertBox = document.querySelector(".alert-box");
let successBox = document.querySelector(".box-success");
let cancelOverlayButton = document.querySelector(".cancel_box");
let cancelSuccess = document.querySelector(".cancel_succes_box");

errorBox.style.display = "none";
alertBox.style.display = "block";
successBox.style.display = "none";

let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}

icon.addEventListener("change", function () {
  if (this.checked) {
    // If the checkbox is checked, display the navbar
    nav.style.display = "flex";
  } else {
    // If the checkbox is unchecked, hide the navbar
    nav.style.display = "none";
  }
});

//
// icon.addEventListener("click", function () {
// if ((nav.style.display = "none")) {
// nav.style.display = "flex";
// } else {
// nav.style.display = " none";
// }
// });

bookingButton.addEventListener("click", () => {
  let formData = {};

  dataNode.forEach((input) => {
    formData[input.name] = input.value;
  });

  overlay.style.display = "grid";
  submitForm(formData);
});
async function submitForm(data) {
  try {
    const response = await fetch("./backend/sendEmail.php", {
      method: "POST",
      body: JSON.stringify(data),
      headers: {
        "Content-Type": "application/json",
      },
    });
    const result = await response.json();
    console.log(result);
    if (result.error) {
      alertBox.style.display = "none";
      errorBox.style.display = "block";
      errorBox.querySelector(".error_box_text").textContent = result.message;
    } else {
      // overlay.style.display = "none"
      alertBox.style.display = "none";
      errorBox.style.display = "none";
      successBox.style.display = "block";
      bookingForm.reset();
    }
  } catch (error) {
    console.log(error);
  }
}

cancelOverlayButton.addEventListener("click", () => {
  overlay.style.display = "none";
});

cancelSuccess.addEventListener("click", () => {
  overlay.style.display = "none";
});
