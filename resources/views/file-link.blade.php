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
        .download {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 25px;
            row-gap: 7px;
        }

        .download i {
            color: #6666;
            border: 8px solid;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 60px;
        }

        .download h3 {
            font-size: 22px;
        }

        .download span {
            font-size: 14px;
            color: #6666;
        }

        .download p {
            background-color: transparent;
            color: #666;
        }

        .download-information {
            padding: 10px 30px;
            transition: 0.3s;
        }

        .download-information:hover {
            background-color: #ddd;
        }

        .download-information>div {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .download-information .number-of-file {
            color: #333;
            font-weight: 500;
        }

        .download-information .preview {
            color: #5268ff;
            text-decoration: none;
            transition: 0.3s;
        }

        .download-information .preview:hover {
            color: #253eed;
        }

        .download-information small {
            font-size: 11px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="content">

        <form action="{{ route('file.download', $file->identifier) }}" method="get">
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
                        <a href="" class="preview">Preview</a>
                    </div>
                    <small class="size">{{ $file->size }}MB</small>
                </div>
            </div>
            <hr>

            <div class="button" style="width: fit-content; margin-left:auto;margin-right:auto;">
                <button type="submit" class="active" style="margin-left: 0px;">Download</button>
            </div>
        </form>
    </div>


</body>

</html>
