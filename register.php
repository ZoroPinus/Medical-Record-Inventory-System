<?php include 'includes/header.php'; ?>
<style>
    body {
        background-color: #009688;
    }

    .authentication-wrapper {
        background-color: #175800;
    }

    .btn-primary {
        color: #fff;
        background-color: #175800;
    }

    .login-link {
        display: block;
        text-align: center;
        margin-top: 10px;
        color: #175800;
        text-decoration: none;
    }

    .login-link:hover {
        text-decoration: underline;
    }
</style>

<body>
    <!-- Content -->
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Register Forms -->
                <div class="card p-2">


                    <div class="app-brand justify-content-center mt-5">
                        <a href="index.php" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="assets/img/avatars/school-logo.png" alt="School Logo" width="150">
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <!-- Student Register Form -->
                    <div id="userRegisterForm">
                        <div class="card-body mt-2">
                            <form id="formUserAuthentication" class="mb-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name" autofocus />
                                    <label for="firstName">First Name</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" />
                                    <label for="lastName">Last Name</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="email" class="form-control" id="userUsername" name="userUsername" placeholder="Email" />
                                    <label for="userUsername">Email</label>
                                </div>
                                <div class="mb-3">
                                    <div class="form-password-toggle">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="password" id="userPassword" class="form-control" name="userPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                                <label for="userPassword">Password</label>
                                            </div>
                                            <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-password-toggle">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="password" id="confUserPassword" class="form-control" name="confUserPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                                <label for="confUserPassword">Confirm Password</label>
                                            </div>
                                            <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary d-grid w-100" type="submit">Register</button>
                                </div>
                            </form>
                            <div class="mb-3 ">
                                <a href="./" class="login-link">Already have an account?</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</body>
<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    document.getElementById("formUserAuthentication").addEventListener("submit", function(event) {
        event.preventDefault();
        handleRegister('user');
    });

    function handleRegister(userType) {
        var emailInput = document.getElementById("userUsername");
        var passwordInput = document.getElementById("userPassword");
        var confpasswordInput = document.getElementById("confUserPassword");
        var firstNameInput = document.getElementById("firstName");
        var lastNameInput = document.getElementById("lastName");

        if (passwordInput.value !== confpasswordInput.value) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid. Please check your password and try again.',
            });
            return
        }

        var email = emailInput.value;
        var password = passwordInput.value;
        var firstName = firstNameInput.value;
        var lastName = lastNameInput.value;

        removeError(emailInput);
        removeError(passwordInput);



        var loadingIndicator = Swal.fire({
            title: 'Creating account...',
            allowOutsideClick: false,
            showConfirmButton: false, // Hide the "OK" button
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });

        setTimeout(function() {
            fetch("model/register_user.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: new URLSearchParams({
                        firstName: firstName,
                        lastName: lastName,
                        email: email,
                        password: password,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Fetch Success:", data);
                    console.log("Fetch Success:", data.status);

                    if (data.status == 'success') {
                        var userType = data.user_type;
                        console.log("User Role: " + userType);

                        switch (userType) {
                            case "admin":
                                sessionStorage.setItem("userType", "admin");
                                window.location.href = "index.php";
                                break;
                            // case "user":
                            //     sessionStorage.setItem("userType", "user");
                            //     window.location.href = "user/index.php";
                            //     break;
                            default:
                                console.error("Unknown userType:", userType);
                        }
                    } else {
                        showError(emailInput, 'Register Failed', data.message || 'An error occurred during Register.');
                        // showError(passwordInput);
                    }
                })
                .catch(error => {
                    console.error("Fetch Error:", error);
                    console.log(error)
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Invalid. Please check your credentials and try again.',
                    });
                })
                .finally(() => {
                    loadingIndicator.close();
                });
        }, 500);
    }

    function showError(input, title, message) {
        input.classList.add("border", "border-danger");
        Swal.fire({
            icon: 'error',
            title: title,
            text: message,
        });
    }

    function removeError(input) {
        input.classList.remove("border", "border-danger");
    }
</script>