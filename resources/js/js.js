window.addEventListener('load', function() {

    var formData = new FormData();
    var dataFileAndFolder = [];
    var valueInputTitle = '';
    var titles = [];
    var typeOfSend = 'link';
    let typeFromStorage = window.localStorage.getItem('type');
    let craeteAccount = window.sessionStorage.getItem('createAccount');
    let typeOfJoin = window.sessionStorage.getItem('typeOfJoin');
    let linkContent = document.getElementById('link-content');
    let emailocntent = document.getElementById('email-content');
    let radioContrainer = document.getElementById('radio-container');
    let sendData = document.getElementById('upload_data');
    let titleInput = document.querySelector('input[name="title"]');
    let emailInput = document.querySelector('input[name="your_email"]');
    let emailToInput = document.querySelector('input[name="email_to"]');
    let inputs = document.querySelectorAll('.form-control input');
    let textarea = document.querySelectorAll('.form-control textarea');
    let ChangeTypeOfSend = document.getElementById('change-type-send');
    let emailRadio = document.getElementById('email');
    let linkRadio = document.getElementById('link');
    let fileInput = document.getElementById('file');
    let folderInput = document.getElementById('folder');
    let iconUploadFile = document.getElementById('uploads-icon');
    let upolads = document.getElementById('uploads');
    let header = document.getElementById('header');
    let addFilesAndFolders = document.getElementById('add-files-folders');
    let containerRadioChooseType = document.getElementById('choose-type');
    let containerUploadedFile = document.getElementById('file-container');
    let closes = document.getElementsByClassName('fa-xmark');
    let sendDataSection = document.querySelector('section.send-data');
    let message = document.getElementById('message');
    let container = document.querySelector('div.container');
    let tip = document.getElementById('tip');
    let invalidEmail = this.document.getElementById('invalid-email');
    let login = document.getElementById('login');
    let createAccount = document.getElementById('create-account');
    let formLogin = document.getElementById('form-login');
    let formForgot = document.getElementById('form-forgot');
    let linkForgot = document.getElementById('forgot_link');
    let hiddenForgot = document.getElementById('back-from-forgot');
    let continueWith = document.getElementById('continue_with');
    let formCreateAccount = document.getElementById('form-create-account');
    let closeAccountSide = document.getElementById('close-account-side');
    let joinUs = document.getElementById('join_us');
    let openLoginPage = document.getElementById("login-page");
    let openRegissterPage = document.getElementById("sing-up-page");

    // let buttonCopyLink = document.getElementById('link-copy');
    // let link = document.getElementById('download-link');

    // add class focuse to input
    inputs.forEach(e => {
        e.onchange = function() {
            if (e.name == 'title') {
                valueInputTitle = this.value;
                if (this.value == '') {
                    updateTitle();
                }
            }
            if ((this.name == 'your_email') || (this.name == 'email_to')) {
            let top = this.name == 'email_to'? 128:177;
                validationEmail(top,this.name);
            }
            FocuseInput(e)
        }
        FocuseInput(e)
    });

    textarea.forEach(e => {
        e.onchange = function() {
            FocuseInput(e)
        }
        FocuseInput(e)
    });
    emailInput.onclick = function () {
    if(tip.children.length == 0 && !isAuth){
        tip.innerHTML += 
        `
        <div class="tip-create-account" id='tip-create-account'>
            <p 
                class="first">Pop in your email an dwe'll let you know when your files get downloaded.
            </p>
            <p>
                You'll need to verify your email so we know it's really you. Don't want to verify every
                time?
            </p>
            <a id='create_free_account'>
                Create free account
            </a>
        </div>
        `;
        showJoinSide();
        setTimeout(function () {
            document.getElementById('tip-create-account').remove();
        }, 7000);
    } 
    }
    if(isAuth){
        window.sessionStorage.removeItem('createAccount');
    }
    // add new file
    fileInput.onchange = function() {
        let path = this.value;
        let parts = path.split('\\');
        let filename = parts[parts.length - 1];
        if (titles.includes(filename)) {
            return;
        }
        title(filename);
        dataFileAndFolder.push(['file[]', this.files[0], filename]);
        displayFileInformation(filename, this.files[0].size);
        this.value = '';
    }

    // add new folder
    folderInput.onchange = function(e) {
        let path = this.files[0].webkitRelativePath;
        let parts = path.split('/');
        let folderName = parts[0];
        if (titles.includes(folderName)) {
            return;
        }
        title(folderName);
        compressFolder(folderName, this.files);
        displayFolderInformation(folderName, this.files.length);
        this.value = '';
    }

    // change from link to email
    emailRadio.onclick = function() {
        dispalyEmailFront();
        window.localStorage.setItem('type','email');
        checked();
    }
    
    // change from email to link
    linkRadio.onclick = function() {
        dispalyLinkFront();
        window.localStorage.setItem('type','link');
        checked();
    }
    
    function dispalyLinkFront() {
        emailocntent.classList.add('hidden');
        emailocntent.classList.remove('visible');
        radioContrainer.classList.remove('desable');
        sendData.innerHTML = 'Get a link';
        typeOfSend = 'link';
    }
    
    function dispalyEmailFront() {
        emailocntent.classList.remove('hidden');
        emailocntent.classList.add('visible');
        radioContrainer.classList.remove('desable');
        sendData.innerHTML = 'Transfer';
        typeOfSend = 'email';
    }
    
    if(typeFromStorage !== null) {
        if(typeFromStorage == 'email') {
            dispalyEmailFront();
            emailRadio.checked = true;
        }else {
            dispalyLinkFront();
            linkRadio.checked = true;
        }
        
    }
    
    if(craeteAccount !==null) {
        joinUs.style.transition = 'none';
        joinUs.style.left = '0';
        if(typeOfJoin == 'login'){
            formLogin.classList.remove('hidden');
            formCreateAccount.classList.add('hidden');
            login.classList.add('active');
            createAccount.classList.remove('active');
        }
        if(typeOfJoin == 'forgot'){
            formCreateAccount.classList.add('hidden');
            formForgot.classList.remove('hidden');
            continueWith.style.display = 'none';
            createAccount.classList.remove('active');
        }
    }

    addFilesAndFolders.onclick = function() {
        containerRadioChooseType.classList.toggle('hidden');
    }

    ChangeTypeOfSend.onclick = function() {
        radioContrainer.classList.toggle('desable')
    }

    // send data and display link
    sendData.onclick = async function upoladsDate() {
        formData.append('_token', csrf_token);
        formData.append('title', titleInput.value);
        formData.append('message', message.value);
        for (let i = 0; i < dataFileAndFolder.length; i++) {
            let element = dataFileAndFolder[i];
            formData.append(element[0], element[1], element[2]);
        }
        await fetch(`/uploads`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData
        }).then(function(response) {
            return response.json();
        }).then(reslut => {
            if (reslut.code == 1) {
                sendDataSection.remove();
                container.innerHTML =
                    `
                        <section class="success">
                            <img src="assets/image/link-two.svg" alt='image' />
                            <h3>
                                You're done!
                            </h3>
                            <p>
                                Copy your download link or 
                                <a>
                                    see what's inside
                                </a>
                            </p>
                            <div class="download-link">
                                <div id="download-link">
                                    <span>
                                        ${reslut.link}
                                    </span>
                                </div>
                                <hr>
                                <button type="button" id="link-copy">
                                    Copy Link
                                </button>
                            </div>
                        </section>
                    `;
            }
            copyLink();
        });
    }
    
    login.onclick = function() {
        formLogin.classList.remove('hidden');
        formCreateAccount.classList.add('hidden');
        this.classList.add('active');
        createAccount.classList.remove('active');
        window.sessionStorage.setItem('typeOfJoin','login');
    }
    
    createAccount.onclick = function() {
        formLogin.classList.add('hidden');
        formCreateAccount.classList.remove('hidden');
        this.classList.add('active');
        login.classList.remove('active');
        window.sessionStorage.setItem('typeOfJoin','register');
    }
    
    closeAccountSide.onclick = function() {
        joinUs.style.transitionProperty = 'all';
        joinUs.style.transitionDuration = '0.2s';
        joinUs.style.left = '100%';
        window.sessionStorage.removeItem('createAccount');
    }
    
    function showJoinSide() {
        document.getElementById('create_free_account').onclick = function () {
            joinUs.style.left = '0';
            formLogin.classList.add('hidden');
            formCreateAccount.classList.remove('hidden');
            login.classList.remove('active');
            createAccount.classList.add('active');
            window.sessionStorage.setItem('createAccount',true);
        }
    }
    
    openLoginPage.onclick = function () {
        joinUs.style.left = '0';
        formLogin.classList.remove('hidden');
        formCreateAccount.classList.add('hidden');
        login.classList.add('active');
        createAccount.classList.remove('active');
        window.sessionStorage.setItem('createAccount',true);
    }
    
    openRegissterPage.onclick = function () {
        joinUs.style.left = '0';
        formLogin.classList.add('hidden');
        formCreateAccount.classList.remove('hidden');
        login.classList.remove('active');
        createAccount.classList.add('active');
        window.sessionStorage.setItem('createAccount',true);
    }
    
    linkForgot.onclick = function() {
        formLogin.classList.add('hidden');
        formForgot.classList.remove('hidden');
        continueWith.style.display = 'none';
        window.sessionStorage.setItem('typeOfJoin','forgot');
    }
    
    hiddenForgot.onclick = function() {
        formLogin.classList.remove('hidden');
        formForgot.classList.add('hidden');
        continueWith.style.display = 'block';
        login.classList.add('active');
        window.sessionStorage.setItem('typeOfJoin','login');
    }
    
    // compress folder
    async function compressFolder(dirName, files) {
        const zip = new JSZip();
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const relativePath = file.webkitRelativePath;
            zip.file(relativePath, file);
        }
        try {
            const compressedFolder = await zip.generateAsync({
                type: "blob"
            });
            dataFileAndFolder.push(['folder[]', compressedFolder, `${dirName}.zip`]);
        } catch (error) {
            console.error('Error compressing folder:', error);
        }
    }

    // add title value to array valueInputTitle
    function title(name) {
        titles.push(name);
        if (iconUploadFile.style.display != 'none') {
            removeContent();
        }
        if (titleInput.value == '') {
            updateTitle();
        }
        checked();
        // (new Date).getTime()
    }
    

    // add focuse class to input
    function FocuseInput(input) {
        if (input.value != '') {
            input.classList.add('focuse')
        } else input.classList.remove('focuse');
    }

    // remove header content
    function removeContent() {
        iconUploadFile.style.display = 'none';
        upolads.style.display = 'none';
        header.style.display = 'block';
        header.style.padding = '0px 0px 10px 0px';
        addFilesAndFolders.classList.remove('hidden');
    }

    // dispaly header content
    function displayContent() {
        if (containerUploadedFile.children.length == 0) {
            iconUploadFile.style.display = 'flex';
            upolads.style.display = 'block';
            header.style.display = 'flex';
            header.style.padding = '50px 30px';
            addFilesAndFolders.classList.add('hidden');
            sendData.classList.remove('active');
            sendData.classList.add('desable');
        }
    }

    // file information in header
    function displayFileInformation(fileName, size) {
        let parts = fileName.split('.');
        let extension = parts[parts.length - 1];
        let fileSize = Math.round((size / 1048576) * 100) / 100;
        let type = 'MB';
        if (fileSize == 0) {
            fileSize = Math.round((size / 1024) * 100) / 100;
            type = 'KB';
        }
        containerUploadedFile.innerHTML +=
            ` 
                <div class="information">
                    <span class="name">
                        ${fileName}
                    </span>
                    <span>
                        ${fileSize} ${type} - ${extension}
                    </span>
                    <i class="fa-solid fa-xmark"></i>
                </div>
            `;
        removeFileOrFolder();
    }

    // folder information in header
    function displayFolderInformation(FolderName, numberOfItems) {
        containerUploadedFile.innerHTML +=
            ` 
                <div class="information">
                    <span class="name">
                        ${FolderName}
                    </span>
                    <span>
                        <i class="fa-solid fa-folder"></i>  
                        Folder - ${numberOfItems} items
                    </span>
                    <i class="fa-solid fa-xmark"></i>
                </div>
            `;
        removeFileOrFolder();
    }

    // remove upload file or folder
    function removeFileOrFolder() {
        for (let i = 0; i < closes.length; i++) {
            closes[i].onclick = function() {
                let value = dataFileAndFolder[i];
                dataFileAndFolder = dataFileAndFolder.filter(element => element !== value);
                value = titles[i];
                titles = titles.filter(element => element !== value);
                console.log(titles, dataFileAndFolder);
                if ((i == 0) && (valueInputTitle == '')) {
                    updateTitle();
                }
                this.parentNode.remove();
                removeFileOrFolder();
                displayContent();
            }
        }
    }

    // update title value
    function updateTitle() {
        let inputTitle = titleInput;
        if (titles[0] == undefined) {
            // console.log('bla bla bal');
            inputTitle.value = '';
            sendData.classList.remove('active');
            sendData.classList.add('desable');
            inputTitle.classList.remove('focuse');
            fileInput.value = '';
            folderInput.value = '';
        } else {
            // console.log('him')
            if (inputTitle.value == '') {
                inputTitle.classList.add('focuse');
            }
            inputTitle.value = titles[0];
        }
    }

    function checked() {
        console.log(typeOfSend);
        if (typeOfSend == 'link') {
            console.log('hi', titleInput.value == '');
            if ((titleInput.value != '')) { // && sendData.classList.contains('desable')
                sendData.classList.remove('desable');
                sendData.classList.add('active');
            } else if (titleInput.value == '') {
                // not importent
                sendData.classList.add('desable');
                sendData.classList.remove('active');
            }
            return;
        }
        console.log((titleInput.value != ''), isValidEmail(emailToInput.value), isValidEmail(emailInput
            .value));
        if ((titleInput.value != '') && isValidEmail(emailToInput.value) && isValidEmail(emailInput
            .value)) {
            sendData.classList.remove('desable');
            sendData.classList.add('active');
            return true;
        } else {
            sendData.classList.add('desable');
            sendData.classList.remove('active');
            return false;
        }
    }
    
    function validationEmail(top,name) {
        if(!checked() && (invalidEmail.children.length == 0)) {
            invalidEmail.innerHTML= 
                `
                <div class="invalid" id='${name}_invalid' style='top:${top}px'>
                    <i class="fa-solid fa-exclamation"></i>
                    <h3>
                        Whopps!
                    </h3>
                    <p>
                        It looks like one of the email addresses you enterect is incorrect
                    </p>
                </div>
                `;
            setTimeout(function(){
                invalidEmail.innerHTML = '';
            },7000);
        }
    }

    // copy link
    function copyLink() {
        document.getElementById('link-copy').addEventListener('click', function() {
            console.log('hi');
            var link = document.getElementById('download-link');
            const range = document.createRange();
            range.selectNode(link);
            const selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            const successful = document.execCommand('copy');
        });
    }


    function isValidEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
    // function setValueToInputFile() {
    //     files = document.querySelectorAll('#file-container input[type="file"]');
    //     for (let i = 0; i < files.length; i++) {
    //         files[i].files = values[i];
    //     }
    // }
})