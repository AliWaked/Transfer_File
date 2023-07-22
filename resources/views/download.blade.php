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
    {{-- <style>
        .information {
            padding: 5px 15px;
            border-bottom: #666 solid 1px;
            width: calc(100% - 30px);
            margin: 0 auto;
            position: relative;
        }

        .information span {
            font-size: 12px;
            color: #666;
        }

        .information .name {
            font-size: 14px;
            color: #444;
            display: block;
            text-wrap: nowrap;
        }

        .information i {
            position: absolute;
            left: 250px;
            top: 18px;
            color: #5268ff;
            cursor: pointer;
        }

        .information i:hover {
            color: #253eed;
        }

        .add-files-folders {
            color: #5268ff;
            position: relative;
            padding: 8px 0px 0px 26px;
        }

        .add-files-folders label {
            font-size: 14px;
            font-weight: 500;
        }

        .add-files-folders label i {
            color: #fff;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #5268ff;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-size: 10px;
            margin-right: 5px;
        }

        .add-files-folders:hover label {
            color: #253eed;
        }

        .add-files-folders:hover label i {
            background-color: #253eed;
        }

        .choose-type {
            color: #333;
            position: absolute;
            /* padding: 13px 20px; */
            left: 10px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: -1px 5px 8px #66666640;
            overflow: hidden;
            top: 4%;
            z-index: 20;
        }

        .choose-type ul {
            list-style: none;
        }

        .choose-type ul li label {
            cursor: pointer;
            color: #333333;
            transition: 0.3s;
            font-weight: 400;
            opacity: 1;
            font-size: 16px;
            display: inline-block;
            width: 100%;
            padding: 10px 25px;
        }

        .choose-type ul li label:hover {
            color: #fff;
            background-color: #253eed;
        }
    </style> --}}
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

        <form action="{{ route('file.download',$file->identifier) }}" method="get" >
            <div class="download" id="header">
                <i class="fa-solid fa-arrow-down"></i>
                <h3>Ready when you are</h3>
                <span>Transfer expires in 7 days</span>
                <p class="title">{{$file->title}}   </p>
                {{-- <div id="file-container">
                </div>
                <div class="add-files-folders hidden" id="add-files-folders">
                    <label for=""><i class="fa-solid fa-plus"></i> Add more files</label>
                    <div class="choose-type hidden" id="choose-type">
                        <ul>
                            <li><label for="file">Files</label></li>
                            <li><label for="folder">Folders</label></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
            <hr>
            {{-- <p>Up to 2 GB free <a href="">Increase Limit <i class="fa-solid fa-circle-up"></i></a></p> --}}
            <div class="visible" id='link-content'>
                {{-- <x-partials.container /> --}}
                <div class="download-information">
                    <div>
                        <div class="number-of-file">{{count($file->path)}} file</div>
                        <a href="" class="preview">Preview</a>
                    </div>
                    <small class="size">22MB</small>
                </div>
            </div>
            {{-- <div class="hidden" id="email-content">
                <x-partials.input type='email' name='email_to' label='Email to' />
                <x-partials.input type='email' name='your_email' label='Your email' />
                <x-partials.input name='title_email' label='Title' />
                <x-partials.textarea name='message_email' label='Message' />
            </div> --}}
            <hr>
            {{-- <div class="radio-container" id="radio-container">
                <div class="radio">
                    <div><input type="radio" id="email" value="email" name="type">
                        <label for="email">Send email transfer</label>
                    </div>
                    <div>
                        <input type="radio" id="link" value="link" name="type" checked>
                        <label for="link">Get transfer link</label>
                    </div>
                </div>
            </div> --}}
            <div class="button" style="width: fit-content; margin-left:auto;margin-right:auto;">
                {{-- <span id="change-type-send"><i class="fa-solid fa-ellipsis"></i></span> --}}
                <button type="submit" class="active" style="margin-left: 0px;">Download</button>
            </div>
        </form>
    </div>

    {{-- <script>
        window.addEventListener('load', function() {
            inputs = document.querySelectorAll('.form-control input');
            inputs.forEach(e => {
                e.onchange = function() {
                    if (e.value != '') {
                        e.classList.add('focuse')
                    } else e.classList.remove('focuse');
                }
            });
            textarea = document.querySelectorAll('.form-control textarea');
            textarea.forEach(e => {
                e.onchange = function() {
                    if (e.value != '') {
                        e.classList.add('focuse')
                    } else e.classList.remove('focuse');
                }
            });
            document.getElementById('change-type-send').onclick = function() {
                document.getElementById('radio-container').classList.toggle('desable')
            }
            document.getElementById('email').onclick = function() {
                document.getElementById('link-content').classList.add('hidden')
                document.getElementById('link-content').classList.remove('visible')
                document.getElementById('email-content').classList.remove('hidden')
                document.getElementById('email-content').classList.add('visible')
                document.getElementById('radio-container').classList.remove('desable')

            }
            document.getElementById('link').onclick = function() {
                document.getElementById('link-content').classList.remove('hidden')
                document.getElementById('link-content').classList.add('visible')
                document.getElementById('email-content').classList.add('hidden')
                document.getElementById('email-content').classList.remove('visible')
                document.getElementById('radio-container').classList.remove('desable')
            }
            file = document.getElementById('file');
            file.onchange = function() {
                path = this.value;
                parts = path.split('\\');
                filename = parts[parts.length - 1];
                inputTitle = ($input = document.querySelector('.visible input[name="title"]')) == null ?
                    document.querySelector('.visible input[name="title_email"]') : $input;
                if (inputTitle.value == '') {
                    inputTitle.value = filename;
                    inputTitle.classList.add('focuse');
                    document.querySelector('button[type="submit"]').classList.add('active');
                    document.querySelector('button[type="submit"]').classList.remove('desable');
                    removeContent();
                }
                value = this.files;
                displayFileInformation(filename, Math.round((this.files[0].size / 1048576) * 100) / 100, value);
                // const clonedFile = new File([value], value.name, {
                //     type: value.type
                // });

                // Set the cloned file to the destination input
                // $ifle = document.getElementById(`${$number}`)
                // $ifle.files = new DataTransfer().files;
                // $ifle.files = this.files;
                // $ifle.nextElementSibling.textContent = this.files.name;
                // document.getElementById(`${$number}`).files = this.files;
                // $number++;
                // input = document.getElementById(`0`)
                // console.log(input);
                // console.log(filename);
            }
            folder = document.getElementById('folder');
            folder.onchange = function() {
                path = folder.files[0].webkitRelativePath;
                parts = path.split('/');
                filename = parts[0];
                inputTitle = document.querySelector('.visible input[name="title"]');
                if (inputTitle.value == '') {
                    inputTitle.value = filename;
                    inputTitle.classList.add('focuse');
                    document.querySelector('button[type="submit"]').classList.add('active');
                    document.querySelector('button[type="submit"]').classList.remove('desable');
                    removeContent();
                }
                console.log(filename);
            }
        });
        var $number = 0;

        function removeContent() {
            document.getElementById('uploads-icon').style.display = 'none';
            document.getElementById('uploads').style.display = 'none';
            document.getElementById('header').style.display = 'block';
            document.getElementById('header').style.padding = '0px 0px 10px 0px';
            document.getElementById('add-files-folders').classList.remove('hidden');
        }
        document.getElementById('add-files-folders').onclick = function() {
            document.getElementById('choose-type').classList.toggle('hidden');
        }
        var values = [];

        function displayFileInformation(fileName, size, value) {
            parts = fileName.split('.');
            extension = parts[parts.length - 1];
            document.getElementById('file-container').innerHTML += ` <div class="information">
                        <input type='file' value='${value}' name='file[]' id='${$number}' hidden />
                        <span class="name">${fileName}</span>
                        <span>${size} KB - ${extension}</span>
                        <i class="fa-solid fa-xmark"></i>
                    </div>`;
            // document.getElementById(`${$number}`).files = value;
            values[$number] = value;
            setValueToInputFile();
            // r = document.getElementById(`${$number}`).value = value;
            closes = document.getElementsByClassName('fa-xmark');
            for (let i = 0; i < closes.length; i++) {
                closes[i].onclick = function() {
                    this.parentNode.remove();
                }
            }
            $number++;
        }

        function setValueToInputFile() {
            files = document.querySelectorAll('#file-container input[type="file"]');
            // console.log(files[0]);
            for (let i = 0; i < files.length; i++) {
                files[i].files = values[i];
                // console.log(files[0]);
            }
        }
    </script> --}}
</body>

</html>
