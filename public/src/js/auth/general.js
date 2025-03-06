"use strict";

var KTSigninGeneral = (function () {
    var form, submitButton, validation;

    function handleValidation() {
        validation = FormValidation.formValidation(form, {
            fields: {
                email: {
                    validators: {
                        regexp: {
                            regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                            message: "The value is not a valid email address"
                        },
                        notEmpty: {
                            message: "Email address is required"
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

    function showSuccessMessage() {
        Swal.fire({
            text: "You have successfully logged in!",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            allowOutsideClick: false,
            customClass: {confirmButton: "btn btn-primary"}
        }).then(function (result) {
            if (result.isConfirmed) {
                form.reset();
                var redirectUrl = form.getAttribute("data-kt-redirect-url");
                if (redirectUrl)
                    location.href = redirectUrl;
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

                var formAction = form.getAttribute("action");
                var isExternalURL = (() => {
                    try {
                        return new URL(formAction), true;
                    } catch {
                        return false;
                    }
                })();

                if (isExternalURL) {
                    axios.post(formAction, new FormData(form))
                            .then(response => {
                                if (response)
                                    showSuccessMessage();
                                else
                                    showErrorMessage(response);
                            })
                            .catch(err => {
                                var errmessage = err.toJSON();
                                showErrorMessage(err.response.data.message + ", " + errmessage.message);
                            })
                            .finally(() => {
                                submitButton.removeAttribute("data-kt-indicator");
                                submitButton.disabled = false;
                            });
                } else {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                    showSuccessMessage();
                }
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