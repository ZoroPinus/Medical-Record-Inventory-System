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
  .register-link {
    display: block;
    text-align: center;
    margin-top: 10px;
    color: #175800;
    text-decoration: none;
  }

  .register-link:hover {
    text-decoration: underline;
  }
</style>

<body>
  <!-- Content -->
  <div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Login Forms -->
        <div class="card p-2">


          <div class="app-brand justify-content-center mt-5">
            <a href="index.php" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <img src="assets/img/avatars/school-logo.png" alt="School Logo" width="150">
              </span>
            </a>
          </div>
          <!-- /Logo -->
          <!-- Student Login Form -->
          <div id="userLoginForm">
            <div class="card-body mt-2">
              <form id="formUserAuthentication" class="mb-3">
                <div class="form-floating form-floating-outline mb-3">
                  <input type="email" class="form-control" id="userUsername" name="userUsername" placeholder="Email" autofocus />
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
                  <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
              </form>
              <div class="mb-3">
                <a href="register.php" class="register-link">Don't have an account?</a>
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
  //login form



  document.getElementById("formUserAuthentication").addEventListener("submit", function(event) {
    event.preventDefault();
    handleLogin('user');
  });

  function handleLogin(userType) {
    var emailInput = document.getElementById("userUsername");
    var passwordInput = document.getElementById("userPassword");

    var email = emailInput.value;
    var password = passwordInput.value;
    removeError(emailInput);
    removeError(passwordInput);

    var loadingIndicator = Swal.fire({
      title: 'Logging in...',
      allowOutsideClick: false,
      showConfirmButton: false, // Hide the "OK" button
      onBeforeOpen: () => {
        Swal.showLoading();
      }
    });

    setTimeout(function() {
      fetch("model/login.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({
            username: email,
            password: password,
          }),
        })
        .then(response => response.json())
        .then(data => {
          console.log("Fetch Success:", data);

          if (data.success === true) {
            var userType = data.user.user_type;
            console.log("User Role: " + userType);

            switch (userType) {
              case "admin":
                sessionStorage.setItem("userType", "admin");
                window.location.href = "admin/index.php";
                break;
                //   case "user":
                // sessionStorage.setItem("userType", "user");
                //window.location.href = "user/index.php";
                //  break;
              default:
                console.error("Unknown userType:", userType);
            }
          } else {
            showError(emailInput, 'Login Failed', data.message || 'An error occurred during login.');
            // showError(passwordInput);
          }
        })
        .catch(error => {
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