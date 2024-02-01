function uploadCSV() {
    var formData = new FormData($('#csvForm')[0]);
    console.log("HETE")
    $.ajax({
        url: 'upload.php', // Replace with the path to your server-side script
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            // Handle success response from the server
        },
        error: function(error) {
            console.error(error);
            // Handle error response from the server
        }
    });
}
