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
</head>

<body>
    @if (session()->has('link'))
        <div class="download-link">
            <div id="download-link">
                {{ Session::get('link') }}
                {{-- ?? 'http://localhost/files/69AoaGbBLDVOfIDv6rPXoalobcrhzZy7ohoIrHUK1689998909' --}}
            </div>
            <button type="button" id="link-copy">copy</button>
        </div>
    @endif
    <div class="content">
        <form action="{{ route('file.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="header" id="header">
                <label for="file" class="icon" id="uploads-icon"><i class="fa-solid fa-plus"></i></label>
                <div class="title" id="uploads">
                    <label for="file">Upload files</label>
                    <input type="file" id="file" hidden>
                    <label for="folder">or select a folder</label>
                    <input type="file" id="folder" hidden webkitdirectory>
                </div>

                <div id="file-container">
                </div>
                <div class="add-files-folders hidden" id="add-files-folders">
                    <label for=""><i class="fa-solid fa-plus"></i> Add more files</label>
                    <div class="choose-type hidden" id="choose-type">
                        <ul>
                            <li><label for="file">Files</label></li>
                            <li><label for="folder">Folders</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <p>Up to 2 GB free <a href="">Increase Limit <i class="fa-solid fa-circle-up"></i></a></p>
            <div class="visible" id='link-content'>
                <x-partials.container />
            </div>
            <div class="hidden" id="email-content">
                {{-- <x-partials.container> --}}
                <x-partials.input type='email' name='email_to' label='Email to' />
                <x-partials.input type='email' name='your_email' label='Your email' />
                <x-partials.input name='title_email' label='Title' />
                <x-partials.textarea name='message_email' label='Message' />
                {{-- </x-partials.container> --}}
            </div>
            <hr>
            <div class="radio-container" id="radio-container">
                <div class="radio">
                    <div><input type="radio" id="email" value="email" name="type">
                        <label for="email">Send email transfer</label>
                    </div>
                    <div>
                        <input type="radio" id="link" value="link" name="type" checked>
                        <label for="link">Get transfer link</label>
                    </div>
                </div>
            </div>
            <div class="button">
                <span id="change-type-send"><i class="fa-solid fa-ellipsis"></i></span>
                <button type="submit" class="desable">Get a link</button>
            </div>
        </form>
    </div>

    <script>
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
        // dispaly content
        function displayContent() {
            if (document.getElementById('file-container').children.length == 0) {
                document.getElementById('uploads-icon').style.display = 'flex';
                document.getElementById('uploads').style.display = 'block';
                document.getElementById('header').style.display = 'flex';
                document.getElementById('header').style.padding = '50px 30px';
                document.getElementById('add-files-folders').classList.add('hidden');
            }
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
                        <span>${size} MB - ${extension}</span>
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
                    displayContent();
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


        document.getElementById('link-copy').addEventListener('click', function() {
            var link = document.getElementById('download-link');
            const range = document.createRange();
            range.selectNode(link);
            const selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            const successful = document.execCommand('copy');

        });
    </script>
</body>

</html>
