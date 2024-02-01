<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Full Stack Developer practical test</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <form action="/upload/">
        <input type="submit" value="Upload file" />
    </form>
    <label for="selectOption">Select Option:</label>
    <select id="selectOption">
        <?php foreach ($locations as $location): ?>
            <option value="<?= $location ?>"><?= $location ?></option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <!-- Slider -->
    <label for="sliderValue">Slider Value: <span id="sliderLabel">50</span></label>
    <input type="range" id="sliderValue" min="0" max="100000" value="50">

    <br><br>

    <!-- Button to Trigger AJAX -->
    <button id="sendDataButton">Send Data</button>

    <div id="locations"></div>

    <script>
        $(document).ready(function () {
            // Button click event
            $("#sendDataButton").click(function () {
                // Get values from select and slider
                var selectedOption = $("#selectOption").val();
                var sliderValue = $("#sliderValue").val();

                // Prepare data to send
                var sendData = {
                    place: selectedOption,
                    range: sliderValue
                };

                // AJAX request
                $.ajax({
                    type: "POST",
                    url: "/locations/", // Replace with your server-side script URL
                    data: sendData,
                    success: function (response) {
                        displayLocations(response.locations);
                    },
                    error: function (error) {
                        console.error("Error sending data:", error);
                    }
                });
            });

            // Slider change event to update label
            $("#sliderValue").on("input", function () {
                $("#sliderLabel").text($(this).val());
            });


            function displayLocations(dataArray) {
                let container = document.getElementById('locations');
                container.innerHTML = "";
                let ul = document.createElement('ul');

                for (let i = 0; i < dataArray.length; i++) {
                    let dataItem = dataArray[i];
                    let li = document.createElement('li');
                    li.textContent = 'Place: ' + dataItem

                    ul.appendChild(li);
                }

                container.appendChild(ul);
            }
        });
    </script>
</body>
</html>
