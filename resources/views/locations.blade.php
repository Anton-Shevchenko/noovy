@extends('layout')
<div>
    <div>
        <form id="csvForm" enctype="multipart/form-data">
            <input type="file" name="csvFile" id="csvFile" accept=".csv">
            <button type="button" id="upload-file">Upload CSV</button>
        </form>
    </div>

    <div>
        <label for="selectOption">Select Option:</label>
        <select id="selectOption">
            <?php foreach ($locations as $location): ?>
                <option value="<?= $location->name ?>"><?= $location->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="sliderValue">Slider Value: <span id="sliderLabel">100</span></label>
        <input type="range" id="sliderValue" min="0" max="1000" value="100">
        <button id="sendDataButton">Send Data</button>
    </div>
    <div id="locations"></div>
</div>


