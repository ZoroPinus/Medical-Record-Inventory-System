<?php
if (isset($_SESSION['alert']) && isset($_SESSION['text'])) {
    $alertClass = $_SESSION['alert'];
    $alertText = $_SESSION['text'];

    echo '<div id="alertMessage" class="alert alert-' . $alertClass . ' alert-dismissible fade show" role="alert">
        <strong>' . $alertText . '</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';

    // Clear the session variables after displaying the alert
    unset($_SESSION['alert']);
    unset($_SESSION['text']);
}
?>

<script>
    // Automatically hide the alert after 3 seconds
    setTimeout(function () {
        $("#alertMessage").alert('close');
    }, 3000);
</script>
