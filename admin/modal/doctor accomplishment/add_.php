<style>
  /* Hide the original checkbox */
  /* Style the fake checkbox */
  .styled-checkboxgreen {
    position: relative;
    display: inline-block;
    width: 20px;
    height: 20px;
    background-color: #ccc;
    border-radius: 3px;
    margin-right: 10px;
  }

  .styled-checkboxgreen {
    position: relative;
    display: inline-block;
    width: 20px;
    height: 20px;
    background-color: #fff;
    border-radius: 3px;
    margin-right: 10px;
  }

  /* Style the checkmark */
  .styled-checkboxgreen::after {
    content: "";
    position: absolute;
    display: none;
    left: 6px;
    top: 2px;
    width: 8px;
    height: 13px;
    border: solid green;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
  }

  /* Show the checkmark when the checkbox is checked */
  input[type="checkbox"]:checked+.styled-checkboxgreen::after {
    display: block;
  }


  /* Style the fake checkbox */
  .styled-checkboxred {
    position: relative;
    display: inline-block;
    width: 20px;
    height: 20px;
    background-color: #ccc;
    border-radius: 3px;
    margin-right: 10px;
  }

  .styled-checkboxred {
    position: relative;
    display: inline-block;
    width: 20px;
    height: 20px;
    background-color: #fff;
    border-radius: 3px;
    margin-right: 10px;
  }

  /* Style the checkmark */
  .styled-checkboxred::after {
    content: "";
    position: absolute;
    display: none;
    left: 6px;
    top: 2px;
    width: 8px;
    height: 13px;
    border: solid red;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
  }

  /* Show the checkmark when the checkbox is checked */
  input[type="checkbox"]:checked+.styled-checkboxred::after {
    display: block;
  }



  .modal-table .subRow th {
    width: 100%;
    white-space: nowrap;
    padding: 10px;
    /* Adjust the width as needed */
  }
