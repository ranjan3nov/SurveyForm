var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function () {
    if (animating || !validateFieldset($(this).parent())) return false;
    animating = true;

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //activate next step on progressbar using the index of next_fs
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({ opacity: 0 }, {
        step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = (now * 50) + "%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({
                'transform': 'scale(' + scale + ')',
                'position': 'absolute'
            });
            next_fs.css({ 'left': left, 'opacity': opacity });
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});

$(".previous").click(function () {
    if (animating) return false;
    animating = true;

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

    //show the previous fieldset
    previous_fs.show();
    //hide the current fieldset with style
    current_fs.animate({ opacity: 0 }, {
        step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1 - now) * 50) + "%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({ 'left': left });
            previous_fs.css({ 'transform': 'scale(' + scale + ')', 'opacity': opacity });
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});

function validateFieldset(fieldset) {

    var isValid = true;
    var inputs = fieldset.find('input[required], select[required]');

    var warningMessage = fieldset.find(".fs-warning");

    inputs.each(function () {
        if (!$(this).val().trim()) {
            warningMessage.show();

            isValid = false;
            return false; // exit the loop early
        }
    });

    if (isValid) {
        warningMessage.hide();
    }

    return isValid;
}

// Checkbox validation
const checkboxGroups = document.querySelectorAll('.checkBox input[type="checkbox"]');
const submitButton = document.getElementById('checkTermsButton');
checkboxGroups.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        const allChecked = Array.from(checkboxGroups).every(checkbox => checkbox.checked);
        submitButton.disabled = !allChecked;
    });
});



$(document).ready(function () {

    // password toggler
    $(".toggle-password").click(function () {
        var passwordInput = $("#password");
        var icon = $(this).find("i");

        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            passwordInput.attr("type", "password");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        }
    });
});

// Country Name And Dial Code
document.addEventListener("DOMContentLoaded", async function () {
    // Fetch Country Dial Code
    const countryCodeElement = document.getElementById('countryCode');
    try {
        const response = await fetch('asset/data/data.json');
        const countryData = await response.json();
        countryData.forEach(country => {
            const option = document.createElement('option');
            option.value = country.code;
            option.textContent = country.code;
            countryCodeElement.appendChild(option);
        });
    } catch (error) {
        console.error('Error loading or parsing JSON:', error);
    }
    // Fetch Country Name
    const countryNameElement = document.getElementById('country');
    try {
        const response = await fetch('asset/data/data.json');
        const countryData = await response.json();
        countryData.forEach(country => {
            const option = document.createElement('option');
            option.value = country.name;
            option.textContent = country.name;
            countryNameElement.appendChild(option);
        });
    } catch (error) {
        console.error('Error loading or parsing JSON:', error);
    }
});