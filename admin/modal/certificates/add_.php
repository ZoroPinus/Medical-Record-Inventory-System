<!-- Modal -->
<div class="modal fade" id="addMedicalCertificate" tabindex="-1" role="dialog" aria-labelledby="MedicalCertificateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="MedicalCertificateModalLabel">Medical Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" id="frame3">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="certificate-container rounded shadow p-4 mb-5">
                            <!-- Certificate Header -->
                            <div class="certificate-header d-flex justify-content-center align-items-center mb-4">
                                <img src="../assets/img/avatars/school-logo.png" class="img-fluid logo mr-3" alt="Logo">
                                <div class="certificate-title-container text-center">
                                    <h2 class="certificate-title d-inline-block mb-0">Union Christian College</h2>
                                </div>
                                <img src="../assets/img/avatars/church-logo.png" class="img-fluid logo ml-3" alt="Logo">
                            </div>
                            <div class="certificate-content text-center">
                                <h4>Office of Student Affairs and Services</h4>
                                <h6>City of San Fernando, La Union</h6>
                                <h6>WELLNESS CLINIC</h6>
                                <h5>Medical Certificate</h5>
                                <!-- Certificate Text -->
                                <p>To whom it may concern:</p>
                                <form id="addMedicalCertificateForm">

                                    <p>This is to certify that
                                        <input type="text" placeholder="ID No" oninput="formatIdNumber(this)" onkeypress="return isNumberKey(event)" style="border: none; border-bottom: 1px solid black;" id="idno" name="idno" class="text-center">
                                        <input type="text" placeholder="Name" style="border: none; border-bottom: 1px solid black;" id="medicalCertificatename" name="name" class="text-center">,
                                        <input type="number" placeholder="Age" style="border: none; border-bottom: 1px solid black; width: 50px;" id="medicalCertificateage" name="age" class="text-center">
                                        years old, residing at
                                        <input type="text" placeholder="Address" style="border: none; border-bottom: 1px solid black; width: 500px;" id="medicalCertificateaddress" name="address" class="text-center">, has been physically examined by the undersigned on
                                        <input type="text" placeholder="Date" style="border: none; border-bottom: 1px solid black; width: 80px;" id="medicalCertificatedate" name="date" class="text-center"> with the following finding/s:
                                    </p>


                                    <div class="text-left">
                                        <p>Remarks <input type="text" style="border: none; border-bottom: 1px solid black;width:400px" id="medicalCertificateremarks" name="remarks"></p>
                                        <!-- Form Fields -->

                                        <!-- Certification Footer -->
                                        <div class="text-left">
                                            <p>This certification is issued upon his/her request for any legal intent and purpose it may serve.</p>
                                            <p>Sincerely,</p>
                                            <input type="text" class="form-control" id="physicianName" style="width:300px" name="physicianName" placeholder="Enter Name">
                                            <p class="py-2">School Physician</p>
                                            <p>Lic. No. <input type="text" class="form-control" id="licNo" style="width:300px" name="licNo" placeholder="Enter License Number"></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" onclick="downloadMedicalCertificate()">Print</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#idno').on('change', function() {
            var idno = $(this).val();
            if (idno) {
                $.ajax({
                    url: 'model/certificates/get_.php',
                    type: 'POST',
                    data: {
                        userId: idno
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {

                            $('#medicalCertificatename').val(response.data.FirstName + ' ' + response.data.MiddleInitial + ' ' + response.data.LastName);
                            var birthDate = new Date(response.data.Birthday);
                            var age = calculateAge(birthDate);
                            $('#medicalCertificateage').val(age);
                            $('#medicalCertificateaddress').val(response.data.Address_Street + ' ' + response.data.Address_City);
                            var dateNow = new Date();
                            var options = {
                                year: 'numeric',
                                month: 'numeric',
                                day: 'numeric'
                            };
                            var formattedDate = dateNow.toLocaleDateString(undefined, options);
                            $('#medicalCertificatedate').val(formattedDate);
                        } else {
                            alert('User not found');
                            
                            console.log(response)
                        }
                    },
                    error: function() {
                        alert('An error occurred');
                    }
                });
            }
        });
    });

    function calculateAge(birthday) {
        var today = new Date();
        var age = today.getFullYear() - birthday.getFullYear();
        var m = today.getMonth() - birthday.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthday.getDate())) {
            age--;
        }
        return age;
    }
</script>
<script>
    function downloadMedicalCertificate() {
        var node = document.getElementById('frame3');
        var studentNameInput = document.getElementById('medicalCertificatename');
        var physicianNameInput = document.getElementById('physicianName');
        var studentName = studentNameInput.value.trim(); // Trim any leading or trailing whitespace
        var physicianName = physicianNameInput.value.trim(); // Trim any leading or trailing whitespace

        // Check if the student name is provided
        if (!studentName) {
            console.error('Error: Student name is required.');
            return; // Exit the function if student name is not provided
        }

        // Set white background color
        node.style.backgroundColor = 'white';

        // Convert the node to PNG
        domtoimage.toPng(node)
            .then(function(dataUrl) {
                var img = new Image();
                img.src = dataUrl;

                // Print the image
                printImage(img);

                // Log the base64 data
                console.log("Base64 Data:", dataUrl);

                // Save the image and name
                saveDataURL(dataUrl, studentName, physicianName);
            })
            .catch(function(error) {
                console.error('Oops, something went wrong', error);
            });

        function saveDataURL(dataUrl, studentName, physicianName) {
            $.ajax({
                url: 'model/certificates/upload.php',
                type: 'POST',
                data: {
                    dataUrl: dataUrl,
                    physicianName: physicianName,
                    name: studentName
                },
                success: function(response) {
                    console.log("Image and name saved successfully:", response);
                },
                error: function(xhr, status, error) {
                    console.error('Error saving image and name:', error);
                }
            });
        }
    }



    function printImage(img) {
        img.onload = function() {
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print Image</title></head><body style="margin: 0; text-align: center;">');
            printWindow.document.write('<img src="' + img.src + '" style="max-width: 100%; max-height: 100%;">');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        };
    }
</script>