<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transfer data</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/js.js'])
    <style>

    </style>
</head>

<body>
    <div class="container">
        <section class="send-data">
            <div class="header" id="header">
                <label for="file" class="icon" id="uploads-icon"><i class="fa-solid fa-plus"></i></label>
                <div class="title" id="uploads">
                    <label for="file">Upload files</label>
                    <input type="file" id="file" hidden>
                    <label for="folder">or select a folder</label>
                    <input type="file" id="folder" webkitdirectory hidden>
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
                <div class="hidden" id="email-content">
                    <div id="contact_email_to"></div>
                    <x-partials.input type='email' name='email_to' label='Email to'>

                    </x-partials.input>
                    <x-partials.input type='email' name='your_email' value="{{ Auth::user()?->email }}"
                        label='Your email' />
                </div>
                <x-partials.input name='title' label='Title' />
                <x-partials.textarea name='message' label='Message' />
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
                <button type="button" id="upload_data" class="desable">Get a link</button>
            </div>
        </section>
    </div>
    <div id="tip"></div>
    <div class="invalid-email" id="invalid-email"></div>
    @guest
        <section class="join_us" id="join_us">
            <div class="left">
                <img src="{{ asset('assets/image/joinUs.svg') }}" alt="">
                <i class="fa-regular fa-circle-xmark" id="close-account-side"></i>
            </div>
            <div class="right">
                <div>
                    <div class="continue" id="continue_with">
                        <ul class="join-type">
                            <li id="login">Login</li>
                            <li class="active" id="create-account">Create account</li>
                        </ul>
                        <div class="continue-with">
                            <a href="{{ route('socialite.redirect', 'google') }}" class="google">
                                <span><img src="{{ asset('assets/image/google.svg') }}" alt=""></span>Continue with
                                Google
                            </a>
                            <a href="{{ route('socialite.redirect', 'github') }}" class="github"><span><img
                                        src="{{ asset('assets/image/github.svg') }}" alt=""></span>Continue with
                                github</a>
                            <a href="{{ route('socialite.redirect', 'slack') }}" class="slack"><span><img
                                        src="{{ asset('assets/image/slack.svg') }}" alt=""></span>Continue with
                                Slack</a>
                        </div>
                        <span>
                            <span>Or better yet...</span>
                        </span>
                    </div>
                    <form action="register" method="post" class="register" id="form-create-account">
                        @csrf

                        <x-input-form type='email' name='email' placeholder="Email" icon='fa-solid fa-envelope'
                            required />

                        <x-input-form type='text' name='name' placeholder="First Name"
                            icon='fa-solid fa-circle-user' required />

                        <x-input-form type='text' name='surname' placeholder="Surname (optional)"
                            icon='fa-solid fa-address-card' />

                        <x-input-form type='password' name='password' placeholder="Password" icon='fa-solid fa-key'
                            required />

                        <p>
                            By creating an account, you agree to our <a href="">Terms of Service</a> and <a
                                href="">Privacy & Cookie Statement.</a>
                        </p>

                        <button type="submit">Create WeTranser account</button>

                    </form>
                    <form action="login" method="post" class="register hidden" id="form-login">
                        @csrf

                        <x-input-form type='email' name='email' placeholder="Email" icon='fa-solid fa-envelope'
                            required />

                        <x-input-form type='password' name='password' placeholder="Password" icon='fa-solid fa-key'
                            required />

                        <p style="margin:15px;">
                            <a id="forgot_link" style="cursor: pointer;">Forgot password?</a>
                        </p>

                        <button type="submit">Login in with WeTransfer</button>
                    </form>

                    <form action="forgot-password" method="post" class="register forgot hidden" id="form-forgot">
                        @csrf
                        <span>
                            <span><i class="fa-solid fa-arrow-left" id="back-from-forgot"></i> Reset Your Password</span>
                            We'll send you instructions to reset your password and get you back track.
                        </span>
                        <h3
                            style="    font-size: 14px;
                    color: rgb(0 128 0 / 65%);
                    font-weight: normal;
                    margin-bottom: 8px;">
                            {{ Session::get('status') }}</h3>
                        <x-input-form type='email' name='email' placeholder="Email" icon='fa-solid fa-envelope'
                            required />

                        <button type="submit" style="width: 100%">Email me</button>
                    </form>
                </div>
            </div>
        </section>
    @endguest
    <nav class="links">
        @guest
            <ul>
                <li id="login-page">Login</li>
                <li id="sing-up-page">Sing up</li>
            </ul>
        @endguest
        @auth
            <ul>
                <li onclick="document.querySelector('aside.transfers').classList.add('view')">Transfers</li>
                <li onclick="document.querySelector('aside[class=contacts]').classList.add('view')">Contacts</li>
            </ul>
            <div class="account">
                <span id="workspace">ali's workspace
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('assets/image/google.svg') }}" alt="">
                    @else
                        <span class="avatar-default">
                            AW
                        </span>
                    @endif
                </span>
                <ul class="remove">
                    <li>{{ auth()->user()->email }}</li>
                    <li><a href="">Account</a></li>
                    <hr>
                    <li>
                        <form action="logout" method="post">
                            @csrf
                            <button type="submit">Log out</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </nav>
    @auth
        <aside class="contacts">
            <div>
                <i class="fa-regular fa-circle-xmark close"
                    onclick="this.parentNode.parentNode.classList.remove('view')"></i>
            </div>
            <hr>
            <div class="contents">
                <div class="header">
                    <div class="left">
                        <h3>Contacts</h3>
                        <div>contact<sup>.</sup><span
                                onclick="document.getElementById('add-contact').classList.remove('hidden')">Add
                                contact</span></div>
                    </div>
                    <div class="right">
                        <x-input-form type='search' name='filer_my_contacts'
                            placeholder="search for email, name, company" icon='fa-solid fa-magnifying-glass' />
                    </div>
                </div>
                <div class="add-contact hidden" id="add-contact">
                    <input type="email" name="email_address" placeholder="Email address">
                    <input type="text" name="name" placeholder="Name">
                    <input type="text" name="company" placeholder="Company">
                    <div>
                        <i class="fa-regular fa-circle-check true" id="add-new-contact"></i>
                        <i class="fa-regular fa-circle-xmark false"
                            onclick="this.parentNode.parentNode.classList.add('hidden')"></i>
                    </div>
                </div>
                <div class="contact" id="my-contacts-container" style="overflow-y: auto;max-height: 368px;">
                    {{-- <div>
                        <span>W</span>
                        <hr>
                        <div class="checkboxies"
                            style="display:flex;align-items:center; column-gap:15px; margin-bottom: 0px;">
                            <div class="checkbox" style="margin: 0; margin-left:12px; display:none;">
                                <input type="checkbox" name="name" id="hii"
                                    style="width:25px;color:blue; accent-color: #7777e2d4;border-color:#7777e2d4;">
                            </div>
                            <label for="hii" id="hii" style="flex: 1; cursor:default; pointer-events: none;">
                                <span>
                                    <div class="name" style="margin-bottom: 0px;">waked@gmail.com</div>
                                    <span>ali<sup>.</sup>hi my name sial</span>
                                </span>

                                <ul class="contact-options">
                                    <li class="edit edit-contact">Edit</li>
                                    <li class="delete delete-contact">Delete</li>
                                    <li class="add add-contact-to-email">Add to transfer</li>
                                </ul>
                            </label>
                        </div>
                        <div class="checkboxies"
                            style="display:flex;align-items:center; column-gap:15px; margin-bottom: 0px;">
                            <div class="checkbox" style="margin: 0; margin-left:12px; display:none;">
                                <input type="checkbox" name="name" id="hiii"
                                    style="width:25px;color:blue; accent-color: #7777e2d4;border-color:#7777e2d4;">
                            </div>
                            <label for="hiii" id="hiii" style="flex: 1; cursor:default; pointer-events: none;">
                                <span>
                                    <div class="name" style="margin-bottom: 0px;">ali@gmail.com</div>
                                    <span>waked<sup>.</sup>😂😂😂😂</span>
                                </span>

                                <ul class="contact-options">
                                    <li class="edit edit-contact">Edit</li>
                                    <li class="delete delete-contact">Delete</li>
                                    <li class="add add-contact-to-email">Add to transfer</li>
                                </ul>
                            </label>
                        </div>
                        <div class="checkboxies" style="display:flex;align-items:center; column-gap:15px; ">
                            <div class="checkbox" style="margin: 0; margin-left:12px; display:none;">
                                <input type="checkbox" name="name" id="hi"
                                    style="width:25px;color:blue; accent-color: #7777e2d4;border-color:#7777e2d4;">
                            </div>
                            <label for="hi" id="hi" style="flex: 1; cursor:default; pointer-events: none;">
                                <span>
                                    <div class="name" style="margin-bottom: 0px;">ahmed@gmail.com</div>
                                    <span>hi<sup>.</sup>hexa</span>
                                </span>

                                <ul class="contact-options">
                                    <li class="edit edit-contact">Edit</li>
                                    <li class="delete delete-contact">Delete</li>
                                    <li class="add add-contact-to-email">Add to transfer</li>
                                </ul>
                            </label>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div style="position: relative;">
                <div class="deleted-contact-details" id="deleted-contact-details">
                    <div class="left">
                        <div class="number-of-contact-selected" id="number-of-contact-has-been-selected">
                            <span>3</span>contact
                        </div>
                        <span class="selected-all-contact selected-all">selected all</span>
                    </div>
                    <div class="right">
                        <span class="delete">Delete</span>
                        <span class="cancel" id="remove-deleted-contact">Cancel</span>
                    </div>
                </div>
            </div>
        </aside>
        <aside class="transfers">
            <div>
                <i class="fa-regular fa-circle-xmark close"
                    onclick="this.parentNode.parentNode.classList.remove('view')"></i>
            </div>
            <hr>
            <div class="auth-information">
                <div>
                    <span>
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('assets/image/google.svg') }}" alt="">
                        @else
                            <span class="avatar-default">
                                AW
                            </span>
                        @endif
                    </span>
                    <i class="fa-solid fa-user-plus"></i>
                </div>
            </div>
            <div class="contents">
                <div class="header">
                    <div class="left">
                        <h4>ali's workspace</h4>
                        <h3>Transfers</h3>
                    </div>
                    <div class="right">
                        <x-input-form type='search' name='filter_my_files' placeholder="search for title, name, email"
                            icon='fa-solid fa-magnifying-glass' />
                    </div>
                </div>
                <div class="show-type">
                    <div class="first">
                        <span class="send active" data-type="send">
                            Send
                        </span>
                        <span class="received" data-type='received'>
                            Received
                        </span>
                    </div>
                    <div class="second">
                        <span>Sort by:</span>
                        <span class="stor-by">
                            <span class="type-of-show-transfer"
                                onclick="document.getElementById('sorting-transfer-by').classList.toggle('remove')">
                                Date
                            </span>
                            <span class="icons" id="change-type-of-sorting">
                                <i class="fa-solid fa-arrow-up active" data-sort='desc'></i>
                                <i class="fa-solid fa-arrow-down" data-sort='asc'></i>
                            </span>
                        </span>
                        <ul id="sorting-transfer-by" class="remove">
                            <li class="active">Date</li>
                            <li>Size</li>
                            <li>Sender</li>
                            <li>Expiration date</li>
                        </ul>
                    </div>
                </div>
                <hr style="margin-top: 9px;">
                <div class="trnasfers-send">
                    <ul id="my-files">
                        {{-- @dd($files) --}}
                        {{-- @foreach ($files as $date => $values)
                            <li> <span>{{ $date }}</span>
                                <ul class="show-transfers">
                                    @foreach ($values as $file)
                                        <li>
                                            <h5>{{ $file->title }}</h5>
                                            <ul>
                                                <li><sup></sup>{{ $count = $file->count ? $count . ' downloads' : 'Not yet downloaded' }}
                                                </li>
                                                <li><sup>.</sup>1 file</li>
                                                <li><sup>.</sup>{{ $file->total_size }}</li>
                                                <li><sup>.</sup>Sent {{ $file->created_at->diffForHumans() }}</li>
                                            </ul>
                                            <ul class="ul-second">
                                                <li><sup></sup><a
                                                        href="{{ route('download', $file->identifier) }}">Download</a>
                                                </li>
                                                <li data-link="{{ $file->file_link }}" class="my-file-link">
                                                    <sup>.</sup>Copy link
                                                </li>
                                                <li><sup>.</sup>Forward</li>
                                                <li><sup>.</sup>Edit title</li>
                                                <li><sup>.</sup>Delete</li>
                                            </ul>
                                            <svg class="arrow-icon--right transferitem__arrow" viewBox="-1 14 9 12">
                                                <path stroke="#babcbf" stroke-width="2" d="M5 15l-5 5 5 5"
                                                    fill="none" fill-rule="evenodd" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach --}}

                        {{-- <li> <span>August 2023</span>
                            <ul class="show-transfers">
                                <li>
                                    <h5>migration.text</h5>
                                    <ul>
                                        <li><sup></sup>Not yet downloaded</li>
                                        <li><sup>.</sup>1 file</li>
                                        <li><sup>.</sup>76.8 KB</li>
                                        <li><sup>.</sup>Sent 3 minutes ago</li>
                                    </ul>
                                    <ul class="ul-second">
                                        <li><sup></sup><a href="">Download</a></li>
                                        <li><sup>.</sup>Copy link</li>
                                        <li><sup>.</sup>Forward</li>
                                        <li><sup>.</sup>Edit title</li>
                                        <li><sup>.</sup>Delete</li>
                                    </ul>
                                    <svg class="arrow-icon--right transferitem__arrow" viewBox="-1 14 9 12">
                                        <path stroke="#babcbf" stroke-width="2" d="M5 15l-5 5 5 5" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </li>
                            </ul>
                            <ul class="show-transfers">
                                <li>
                                    <h5>migration.text</h5>
                                    <ul>
                                        <li><sup></sup>Not yet downloaded</li>
                                        <li><sup>.</sup>1 file</li>
                                        <li><sup>.</sup>76.8 KB</li>
                                        <li><sup>.</sup>Sent 3 minutes ago</li>
                                    </ul>
                                    <ul class="ul-second">
                                        <li><sup></sup><a href="">Download</a></li>
                                        <li><sup>.</sup>Copy link</li>
                                        <li><sup>.</sup>Forward</li>
                                        <li><sup>.</sup>Edit title</li>
                                        <li><sup>.</sup>Delete</li>
                                    </ul>
                                    <svg class="arrow-icon--right transferitem__arrow" viewBox="-1 14 9 12">
                                        <path stroke="#babcbf" stroke-width="2" d="M5 15l-5 5 5 5" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </li>
                            </ul>
                            <ul class="show-transfers">
                                <li>
                                    <h5>migration.text</h5>
                                    <ul>
                                        <li><sup></sup>Not yet downloaded</li>
                                        <li><sup>.</sup>1 file</li>
                                        <li><sup>.</sup>76.8 KB</li>
                                        <li><sup>.</sup>Sent 3 minutes ago</li>
                                    </ul>
                                    <ul class="ul-second">
                                        <li><sup></sup><a href="">Download</a></li>
                                        <li><sup>.</sup>Copy link</li>
                                        <li><sup>.</sup>Forward</li>
                                        <li><sup>.</sup>Edit title</li>
                                        <li><sup>.</sup>Delete</li>
                                    </ul>
                                    <svg class="arrow-icon--right transferitem__arrow" viewBox="-1 14 9 12">
                                        <path stroke="#babcbf" stroke-width="2" d="M5 15l-5 5 5 5" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </li>
                            </ul>
                        </li> --}}
                    </ul>

                </div>
            </div>
        </aside>
    @endauth
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <script>
        const csrf_token = "{{ csrf_token() }}";
        const isAuth = "{{ auth()->check() }}";
        let workspace = document.getElementById('workspace');
        let workspaceOption = document.querySelector('#workspace + ul');
        var indexOfCheckBoxHasBeenSelected;
        workspace.onclick = function() {
            workspaceOption.classList.toggle('remove');
        }


        document.getElementById('add-new-contact').onclick = async function() {
            $data = new FormData();
            const contact_email = document.querySelector('.add-contact input[name="email_address"]');
            const contact_name = document.querySelector('.add-contact input[name="name"]');
            const contact_company = document.querySelector('.add-contact input[name="company"]');
            $data.append('_token', csrf_token);
            $data.append('email', contact_email.value);
            $data.append('name', contact_name.value);
            $data.append('company', contact_company.value);
            await fetch(`/my-contact`, {
                    method: 'POST',
                    headers: {
                        accept: 'application/json',
                    },
                    body: $data,
                }).then(response => response.json())
                .then(result => {
                    if (result.code == 201) {
                        console.log(result.name);
                        getMyContacts();
                        document.querySelector('.add-contact').classList.add('hidden');
                        contact_email.value = '';
                        contact_name.value = '';
                        contact_company.value = '';
                    }
                }).catch(error => console.log(error));
        }


        getMyContacts();

        async function getMyContacts(search = '') {
            await fetch(`/my-contact?search=${search}`, {
                    method: 'GET',
                    headers: {
                        'accept': 'application/json',
                    }
                }).then(response => response.json())
                .then(result => {
                    // document.getElementById().innerHTML = '';
                    values = Object.keys(result);
                    console.log(values)
                    let contact_container = document.getElementById('my-contacts-container');
                    contact_container.innerHTML = '';
                    values.forEach(ele => {
                        let values = '';
                        result[ele].forEach((element, index) => {
                            values += `
                                    <div class="checkboxies"
                                    style="display:flex;align-items:center; column-gap:15px; margin-bottom: 0px;">
                                    <div class="checkbox" style="margin: 0; margin-left:12px; display:none;">
                                        <input type="checkbox" name="name" id="${ele + index}"
                                            style="width:25px;color:blue; accent-color: #7777e2d4;border-color:#7777e2d4;">
                                    </div>
                                    <label for="${ele + index}" style="flex: 1; cursor:default; pointer-events: none;">
                                        <span>
                                            <div class="name" style="margin-bottom: 0px;">${element.email}</div>
                                            <span>${element.name} ${element.company != undefined?"<sup>.</sup>"+element.company+"":''} </span>
                                        </span>
        
                                        <ul class="contact-options">
                                            <li class="edit edit-contact" data-contact=${element.id}>Edit</li>
                                            <li class="delete delete-contact">Delete</li>
                                            <li class="add add-contact-to-email">Add to transfer</li>
                                        </ul>
                                    </label>
                                </div>
                            `;
                        });
                        // let span = document.createElement('span').innerHTML = ele;
                        contact_container.innerHTML += `<span>${ele}</span> <hr/> ${values}`;
                    });
                    deleteContacts();
                    editContact();
                    addContactsToEmail();
                    selectedAllContact();

                });
        }
        console.log(document.querySelectorAll('ul.contact-options'));

        function deleteContacts() {
            document.querySelectorAll('li.delete-contact').forEach((element, i) => {
                element.onclick = function() {
                    removeContact();
                    selectedCheckedboxClicked(i);
                }
            });
        }

        // let innerHtmlValue = [];
        function editContact() {
            document.querySelectorAll('li.edit-contact').forEach((element, i) => {
                element.onclick = function() {
                    this.parentNode.parentNode.parentNode.style.display = 'block';
                    let parentNode = this.parentNode.parentNode.children[0];
                    console.log(this.parentNode.parentNode.children[0].children[1].innerText.split('.')[0]);
                    innerHtmlValue = this.parentNode.parentNode.parentNode.innerHTML;
                    this.parentNode.parentNode.parentNode.innerHTML =
                        `
                            <hr style='margin-bottom:8px'>
                            <div class="add-contact" style='top:0;margin-bottom:0;' id="add-contact">
                                <input type="text" class='focus' name="" value="${this.parentNode.parentNode.children[0].children[0].innerHTML}" placeholder="Email address">
                                <input type="text" class='focus' name="" value="${this.parentNode.parentNode.children[0].children[1].innerText.split('.')[0]}" placeholder="Name">
                                <input type="text" class='focus' name="" value="${this.parentNode.parentNode.children[0].children[1].innerText.split('.')[1]??''}" placeholder="Company">
                                <div>
                                    <i class="fa-regular fa-circle-check true" id='fa-circle-update-${i}' data-contact=${this.dataset.contact}></i>
                                    <i class="fa-regular fa-circle-xmark false" id='fa-circle-xmark-remove-edit-${i}'></i>
                                </div>
                            </div>
                            <hr style='margin-top:8px'>
                    `;
                    document.getElementById(`fa-circle-xmark-remove-edit-${i}`).onclick = function() {
                        this.parentNode.parentNode.parentNode.style.display = 'flex';
                        this.parentNode.parentNode.parentNode.innerHTML = innerHtmlValue;
                        editContact();
                        deleteContacts();
                        addContactsToEmail();
                        removeContactsToEmail();
                    }
                    document.getElementById(`fa-circle-update-${i}`).onclick = function() {
                        const contactData = new FormData();
                        contactData.append('_token', csrf_token);
                        
                        fetch(`/my-contact/update/${this.dataset.contact}`, {
                                method: 'PUT',
                                headers: {
                                    'accept': 'application/json',
                                },
                                body: contactData,
                            }).then(response => response.json())
                            .then(result => {
                                if (result.code == '204') {
                                    getMyContacts();
                                }
                            });
                    }
                }
            });
        }

        function addContactsToEmail() {
            document.querySelectorAll('li.add-contact-to-email').forEach((element, index) => {
                element.onclick = function() {
                    document.getElementById('contact_email_to').innerHTML +=
                        `
                            <span><span>${this.parentNode.parentNode.children[0].children[0].innerText}</span><i class="fa-solid fa-xmark remove-contact-using-fa-xmark"></i></span>
                        `;
                    this.innerHTML = 'Remove from transfer';
                    this.classList.remove('add-contact-to-email');
                    this.classList.add('remove-contact-to-email');
                    removeContactsToEmail();
                    removeContactsFromToEmailUsingXmark();
                }
            });
        }

        function removeContactsToEmail() {
            document.querySelectorAll('li.remove-contact-to-email').forEach((element, i) => {
                element.onclick = function() {
                    // console.log([...document.getElementById('contact_email_to').children[0]]);
                    [...document.getElementById('contact_email_to').children].forEach((e) => {
                        if (e.children[0].innerText == this.parentNode.parentNode.children[0].children[
                                0]
                            .innerText) {
                            e.remove();
                        }
                    });
                    this.innerHTML = 'Add to transfer';
                    this.classList.add('add-contact-to-email');
                    this.classList.remove('remove-contact-to-email');
                    addContactsToEmail();
                    removeContactsToEmail();
                }
            });
        }

        function removeContactsFromToEmailUsingXmark() {
            document.querySelectorAll('i.remove-contact-using-fa-xmark').forEach(element => {
                element.onclick = function() {
                    document.querySelectorAll('li.remove-contact-to-email').forEach((ele) => {
                        // console.log(ele.parentNode.parentNode.children[0].children[0].innerText, this
                        //     .parentNode.children[0].innerText)
                        if (ele.parentNode.parentNode.children[0].children[0].innerText ==
                            this.parentNode.children[0].innerText) {
                            ele.innerHTML = 'Add to transfer';
                            ele.classList.add('add-contact-to-email');
                            ele.classList.remove('remove-contact-to-email');
                        }
                    });
                    this.parentNode.remove();
                }
            })
        }


        function removeContact() {
            document.querySelectorAll('ul.contact-options').forEach(element => {
                element.classList.add('remove');
            });
            document.querySelectorAll('.checkboxies').forEach(element => {
                element.classList.add('checkboxies-background');
            });
            document.querySelectorAll('.checkboxies label').forEach(element => {
                element.style.cursor = 'pointer';
                element.style.pointerEvents = 'auto';
            });
            document.querySelectorAll('.checkbox').forEach(element => {
                element.style.display = 'block';
            });
            document.getElementById('deleted-contact-details').classList.add('view');
            displayContact();
        }

        function selectedCheckedboxClicked(i) {
            document.querySelectorAll('aside.contacts .checkboxies-background').forEach(element => {
                element.classList.remove('active');
            })
            document.querySelectorAll('.checkbox input[type=checkbox]').forEach((element, index) => {
                if (i == index && element.checked) {
                    element.checked = false;

                } else {
                    element.checked = false;
                }
            });
            document.querySelectorAll('.checkbox input[type=checkbox]').forEach((element, index) => {
                element.onchange = function() {
                    if (this.checked) {
                        document.querySelectorAll('aside.contacts .checkboxies-background')[index]
                            .classList
                            .add('active');
                    } else {
                        document.querySelectorAll('aside.contacts .checkboxies-background')[index]
                            .classList
                            .remove(
                                'active');
                    }
                    countOfCheckboxedContactHasSelected();
                }
            });
        }

        function displayContact() {
            document.getElementById('remove-deleted-contact').onclick = function() {
                document.querySelectorAll('ul.contact-options').forEach(element => {
                    element.classList.remove('remove');
                });
                document.querySelectorAll('.checkboxies').forEach(element => {
                    element.classList.remove('checkboxies-background');
                });
                document.querySelectorAll('.checkboxies label').forEach(element => {
                    element.style.cursor = 'default';
                    element.style.pointerEvents = 'none';
                });
                document.querySelectorAll('.checkbox').forEach(element => {
                    element.style.display = 'none';
                });
                document.getElementById('deleted-contact-details').classList.remove('view');
            }
        }



        function countOfCheckboxedContactHasSelected() {
            let countContactChecked = 0;
            document.querySelectorAll('.checkbox input[type=checkbox]').forEach(element => {
                if (element.checked) {
                    countContactChecked += 1;
                }
            });
            if (document.querySelectorAll('.checkbox input[type=checkbox]').length == countContactChecked) {
                let selected_all = document.querySelector('.selected-all-contact.selected-all');
                selected_all.innerHTML = 'deselected all';
                selected_all.classList.add('deselected-all');
                selected_all.classList.remove('selected-all');
                deselectedAllContact();
            } else {
                let selected_all = document.querySelector('.selected-all-contact');
                if (selected_all.classList.contains('deselected-all')) {
                    selected_all.innerHTML = 'selected all';
                    selected_all.classList.add('selected-all');
                    selected_all.classList.remove('deselected-all');
                    selectedAllContact();
                }
            }
            insertNumberOfContactHasSelected(countContactChecked)
        }

        function selectedAllContact() {
            document.querySelector('.selected-all-contact.selected-all').onclick = function() {
                let checkboxiesInput = document.querySelectorAll('.checkbox input[type=checkbox]');
                checkboxiesInput.forEach(element => {
                    element.checked = true;
                });
                insertNumberOfContactHasSelected(checkboxiesInput.length);
                this.innerHTML = 'deselected all';
                this.classList.add('deselected-all');
                this.classList.remove('selected-all');
                document.querySelectorAll('aside.contacts .checkboxies-background').forEach(element => {
                    element.classList.add('active');
                })
                deselectedAllContact();
            }
        }

        function insertNumberOfContactHasSelected(countContactChecked) {
            if (countContactChecked <= 1) {
                document.getElementById('number-of-contact-has-been-selected').innerHTML =
                    `
                        <span>${countContactChecked}</span>contact
                    `;
            } else {
                document.getElementById('number-of-contact-has-been-selected').innerHTML =
                    `
                <span>${countContactChecked}</span>contacts
                `;
            }
        }

        function deselectedAllContact() {
            document.querySelector('.selected-all-contact.deselected-all').onclick = function() {
                let checkboxiesInput = document.querySelectorAll('.checkbox input[type=checkbox]');
                checkboxiesInput.forEach(element => {
                    element.checked = false;
                });
                insertNumberOfContactHasSelected(0);
                this.innerHTML = 'selected all';
                this.classList.remove('deselected-all');
                this.classList.add('selected-all');
                document.querySelectorAll('aside.contacts .checkboxies-background').forEach(element => {
                    element.classList.remove('active');
                })
                selectedAllContact();
            }
        }

        let countCheckboxHasChecked = 0;
        document.querySelectorAll('.checkbox input[type=checkbox]').forEach(
            element => {
                countCheckboxHasChecked = 0;
                if (element.checked) {
                    countCheckboxHasChecked += 1;
                }
            });

        // 
        var sortingBy = 'desc';
        var fileTypeOfGets = 'send';
        document.getElementById('change-type-of-sorting').onclick = function() {
            [...this.children].forEach(element => {
                if (element.classList.contains('active')) {
                    element.classList.remove('active')
                } else {
                    sortingBy = element.dataset.sort;
                    filtringDate(document.querySelector('input[name="filter_my_files"]').value, element.dataset
                        .sort, fileTypeOfGets);
                    element.classList.add('active')
                }
            })
        }
        filtringDate(search = '', sort = 'desc');
        async function filtringDate(search = '', sort = 'desc', type = 'send') {
            await fetch(`/filter?sort=${sort}&search=${search}&type=${type}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    },
                }).then(response => response.json())
                .then(reslut => {
                    document.getElementById('my-files').innerHTML = '';
                    var list = '';
                    const ul = document.createElement('ul')
                    Object.keys(reslut).forEach(ele => {
                        reslut[ele].forEach(f => {
                            list += `<li>
                                    <h5>${f.title}</h5>
                                    <ul>
                                        ${ type == 'send' ? "<li><sup></sup> " +( (f.total !=0) ? f.total +' downloads' : 'Not yet downloaded') + " </li>" :''}
                                        <li><sup>.</sup>${f.number_of_file} file</li>
                                        <li><sup>.</sup>${ f.total_size } M</li>
                                        <li><sup>.</sup>Send ${ f.send_at } </li>
                                    </ul>
                                    <ul class="ul-second">
                                        <li><sup></sup><a href=${f.file_link}>Download</a></li>
                                        <li data-link=${f.file_link } onclick=navigator.clipboard.writeText("${f.file_link}") class="my-file-link"><sup>.</sup>Copy link</li>
                                       ${ type == 'send'?
                                       "<li><sup>.</sup>Edit title</li> \
                                        <li><sup>.</sup>Delete</li>":''
                                        }
                                    </ul>
                                    <svg class="arrow-icon--right transferitem__arrow" viewBox="-1 14 9 12">
                                        <path stroke="#babcbf" stroke-width="2" d="M5 15l-5 5 5 5" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </li>
                                `;
                        });
                        span = document.createElement('span');
                        span.innerHTML = ele;
                        item = document.createElement('li');
                        item.innerHTML += `<span>${ele}</span>`;
                        item.innerHTML += `<ul class='show-transfers'>${list}</ul>`;
                        document.getElementById('my-files').append(item);
                        list = [];
                    });
                    // allMyLinksFiles();
                });
        }
        // exist in js.js
        // function allMyLinksFiles() {
        //     [...document.querySelectorAll('li.my-file-link')].forEach(ele => {
        //         ele.onclick = function() {
        //             copy(ele.dataset.link);
        //         }
        //     })
        // }

        // function copy(link) {
        //     console.log(link);
        //     navigator.clipboard.writeText(link);
        // }
        // end exist in js.js
        document.querySelector('input[name="filter_my_files"]').oninput = function() {
            filtringDate(this.value, sortingBy, fileTypeOfGets);
        }
        document.querySelectorAll('div.show-type div.first > span').forEach(ele => {
            ele.onclick = function() {
                document.querySelectorAll('div.show-type div.first > span').forEach(element => {
                    element.classList.toggle('active')
                });
                // ele.classList.add('active');
                filtringDate(document.querySelector('input[name="filter_my_files"]').value, sortingBy,
                    fileTypeOfGets = this.dataset.type)
            }
        })
    </script>
</body>

</html>
