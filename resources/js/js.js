window.addEventListener('load',function(){
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
        inputTitle = document.querySelector('.visible input[name="title"]');
        if (inputTitle.value == '') {
            inputTitle.value = filename;
            inputTitle.classList.add('focuse');
            document.querySelector('button[type="submit"]').classList.add('active');
            document.querySelector('button[type="submit"]').classList.remove('desable');
        }
        console.log(filename);
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
        }
        console.log(filename);
    }
    });