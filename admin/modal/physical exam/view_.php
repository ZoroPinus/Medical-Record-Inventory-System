<!-- View Physical Examination Modal -->
<div class="modal fade" id="viewPhysicalExamModal" tabindex="-1" role="dialog" aria-labelledby="viewPhysicalExamModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewPhysicalExamModalLabel">View Physical Examination</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="frame1">
        <!-- Physical Examination Details -->
        <div id="physicalExamDetails"></div>
      </div>
     
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="download btn btn-success" onclick="download1()">Print</button>
          </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
  $('#viewPhysicalExamModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recordId = button.data('record-id'); // Get the record ID from the data attribute
console.log(recordId);
    // Fetch physical examination details from the server
    $.ajax({
      url: 'model/physical exam/get_.php',
      method: 'POST',
      data: { record_id: recordId },
      success: function(response) {
        $('#physicalExamDetails').html(response);
      },
      error: function(xhr, status, error) {
        console.error(error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'An error occurred while fetching the physical examination details.'
        });
      }
    });
  });
});

</script>

<script>
function download1() {
        var node = document.getElementById('frame1');
        // Set white background color
        node.style.backgroundColor = 'white';

        domtoimage.toPng(node)
            .then(function (dataUrl) {
                var img = new Image();
                img.src = dataUrl;

                printImage(img);

                // Log the base64 data
                console.log("Base64 Data:", dataUrl);
                //save the image
                saveDataURL(dataUrl, nameValue);
              
            })
            domtoimage.toPng(node)
                .then(function (dataUrl) {
                    // Send the data URL to the PHP script for saving
                    saveDataURL(dataUrl);
                })
                
            .catch(function (error) {
                console.error('Oops, something went wrong', error);
            });
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