<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>transfer data</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    <style>
        .sidebar {
            background-color: #eeeeee;
            position: absolute;
            z-index: 10000;
            right: 0;
            width: 55%;
            height: 100vh;
            transition: 0.5s;
            box-shadow: -1px 0px 23px #22222224;
        }

        .sidebar .close {
            padding: 20px 15px;
            border-bottom: 2px solid #80808033;
            background: #fff;
        }

        .sidebar .close i {
            color: #6666669c;
            font-size: 25px;
            cursor: pointer;
            transition: 0.3s;
        }

        .sidebar .close i:hover {
            color: #666;
        }

        .sidebar .header-container {
            padding: 20px 15px;
            display: flex;
            background: #fff;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #80808033;
        }

        .sidebar .header-container .title h2 {
            font-size: 30px;
            margin-bottom: 5px;
        }

        .sidebar .header-container .title p {
            background: #fff;
            padding: 0;
            font-weight: 500;
        }

        .sidebar .header-container button {
            background: #5268ff;
            color: #fff;
            font-size: 18px;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }

        .sidebar .header-container button:hover {
            background-color: #253eed;
        }

        .sidebar .files {
            display: grid;
            grid-template-columns: repeat(2, minmax(250px, 1fr));
            /* column-gap: 10px;
            row-gap: 10px; */
            gap: 10px;
            padding: 30px;
        }

        .sidebar .files .file {
            background: #fff;
            padding: 15px 25px;
            border-radius: 5px;
            box-shadow: 2px 3px 4px #22222224;
        }

        .sidebar .files .file>div {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar .files .file>div p {
            background: #fff;
            font-size: 16px;
            padding: 0;
            font-weight: 500;
            color: #222;
            word-wrap: break-word;
            max-width: 85%;
        }

        .sidebar .files .file>div a {
            color: #5268ff;
            border: 2px solid;
            width: 22px;
            height: 22px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            border-radius: 50%;
            position: relative;
            top: 8px;
            transition: 0.3s;
        }

        .sidebar .files .file>div a:hover {
            color: #253eed;
        }

        .sidebar .files .file>div a i {
            font-size: 14px;
        }

        .sidebar .file .size {
            font-size: 14px;
            color: #666;
        }

        .hidden-sidebar {
            overflow: hidden;
            width: 0;
        }
    </style>
</head>

<body>
    <div class="content">

        <form action="{{ route('download', $file->identifier) }}" method="get" id="file-download">
            <div class="download" id="header">
                <i class="fa-solid fa-arrow-down"></i>
                <h3>Ready when you are</h3>
                <span>Transfer expires in 7 days</span>
                <p class="title">{{ $file->title }} </p>

            </div>
            <hr>
            <div class="visible" id='link-content'>
                <div class="download-information">
                    <div>
                        <div class="number-of-file">{{ count($file->path) }} file</div>
                        <a class="preview" style="cursor: pointer;"
                            onclick="document.getElementById('sidebar').classList.toggle('hidden-sidebar')">Preview</a>
                    </div>
                    <small class="size">{{ $file->total_size }}MB</small>
                </div>
            </div>
            <hr>
            <div class="button" style="width: fit-content; margin-left:auto;margin-right:auto;">
                <button type="submit" class="active" style="margin-left: 0px;">Download</button>
            </div>
        </form>

    </div>
    <div class="sidebar hidden-sidebar" id="sidebar">
        <div class="close" onclick="this.parentNode.classList.toggle('hidden-sidebar')">
            <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="header-container">
            <div class="title">
                <h2>Items in this transfer</h2>
                <p>{{ count($file->path) }} files {{ $file->total_size }} MB - transfer expires in 7 days</p>
            </div>
            <button type="submit" onclick="document.getElementById('file-download').submit()">Download</button>
        </div>
        <div class="files">
            @foreach ($file->path as $path)
                <div class="file">
                    <div>
                        <p>{{ Str::after($path, '*') }}</p>
                        <a href="{{ route('file.download', ['path' => $path]) }}"><i
                                class="fa-solid fa-arrow-down"></i></a>
                    </div>
                    <div class="size">{{ $file->getFileSize($path) }} MB</div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
