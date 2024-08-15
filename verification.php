<?php include'includes/header.php'; ?>

<style>
    body{
    background-color:#16b1ff;
    }
  .btn-primary {
    color: #fff;
    background-color: #ee1921;
    border-color: #ee1921;
}
</style>
<body class="bg-light-gray" id="body" >
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
    <div class="d-flex flex-column justify-content-between">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10"> <!-- Updated column size to col-lg-8 -->
                <div class="card card-default mb-0">
                    <div class="card-header pb-0">
                        <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                        <div id="countdownDisplay" class="text-center mb-3" style="font-size: 1.5rem; color: #007bff;"></div>
        
                        </div>
                    </div>
                    <div class="card-body px-5 pb-5 pt-0">
                        <h4 class="text-dark mb-4 text-left">Confirmation</h4>
                        <hr class="bg-dark">

                        <!-- Alert div for displaying the message -->
                        <div id="alertMessage"></div>

                        <form id="signinForm" action="#">
                            <input type="hidden" id="email" value="<?php echo $_GET['email'] ?? '' ?>"/>
                            <input type="hidden" id="user_type" value="user"/>
                       <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <input
                                        type="text"
                                        class="form-control input-lg"
                                        id="verificationCode"
                                        placeholder="Verification Code"
                                    />
                                    <span id="verificationCodeError" class="text-danger"></span>
                                </div>
                                <div class="col-md-12">
                                    <div style="float:right">
                                        <button
                                            type="button"
                                            class="btn btn-primary bg-verify  btn-sm text-white"
                                            id="BtnLogin"
                                        >
                                            Verify
                                        </button>
                                    </div>
                                    <a href="index.php" class="btn btn-light btn-sm">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function () {
        // Your existing JavaScript code

        // Check if email is not set, display an alert
        if (!"<?php echo isset($_GET['email']) ? $_GET['email'] : '' ?>") {
            $("#alertMessage").html('<div class="alert alert-danger" role="alert">No email attached.</div>');
        }
    });
</script>
    <script>
    $(document).ready(function () {
        $("#BtnLogin").click(function () {
            var verificationCode = $("#verificationCode").val();
            var email = $("#email").val();  // Dynamically fetch the email from the user 
            var user_type = $("#user_type").val();  // Dynamically fetch the user_type from the user input

            if (!verificationCode || verificationCode.length !== 6 || !/^\d+$/.test(verificationCode)) {
                $("#verificationCodeError").text("Invalid verification code");
                return;
            } else {
                $("#verificationCodeError").text("");
            }

            $.ajax({
                type: "POST",
                url: "model/verify.php",
                data: {
                    email: email,
                    verification_code: verificationCode,
                    user_type: user_type
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Verification Successful',
                            text: 'You are now a verified user.',
                        }).then(function() {
                            // Add a delay of 2 seconds before redirecting
                     
                                window.location.href = "index.php";
                          
                        });
                    } else {
                        // Handle other cases if needed
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                },
            });
        });
    });
    // Countdown timer
    var countdown = 180; // 3 minutes in seconds
        var countdownInterval = setInterval(function () {
            countdown--;
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                window.location.href = "../index.php"; // Redirect after 3 minutes
            }
            // Display the countdown in the element with ID "countdownDisplay"
            $("#countdownDisplay").text(formatTime(countdown));
        }, 1000); // Update every second

        // Function to format time as MM:SS
        function formatTime(seconds) {
            var minutes = Math.floor(seconds / 60);
            var remainingSeconds = seconds % 60;
            return (
                (minutes < 10 ? "0" : "") + minutes + ":" + (remainingSeconds < 10 ? "0" : "") + remainingSeconds
            );
        }
</script>
