"use strict";

var KTSigninGeneral = (function () {
    var form, submitButton, validation;

    function handleValidation() {
        validation = FormValidation.formValidation(form, {
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: "Username address is required"
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: "The password is required"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row"
                })
            }
        });
    }

    function showErrorMessage(message) {
        Swal.fire({
            text: message,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            allowOutsideClick: false,
            customClass: {confirmButton: "btn btn-primary"}
        }).then(function () {
            window.location.reload();
        });
    }

    function handleSubmit(event) {
        event.preventDefault();
        
        validation.validate().then(function (status) {
            if (status === "Valid") {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;
                document.getElementById('overlay').style.display = 'flex';
                
            } else {
                showErrorMessage();
            }
        });
    }

    return {
        init: function () {
            form = document.querySelector("#kt_sign_in_form");
            submitButton = document.querySelector("#kt_sign_in_submit");

            handleValidation();
            submitButton.addEventListener("click", handleSubmit);
        }
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});