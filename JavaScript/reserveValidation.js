function validateForm() {
    var fullName = document.getElementById("fullName").value.trim();
    var date = document.getElementById("date").value.trim();
    var email = document.getElementById("email").value.trim();
    var contactNumber = document.getElementById("contactNumber").value.trim();
    var time = document.getElementById("time").value.trim();
    var numPeople = document.getElementById("numPeople").value.trim();
    var notes = document.getElementById("notes").value.trim();

    var isValid = true;

    document.getElementById("fullNameError").innerHTML = "";
    document.getElementById("dateError").innerHTML = "";
    document.getElementById("emailError").innerHTML = "";
    document.getElementById("contactNumberError").innerHTML = "";
    document.getElementById("timeError").innerHTML = "";
    document.getElementById("numPeopleError").innerHTML = "";
    document.getElementById("notesError").innerHTML = "";

    if (fullName === "") {
        document.getElementById("fullNameError").innerHTML = "Please enter your full name.";
        isValid = false;
    }

    if (date === "") {
        document.getElementById("dateError").innerHTML = "Please select a date.";
        isValid = false;
    } else {
        var selectedDate = new Date(date);
        if (selectedDate.getDay() === 1) {
            document.getElementById("dateError").innerHTML = "Sorry, we are closed on Mondays. Please select another date.";
            isValid = false;
        }
    }

    if (email === "") {
        document.getElementById("emailError").innerHTML = "Please enter your email address.";
        isValid = false;
    } else {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            document.getElementById("emailError").innerHTML = "Please enter a valid email address.";
            isValid = false;
        }
    }

    if (contactNumber === "") {
        document.getElementById("contactNumberError").innerHTML = "Please enter your contact number.";
        isValid = false;
    } else {
        var phonePattern = /^\d{10}$/;
        if (!phonePattern.test(contactNumber)) {
            document.getElementById("contactNumberError").innerHTML = "Please enter a valid 10-digit contact number.";
            isValid = false;
        }
    }

    if (time === "") {
        document.getElementById("timeError").innerHTML = "Please select a time.";
        isValid = false;
    } else {
        var selectedTime = new Date("2000-01-01T" + time + ":00");
        var startTime = new Date("2000-01-01T17:00:00");
        var endTime = new Date("2000-01-01T21:30:00");
        if (selectedTime < startTime || selectedTime > endTime) {
            document.getElementById("timeError").innerHTML = "Reservation times are available between 5:00 PM and 9:30 PM only.";
            isValid = false;
        }
    }

    if (numPeople === "") {
        document.getElementById("numPeopleError").innerHTML = "Please enter the number of people.";
        isValid = false;
    } else if (numPeople > 8) {
        document.getElementById("numPeopleError").innerHTML = "We can only accommodate a maximum of 8 people per reservation.";
        isValid = false;
    }

    if (notes.length > 200) {
        document.getElementById("notesError").innerHTML = "Notes cannot exceed 200 characters.";
        isValid = false;
    }

    return isValid;
}