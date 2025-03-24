// Show form when Enquiry button is clicked
document.getElementById('openFormBtn').addEventListener('click', function() {
    document.getElementById('enquiryForm').style.display = 'block';
});

// Close form when "X" button is clicked
document.getElementById('closeFormBtn').addEventListener('click', function() {
    document.getElementById('enquiryForm').style.display = 'none';
});

document.querySelector(".form-container").addEventListener("submit", async function (event) {
    event.preventDefault();

    const formData = {
        fullname: document.getElementById("fullname").value,
        email: document.getElementById("email").value,
        mobile: document.getElementById("mobile").value,
        city: document.getElementById("city").value,
        destination: document.getElementById("destination").value,
        office: document.getElementById("office").value,
        coaching: document.getElementById("coaching").value,
        loan: document.getElementById("loan").value,
        captcha: document.getElementById("captcha").value,
        terms: document.getElementById("terms").checked
    };

    try {
        const response = await fetch("http://localhost/enquiry-form/enquiry.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(formData),
    mode: "cors" 
});


        const result = await response.json();
        alert(result.message);
        document.getElementById("enquiryForm").style.display = "none"; 
    } catch (error) {
        console.error("Error submitting form:", error);
    }
});