</style>
<!-- Modal for adding a new physical examination record -->
<div class="modal fade" id="addCovid19Report" tabindex="-1" role="dialog" aria-labelledby="medicalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <!-- Modal header with close button -->
      <div class="modal-header">
        <h5 class="modal-title" id="medicalModalLabel">Doctor Accomplishments</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal body with form for entering physical examination data -->
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <form id="addDoctorAccomplishmentForm">
              <!-- Certificate container with school logo and title -->
              <div class="certificate-container rounded shadow p-4 mb-5 " id="frame">
                <div class="certificate-header d-flex justify-content-center align-items-center mb-4">
                  <img src="../assets/img/avatars/school-logo.png" class="img-fluid logo mr-3" alt="Logo">
                  <div class="certificate-title-container text-center">
                    <h2 class="certificate-title d-inline-block mb-0">Union Christian College</h2>
                    <p>Widdoes St., Brgy. II, San Fernando City La Union<br>
                      2500 Philippines<br>
                      URL Address: www.ucc.edu.ph</p>
                    <h4>OFFICE OF STUDENT AFFAIRS & SERVICES</h4>
                  </div><span class="ml-3"></span>
                  <img src="../assets/img/avatars/church-logo.png" class="img-fluid logo mr-3" alt="Logo">
                </div>
                <div class="certificate-content text-center">
                  <h6>ACCOMPLISHMENT REPORT FOR THE MONTH OF <input type="text" style="border: none; border-bottom: 1px solid black;text-align:center;width:100px" id="date" name="date" value="<?php
                                                                                                                                                                                                $specificDate = date('Y-m-d');
                                                                                                                                                                                                $formattedDate = date('M j, Y', strtotime($specificDate));
                                                                                                                                                                                                echo $formattedDate; // Output: Feb 12, 2023
                                                                                                                                                                                                ?>">
                  </h6><br>
                </div>
                <br>

                <table class="modal-table">
                  <thead>
                    <tr style="text-align:center;border:1px solid black;padding:10px">
                      <th style="text-align:center;border:1px solid black;padding:10px">PROGRAMS /PROJECTS /ACTIVITIES</th>
                      <th style="text-align:center;border:1px solid black;padding:10px">SUCCESS INDICATOR (TARGETS & MEASURES)</th>
                      <th style="text-align:center;border:1px solid black;padding:10px">ACCOMPLISHMENTS (ACTUAL)</th>
                      <th style="text-align:center;border:1px solid black;padding:10px">PROBLEMS /ISSUES /CONCERNS</th>
                      <th style="text-align:center;border:1px solid black;padding:10px">ACTION TAKEN /RECOMMENDATIONS</th>
                    </tr>
                    <tr>
                      <th colspan="5" style="text-align:center;border:1px solid black;padding:5px">Student Affairs & Services (OSAS)</th>
                    </tr>
                    <tr>
                      <th colspan="5" style="text-align:left;border:1px solid black;padding:10px">B. Provision of Medical & Dental Services</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><textarea class="form-control" style="height:100px"></textarea></td>
                      <td><textarea class="form-control" style="height:100px"></textarea></td>
                      <td><textarea class="form-control" style="height:100px"></textarea></td>
                      <td><textarea class="form-control" style="height:100px"></textarea></td>
                      <td><textarea class="form-control" style="height:100px"></textarea></td>
                    </tr>

                  </tbody>
                </table>

                <br>
                <div class="row">
                  <div class="col-md-4">
                    <ul>
                      <li>Prepared By:</li>
                      <li style="text-decoration: underline;">
                        <input type="text" class="form-control" id="nurseName" name="nurseName" placeholder="Enter Name">
                      </li>
                      <li class="font-italic mt-1">School Nurse</li>
                    </ul>
                  </div>
                  <div class="col-md-4">

                  </div>
                  <div class="col-md-4 mt-4">
                    <ul>
                      <li style="text-decoration: underline;">
                        <input type="text" class="form-control" id="doctorName" name="doctorName" placeholder="Doctor's Name">
                      </li>
                      <li class="font-italic mt-1">School Doctor</li>
                    </ul>
                  </div>
                </div>

              </div>
              <!-- Modal footer with download button and close button -->
              <div class="modal-footer">
                <button type="button" class="btn btn-success remove-column-btn">Remove Column</button>
                <button type="button" class="btn btn-success" onclick="addColumn()">Add Column</button>
                <button type="submit" class="btn btn-primary" onclick="print()">Print</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



  <script>
    // Function to remove the last column from the table
    // Function to remove the last column (td) from each row (tr) in the table
    function removeColumn() {
      var table = document.querySelector('.modal-table');
      var rows = table.querySelectorAll('tbody');

      // Loop through each row
      rows.forEach(function(row) {
        // Remove the last cell (td) from the row
        var cells = row.querySelectorAll('tr');
        if (cells.length > 0) {
          row.removeChild(cells[cells.length - 1]);
        }
      });
    }

    // Event listener for the "Remove Column" button
    document.querySelector('.remove-column-btn').addEventListener('click', function() {
      removeColumn();
    });

    function addColumn() {
      var table = document.querySelector('.modal-table');
      var tbody = table.querySelector('tbody');
      var newRow = document.createElement('tr');

      // Create four cells (td) with textareas in the new row
      for (var i = 0; i < 5; i++) {
        var cell = document.createElement('td');
        var textarea = document.createElement('textarea');
        textarea.classList.add('form-control');
        textarea.style.height = '100px';
        cell.appendChild(textarea);
        newRow.appendChild(cell);
      }

      // Append the new row to the tbody
      tbody.appendChild(newRow);
    }


    function print() {
      var node = document.getElementById('frame');

      // Set white background color
      node.style.backgroundColor = '#fffffff';

      // Convert the DOM node to PNG image with white background color
      domtoimage.toPng(node)
        .then(function(dataUrl) {
          var img = new Image();
          img.src = dataUrl;
          // Download the image
          // downloadURI(dataUrl, "Physical_Exam_Record.png");

          // Log the base64 data
          console.log("Base64 Data:", dataUrl);
          printImage(img);
          // Save the image and checkbox state
          saveDataURL(dataUrl);
        })
        .catch(function(error) {
          console.error('Oops, something went wrong', error);
        });
      // Function to save data URL to server
      function saveDataURL(dataUrl) {
        var doctorName = document.getElementById('doctorName').value;
        var preparedByName = document.getElementById('nurseName').value;
        $.ajax({
          url: 'model/doctor_accomplishment/upload.php',
          type: 'POST',
          data: {
            imageCode: dataUrl,
            doctorsName: doctorName,
            preparedByName: preparedByName   
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
    // Function to print image
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