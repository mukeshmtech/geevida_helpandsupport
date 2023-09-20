//********** AJAX LOGIN FORM - API */
$("#ghs_login_btn").on('click',function(ev){

    ev.preventDefault();

    var requestFormValidate=$("#ghs_loginForm").valid();

    if(requestFormValidate){

        $('.preloader').show();

        var jsonData = {
            user_name:$('#usermail').val(),
            password:$('#userpass').val(),
        };

        $.ajax({
            url:baseAPIUrl+'userLoginApi',
            type:"POST",
            contentType: 'application/json',
            data: JSON.stringify(jsonData),
            success:function(response){

                console.log(response);

                if(response.data=="1")
                {
                    $("#alertmsg").hide();

                    swal({
                        title: "Login Success",
                        icon: "success",
                        className: "alertbox",
                        buttons: {
                            confirm: {
                                text: 'Close',
                                className: 'alertbtn'
                            },
                        },
                    }).then(function() {
                        console.log("Success home page");
                        window.location=baseUrl+"home.php";
                    });
                }
                else
                {
                    $("#alertmsg").show();
                }
            },
            complete:function(){

                $('.preloader').hide();

            },
            error:function(data){
                console.log("Error"+data);
            }
        });
    }
    else
    {
        alert("Please fill the mandatory details");
    }    
});

//********** AJAX Registration FORM - API */
$("#ghs_reg_btn").on('click',function(ev){

    ev.preventDefault();

    var requestFormValidate=$("#reg-frm").valid();

    if(requestFormValidate){

        $('.preloader').show();

        var serializedData = $("#reg-frm").serialize(); // Serialize the form data
        var formData = decodeURIComponent(serializedData.replace(/\+/g, ' ')); // Decode the serialized data if needed
        var formDataArray = formData.split('&'); // Split the serialized data into an array
        var jsonObject = {};
        // Convert the array into a JSON object
        for (var i = 0; i < formDataArray.length; i++) {
            var item = formDataArray[i].split('=');
            jsonObject[item[0]] = item[1];
        }
        var jsonString = JSON.stringify(jsonObject); // Convert the JSON object to a JSON string
        
        $.ajax({
            url:baseAPIUrl+'userRegisterApi',
            type:"POST",
            contentType: 'application/json',
            data: jsonString,
            success:function(response){

                //console.log("response", response);
                if(response.data=="1")
                {
                    $("#alertMsgReg").hide();

                    swal({
                        title: "Register Success",
                        icon: "success",
                        className: "alertbox",
                        buttons: {
                            confirm: {
                                text: 'Close',
                                className: 'alertbtn'
                            },
                        },
                    }).then(function() {
                        console.log("Success home page");
                        window.location=baseUrl+"home.php";
                    });
                }
                else if(response.data==2)
                {
                    $("#alertMsgReg").show();

                    swal({
                        title: "EmailId Already Exists",
                        icon: "warning",
                        className: "alertbox",
                        buttons: {
                            confirm: {
                                text: 'Close',
                                className: 'alertbtn'
                            },
                        },
                    });
                }
                else if(response.data==0)
                {
                    $("#alertMsgReg").show();
                }
            },
            complete:function(){
                $('.preloader').hide();
            },
            error:function(data){
                console.log("Error"+data);
            }
        });
    }
});


//**********Post ticket FORM - API */
$("#post_ticket_btn").on('click',function(ev){

    ev.preventDefault();

    var requestFormValidate=$("#submit-ticket-form").valid();

    if(requestFormValidate){

        var formData = new FormData(document.getElementById("submit-ticket-form"));

        console.log("formData", formData);

        $.ajax({
            url:baseAPIUrl+'userPostTicketApi',
            type:"POST",
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){

                try {
                    var jsonResponse = JSON.parse(response);
                    console.log(jsonResponse);
                } catch (e) {
                    console.log("Error parsing JSON response:", e);
                }
               
            },
            complete:function(){
                $('.preloader').hide();
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error:", status, error);
                console.log("Response:", xhr.responseText);
            }
        });
    }
});