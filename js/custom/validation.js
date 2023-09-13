$(document).ready(function(){

    jQuery('input[name="password"]').focus( function() {
        let e = jQuery(this);
        e.closest("form").validate().element(e);
        jQuery('#password-match').slideDown(600);
    });
    
    jQuery('input[name="password"]').blur( function() {
        jQuery('#password-match').slideUp(600);
    });

    jQuery.validator.addMethod("custompassword", function (value, element) {
        var decimal = /^(?=.*[0-9])(?=.*[a-z]).{6,15}$/;
        var rules = [
            {
                Pattern: "[a-z]",
                Target: "p-lowercase"
            },
            {
                Pattern: "[0-9]",
                Target: "p-number"
            }
        ];
        var password = value;
        jQuery("#p-length").removeClass(password.length > 6 && password.length < 15 ? "text-danger" : "text-success");
        jQuery("#p-length").addClass(password.length > 6 && password.length < 15  ? "text-success" : "text-danger");
        jQuery("#p-length").find('i').removeClass(password.length > 6 && password.length < 15 ? "fa-times" : "fa-check");
        jQuery("#p-length").find('i').addClass(password.length > 6 && password.length < 15  ? "fa-check" : "fa-times");
        for (var i = 0; i < rules.length; i++) {
            jQuery("#" + rules[i].Target).removeClass(new RegExp(rules[i].Pattern).test(password) ? "text-danger" : "text-success");
            jQuery("#" + rules[i].Target).find("i").removeClass(new RegExp(rules[i].Pattern).test(password) ? "fa-times" : "fa-check");
            jQuery("#" + rules[i].Target).find("i").addClass(new RegExp(rules[i].Pattern).test(password) ? "fa-check" : "fa-times");
            jQuery("#" + rules[i].Target).addClass(new RegExp(rules[i].Pattern).test(password) ? "text-success" : "text-danger");
        }
        if (value.match(decimal)) {
            return true;
        } else {
            return false;
        };
    }, "Password does not satisfy below conditions");

    //********** Login Form Validation **********//

    $("#ghs_loginForm").validate({

        errorPlacement: function errorPlacement(error, element) { element.after(error); },

        ignore: ".ignore",
        focusInvalid: false,

        rules: {
            usermail: {
                required: true
            },
            userpass: {
                required: true
            },
        
        },
        messages: {
            usermail: {
                required: "User mail is required",
            },
            userpass: {
                required: "Password is required",
            },
            
        },
        invalidHandler: function(form, validator) {
            if (!validator.numberOfInvalids())
                return;

            jQuery('html, body').animate({
                scrollTop: jQuery(validator.errorList[0].element).offset().top - 70
            }, 1000);
        }
    });

    //********** Registration Form Validation **********//

    $("#reg-frm").validate({

        errorPlacement: function errorPlacement(error, element) { element.after(error); },

        ignore: ".ignore",
        focusInvalid: false,

        rules: {
            name: {
                required: true
            },
            email: {
                required: true
            },
            password: {
                required: true,
                custompassword: true
            },
            mobile: {
                required: true,
                number: true,
                phoneUS: true
            },
            dob: {
                required: true
            },
            gender: {
                required: true
            },
            state: {
                required: true
            },
            city: {
                required: true
            }
        
        },
        messages: {
            name: {
                required: "Your name is required",
            },
            email: {
                required: "Your email is required", 
            },
            password: {
                required: "Your password is required",
            },
            mobile: {
                required: "Your mobile number is required",
                number: 'Enter valid mobile number'
            },
            dob: {
                required: "Your dob is required",
            },
            gender: {
                required: "Your gender is required",
            },
            state: {
                required: "Your state is required",
            },
            city: {
                required: "Your city is required",
            },
            
        },
        invalidHandler: function(form, validator) {
            if (!validator.numberOfInvalids())
                return;

            jQuery('html, body').animate({
                scrollTop: jQuery(validator.errorList[0].element).offset().top - 70
            }, 1000);
        }
    });	

});