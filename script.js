document.addEventListener("DOMContentLoaded", function () {
    const categories = document.querySelectorAll(".faq-category");
    const faqSections = document.querySelectorAll(".faq-questions");
    const questions = document.querySelectorAll(".faq-question");

    let openAnswer = null; // Track the currently open answer

    // Handle category switching
    categories.forEach(category => {
        category.addEventListener("click", () => {
            categories.forEach(cat => cat.classList.remove("active"));
            category.classList.add("active");

            // Hide all questions
            faqSections.forEach(section => section.classList.add("hidden"));

            // Show relevant section
            const selectedCategory = category.getAttribute("data-category");
            document.getElementById(selectedCategory).classList.remove("hidden");
        });
    });

    // Handle FAQ answer toggle
    questions.forEach(question => {
        question.addEventListener("click", () => {
            const answer = question.nextElementSibling;
            const toggleSign = question.querySelector(".faq-toggle");

            // If an answer is already open, close it before opening the new one
            if (openAnswer && openAnswer !== answer) {
                openAnswer.style.display = "none";
                openAnswer.previousElementSibling.querySelector(".faq-toggle").textContent = "+"; // Reset the sign
            }

            // Toggle current answer
            if (answer.style.display === "block") {
                answer.style.display = "none";
                toggleSign.textContent = "+"; // Reset sign when closed
                openAnswer = null; // No open answer
            } else {
                answer.style.display = "block";
                toggleSign.textContent = "-"; // Change sign when opened
                openAnswer = answer; // Set current answer as open
            }
        });
    });
});
