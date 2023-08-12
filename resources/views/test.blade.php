<!DOCTYPE html>
<html>

<head>
    <title>Compress Folder</title>
    <style>
        .slidecontainer {
            width: 100%;
        }

        .slider {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 25px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .slider:hover {
            opacity: 1;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            background: #04AA6D;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            background: #04AA6D;
            cursor: pointer;
        }
    </style>
</head>

<body style="width: 60%;margin-left:auto;margin-right:auto;">
    <input type="file" id="folderInput" webkitdirectory directory multiple>
    <button onclick="compressFolder()">Compress Folder</button>
    <div class="slidecontainer">
        <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
        <span class="name">kldjflka</span>
    </div>
    <script>
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value; // Display the default slider value
    </script>
</body>

</html>
