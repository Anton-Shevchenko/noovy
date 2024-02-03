$(document).ready(function () {
    $("#sendDataButton").click(function () {
        let selectedOption = $("#selectOption").val();
        let sliderValue = $("#sliderValue").val();

        let sendData = {
            place: selectedOption,
            range: sliderValue
        };

        $.ajax({
            type: "POST",
            url: "/locations/",
            data: sendData,
            success: function (response) {
                displayLocations(response.locations);
            },
            error: function (error) {
                console.error("Error sending data:", error);
            }
        });
    });

    $("#sliderValue").on("input", function () {
        $("#sliderLabel").text($(this).val());
    });


    function displayLocations(locations) {
        let container = document.getElementById('locations');
        container.innerHTML = "";
        let ul = document.createElement('ul');
        let key = ""

        for (const loc in locations) {
            let li = document.createElement('li');
            li.innerHTML = `
                <p>${locations[loc].name}</p>
                <img src="https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photo_reference=${locations[loc].thumb}&key=${key}"/>
                `
            ul.appendChild(li);
        }

        container.appendChild(ul);
    }

    $("#upload-file").click(() => {
        let formData = new FormData($('#csvForm')[0]);

        $.ajax({
            url: '/upload/csv/',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                formData.delete('csvForm')
            },
            error: function (error) {
                console.error(error);
            }
        });
    })
});
