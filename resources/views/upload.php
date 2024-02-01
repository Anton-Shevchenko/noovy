<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV File Upload</title>
</head>
<body>

<form id="csvForm" enctype="multipart/form-data">
    <input type="file" name="csvFile" id="csvFile" accept=".csv">
    <button type="button" onclick="uploadCSV()">Upload CSV</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

    function uploadCSV() {
        let formData = new FormData($('#csvForm')[0]);
        console.log("HETE")
        $.ajax({
            url: '/upload/csv/', // Replace with the path to your server-side script
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function() {
                window.location.href = "/";
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>

</body>
</html>
