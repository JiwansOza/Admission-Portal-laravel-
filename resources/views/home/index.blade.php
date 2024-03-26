@extends('layouts.app-master')

@section('content')
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

<form method="post" action="processform">
    @csrf
    <div class="background-image">
        <div class="admission-form">
            <h2 class="text-center form-heading">Admissions Open 2024 - 25</h2>

            <div class="form-group label-floating reg_name_div">
                <label class="control-label widget_label" for="Name">Name <span class="required">*</span></label>
                <input type="text" name="name" id="Name" autocomplete="off" class="form-control widget_input" maxlength="255" minlength="1" placeholder="Enter Name *" value="" />
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="control-label widget_label" for="Email">Email Address <span class="required">*</span></label>
                <input type="text" name="Email" id="Email" autocomplete="off" maxlength="50" class="form-control widget_input" data-type="text" placeholder="Enter Email Address *" value="" />
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="control-label widget_label" for="PhoneNumber">PhoneNumber <span class="required">*</span></label>
                <input id="phone" type="tel" name="phone" placeholder="Enter Mobile Number" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
                <script>
                    const phoneInputField = document.querySelector("#phone");
                    const phoneInput = window.intlTelInput(phoneInputField, {
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                    });
                </script>
            </div>

            <div class="form-group">
                <label class="control-label widget_label" for="SelectCity" name="city">Select City</label>
                <select id="countrySelect" size="1" onchange="makeSubmenu(this.value)">
                    <option value="" disabled selected>Choose State</option>
                    <option>Andaman and Nicobar</option>
                    <option>Andhra Pradesh</option>
                    <option>Gujarat</option>
                    <option>Delhi</option>
                    <option>Kerala</option>
                    <option>Odisha</option>
                    <option>Tamil Nadu</option>
                </select>
                <select id="citySelect" size="1" name="city">
                    <option value="" disabled selected>Choose City</option>
                </select>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="control-label widget_label" for="SelectProgram" name="course">Select Course:</label>
                <select id="program" onchange="populateSpecializations()" name="program">
                    <option value="">Select Course</option>
                    <option value="computer_science">Course 1</option>
                    <option value="engineering">Course 2</option>
                </select>
            </div>

            <div id="specializationContainer">
                <label for="specialization">Select Specialization:</label>
                <select id="specialization" name="program">
                    Options will be populated dynamically
                </select>
            </div>


            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="Agree" value="0" />
                        <input type="checkbox" name="Agree" value="1" id="Agree" class="widget_input" />
                        <span class="agree-condition">I agree to receive information regarding my submitted application by signing up on CHARUSAT University *</span>
                    </label>
                </div>
                <span class="help-block"></span>
            </div>

            <input type="submit" value="Submit" id="submitButton">
        </div>
    </div>
</form>

<script>
    var citiesByState = {
        "Odisha": ["Bhubaneswar", "Puri", "Cuttack"],
        "Maharashtra": ["Mumbai", "Pune", "Nagpur"],
        "Delhi": ["Delhi", "New Delhi", "Gurgaon"],
        "Uttar Pradesh": ["Nashik", "Pune", "Mumbai"],
        "Kerala": ["Kochi"],
        "Gujarat": ["Baroda", "Ahmedabad", "Surat", "Mehsana", "Nadiad", "Anand"],
        "Tamil Nadu": ["Chennai", "Coimbatore", "Madurai"]
    };

    function makeSubmenu(value) {
        var citiesOptions = "";
        if (value.length == 0) {
            document.getElementById("citySelect").innerHTML = "<option></option>";
        } else {
            for (var cityId in citiesByState[value]) {
                citiesOptions += "<option>" + citiesByState[value][cityId] + "</option>";
            }
            document.getElementById("citySelect").innerHTML = citiesOptions;
        }
    }

    function populateSpecializations() {
        var programDropdown = document.getElementById("program");
        var specializationContainer = document.getElementById("specializationContainer");
        var specializationDropdown = document.getElementById("specialization");

        specializationDropdown.innerHTML = "";

        if (programDropdown.value === "") {
            specializationContainer.style.display = "none";
            return;
        }

        specializationContainer.style.display = "block";

        switch (programDropdown.value) {
            case "computer_science":
                specializationDropdown.innerHTML += '<option value="SP1">SP1</option>';
                specializationDropdown.innerHTML += '<option value="SP2">SP2</option>';
                specializationDropdown.innerHTML += '<option value="SP3">Sp3</option>';
                break;
            case "engineering":
                specializationDropdown.innerHTML += '<option value="SP4">SP4</option>';
                specializationDropdown.innerHTML += '<option value="SP5">SP5</option>';
                specializationDropdown.innerHTML += '<option value="SP6">SP6</option>';
                break;
        }
    }
</script>




<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        overflow: hidden;
        /* Prevent scrolling */
    }

    .background-image {
        background-image: url('images/charusatgate.jpg');
        /* Set the background image */
        background-size: cover;
        /* Cover the entire viewport */
        background-position: center center;
        background-repeat: no-repeat;
        /* Center the background image */
        width: 100vw;
        /* Set the width to full viewport width */
        height: 100vh;
        /* Set the height to full viewport height */
        display: flex;
        /* Use flexbox for vertical alignment */
        justify-content: right;
        /* Center horizontally */
        align-items: center;
        /* Center vertically */
        margin-left: -73px;
        /* Remove default body margin */
        margin-right: -50px;
    }


    .admission-form {
        background-color: rgba(255, 255, 255, 0.8);
        /* Set a semi-transparent background color for the form */
        padding: 20px;
        border-radius: 10px;
        /* Add border-radius for rounded corners */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        width: 600px;
        /* Adjust width as needed */
    }

    .form-group {
        margin-bottom: 20px;
        /* Add space between form groups */
    }

    .help-block {
        color: #dc3545;
        font-size: 12px;
        /* Adjust font size and color for error messages */
    }

    .input.text {
        margin-bottom: 20px;
        /* Add space between form fields */
    }

    input[type="submit"] {
        width: 100%;
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>


@endsection