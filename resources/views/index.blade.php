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
        aside.contacts,
        aside.transfers {
            position: absolute;
            background: #fff;
            height: 100%;
            right: 0;
            width: 0%;
            transition: 0.3s;
        }

        aside.contacts.view,
        aside.transfers.view {
            width: 55%;
        }

        aside.contacts i.close,
        aside.transfers i.close {
            position: relative;
            top: 12px;
            left: 10px;
            font-size: 20px;
            color: #6666;
            cursor: pointer;
            transition: 0.2s;
        }

        aside.transfers i.close {
            margin-bottom: 18px;
        }

        aside.transfers i.close:hover {
            color: #666;
        }

        aside.contacts:first-of-type div {
            margin-bottom: 25px;
        }

        aside.contacts:first-of-type div i:hover {
            color: #666;
        }

        aside.contacts div.header,
        aside.transfers div.header {
            margin: 0;
            display: flex;
            flex-direction: revert;
            align-items: center;
            justify-content: space-between;
            padding: 0;
            margin-top: 35px;
        }

        aside.contacts div.header .left,
        aside.transfers div.header .left {
            flex: 1;
        }

        aside.contacts div.header .left h3,
        aside.transfers div.header .left h3 {
            font-size: 50px;
            font-weight: 500;
            color: #333;
            /* color: #ff57228a; */
        }

        aside.transfers div.header .left h4 {
            font-size: 18px;
            font-weight: 500;
            text-transform: uppercase;
            color: #666;
            letter-spacing: 4px;
            text-wrap: nowrap;
        }

        aside.contacts div.header .left>div,
        aside.transfers div.header .left>div {
            color: #33333396;
            font-size: 14px;
            margin-top: -2px;
        }

        aside.contacts div.header .left>div sup,
        aside.transfers div.header .left>div sup {
            margin: 0px 4px;
        }

        aside.contacts div.header .left>div span {
            /* text-decoration: underline; */
            cursor: pointer;
            transition: 0.2s;
            position: relative;
        }

        aside.contacts div.header .left>div span::after {
            content: '';
            width: 0%;
            height: 1px;
            background: rgba(0, 128, 0, 0.562);
            position: absolute;
            bottom: 0;
            left: 0;
            transition: 0.2s;
        }

        aside.contacts div.header .left>div span:hover {
            color: rgba(0, 128, 0, 0.562);
        }

        aside.contacts div.header .left>div span:hover::after {
            width: 100%;
        }

        aside.contacts hr,
        aside.transfers hr {
            opacity: 0.4;
        }

        aside.contacts div.header .right,
        aside.transfers div.header .right {
            flex: 1;
        }

        aside.contacts div.header .right>div,
        aside.transfers div.header .right>div {
            position: relative;
            margin-left: 25px;
        }

        aside.contacts input,
        aside.transfers input {
            height: 45px;
            color: #66666636;
            border: 2px solid;
            border-radius: 5px;
            padding: 5px;
            padding-left: 35px;
            width: 100%;
            font-size: 15px;
        }

        aside.transfers input {
            position: relative;
            top: 45px;
        }

        aside.contacts input:focus,
        aside.contacts input.focus,
        aside.transfers input:focus,
        aside.transfers input.focus {
            color: #3f51b571;

        }

        aside.contacts input::placeholder,
        aside.transfers input::placeholder {
            color: #6666667a;
        }

        aside.contacts input:focus::placeholder,
        aside.transfers input:focus::placeholder {
            color: #3f51b579;
        }

        aside.contacts div.header .right>div i,
        aside.transfers div.header .right>div i {
            position: absolute;
            left: 15px;
            top: 50%;
            color: #3333;
            transform: translateY(-50%);
        }

        aside.transfers div.header .right>div i {
            top: 70px;
        }

        aside.contacts input:focus+i,
        aside.transfers input:focus+i {
            color: #3f51b579;
        }

        aside.contacts .contact {
            color: #666;
        }

        aside.contacts .contact>span {
            margin-bottom: 5px;
            display: inline-block;
            font-weight: 500;
            color: #333;
        }

        aside.contacts .contact label {
            display: flex;
            margin: 0;
            padding: 12px 0;
            align-items: center;

        }

        aside.contacts .contact label>span {
            flex: 1;
            font-weight: 500;
            color: gray;
        }

        aside.contacts .contact label>span span {
            display: block;
            font-size: 14px;
            color: #6666668f;
        }

        aside.contacts .contact label>span span sup {
            margin: 0 3px;
        }

        aside.contacts .contact label>ul {
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: center;
            column-gap: 8px;
            font-size: 14px;
            pointer-events: auto;
        }

        aside.contacts .contact label>ul.remove {
            display: none;
        }

        aside.contacts .contact label>ul li {
            cursor: pointer;
            position: relative;
            transition: 0.2s;
            color: #6666;
        }

        aside.contacts .contact label>ul li.add:hover {
            color: #5757ff;
        }

        aside.contacts .contact label>ul li.edit:hover {
            color: #ff9800a3;
        }

        aside.contacts .contact label>ul li.delete:hover {
            color: #ff000091
        }

        aside.contacts .contact label>ul li::after {
            content: '';
            width: 0%;
            height: 1px;
            position: absolute;
            bottom: 0;
            left: 0;
            transition: 0.2s;
        }

        aside.contacts .contact label>ul li.delete::after {
            background: #ff000091;
        }

        aside.contacts .contact label>ul li.edit::after {
            background: #ff9800a3;
        }

        aside.contacts .contact label>ul li.add::after {
            background: #5757ff;
        }

        aside.contacts .contact label>ul li:hover::after {
            width: 100%;
        }

        aside.contacts .contents,
        aside.transfers .contents {
            padding: 0px 75px;
        }

        aside.contacts .add-contact {
            display: flex;
            align-items: center;
            justify-content: space-between;
            column-gap: 8px;
            position: relative;
            top: -13px;
        }

        aside.contacts .add-contact.hidden {
            display: none;
        }

        aside.contacts .add-contact input {
            height: 38px;
            padding-left: 8px;
            border-radius: 3px;
        }

        aside.contacts .add-contact>div {
            display: flex;
            align-items: center;
            column-gap: 8px;
            justify-content: center;
            font-size: 23px;
            margin: 0;
            color: #6666;
        }

        aside.contacts .add-contact>div i {
            cursor: pointer;
        }

        aside.contacts .add-contact>div i.true:hover {
            color: rgba(0, 0, 255, 0.486);
        }

        aside.contacts .add-contact>div i.false:hover {
            color: rgba(255, 0, 0, 0.527);
        }

        aside.contacts .checkboxies-background {
            transition: 0.2s;
        }

        aside.contacts .checkboxies-background:hover {
            background: #0000ff0d;
        }

        aside.contacts .checkboxies-background.active {
            background: #0000ff2b;
        }

        aside.contacts.view .deleted-contact-details {
            display: none;
            align-items: center;
            justify-content: space-between;
            width: 73%;
            margin-left: auto;
            margin-right: auto;
            background: #0000ffa8;
            padding: 12px 12px;
            border-radius: 5px;
            color: #fff;
            box-shadow: 0 0 17px -5px #0000ff3d;
            position: fixed;
            bottom: -20px;
            width: 41%;
            left: 53%;
            transition: 0.5s;
        }

        aside.contacts.view .deleted-contact-details.view {
            display: flex;
        }

        aside.contacts.view .deleted-contact-details .left {
            display: flex;
            align-items: center;
            margin: 0;
        }

        aside.contacts.view .deleted-contact-details .left .number-of-contact-selected {
            margin: 0;
            margin-right: 8px;
        }

        aside.contacts.view .deleted-contact-details .left .number-of-contact-selected>span {
            margin-right: 3px;
        }

        aside.contacts.view .deleted-contact-details .right {
            margin: 0;
        }

        aside.contacts.view .deleted-contact-details .left>span {
            cursor: pointer;
            text-decoration: underline;
        }

        aside.contacts.view .deleted-contact-details .right span.delete {
            display: inline-block;
            height: 45px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #fff;
            padding: 20px;
            color: #5757ff;
            background: #fff;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 5px;
        }

        aside.contacts.view .deleted-contact-details .right span.cancel {
            border: 2px solid;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 3px;
        }

        .container #contact_email_to {
            padding: 5px 15px;
            max-height: 80px;
            /* background: red; */
            overflow: auto;
        }

        .container #contact_email_to>span {
            display: block;
            background: #6666662b;
            width: fit-content;
            padding: 3px 15px;
            border-radius: 35px;
            font-size: 14px;
            color: #222;
            margin-bottom: 3px;
            cursor: pointer;
            transition: 0.1s;
        }

        .container #contact_email_to>span:hover i {
            opacity: 1;
        }

        .container #contact_email_to>span i {
            font-size: 11px;
            transition: 0.2s;
            opacity: 0;
            position: relative;
            left: 5px;
        }

        .container #contact_email_to>span i:hover {
            color: #5268ff;
        }

        /* transfer file */
        aside.transfers div.show-type {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 50px;
        }

        aside.transfers div.show-type>div.first span {
            color: #999;
            padding: 8px;
            padding-left: 4px;
            padding-right: 2px;
            cursor: pointer;
            transition: 0.2s;
            border-bottom-color: transparent;
            margin-right: 20px;
            font-size: 18px;
        }

        aside.transfers div.show-type>div.first span:hover {
            color: #333;
        }

        aside.transfers div.show-type>div.first span.active {
            border-bottom: 2px solid #333;
            color: #333;
        }

        aside.transfers div.show-type>div.second {
            position: relative;
        }

        aside.transfers div.show-type>div.second>span {
            color: #999;
            font-size: 18px;
            cursor: pointer;
        }

        aside.transfers div.show-type>div.second ul {
            list-style: none;
            color: #444;
            font-weight: 400;
            position: absolute;
            background: #fff;
            box-shadow: 0 0 20px -6px #22222261;
            padding: 8px 0px;
            width: 135px;
            border-radius: 5px;
            left: -22px;
            top: 32px;
            height: 156px;
            z-index: 1;
            transition: 0.2s;
        }

        aside.transfers div.show-type>div.second ul.remove {
            height: 0px;
            padding: 0;
            overflow: hidden;
        }

        aside.transfers div.show-type>div.second ul li {
            font-size: 16px;
            padding: 7px 12px;
            cursor: pointer;
        }

        aside.transfers div.show-type>div.second ul li.active {
            color: #fff;
            background: #0000ffb3;
            pointer-events: none;
        }

        aside.transfers div.show-type>div.second ul li:hover {
            color: #0000ffb3;
        }

        aside.transfers div.show-type .type-of-show-transfer {
            color: #0000ffba;
            font-weight: 500;
            font-size: 16px;
            border-bottom: 2px solid;
            display: inline-block;
        }

        aside.transfers div.show-type .type-of-show-transfer+span.icons {
            font-size: 10px;
            display: inline-flex;
            column-gap: 1px;
            margin-left: 5px;
            color: #9999;
        }

        aside.transfers div.show-type .type-of-show-transfer+span.icons i {
            transition: 0.3s;
        }

        aside.transfers div.show-type .type-of-show-transfer+span.icons i.active {
            color: #0000ffba;
        }

        aside.transfers .auth-information {
            /* height: 35px; */
        }

        aside.transfers .auth-information>div {
            width: fit-content;
            margin-left: auto;
            margin-right: 15px;
            margin-top: 15px;
        }

        aside.transfers .auth-information>div span.avatar-default {
            font-size: 12px;
            font-weight: 500;
            color: #E91E63;
            display: inline-block;
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #e91e6347;
            border-radius: 50%;
            cursor: default;
            margin-right: 8px;
        }

        aside.transfers .auth-information>div>i {
            color: #6666669e;
            cursor: pointer;
        }

        aside.transfers .show-transfers {
            list-style: none;
        }

        aside.transfers .show-transfers>li {
            color: #333;
            position: relative;
            height: 64px;
            padding: 10px 15px;
            border: 1px solid #66666614;
            border-radius: 5px;
            margin-top: 8px;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 0 13px -8px #33333314;
        }

        aside.transfers .show-transfers>li:hover {
            background: #8080800f;
        }

        aside.transfers .show-transfers h5 {
            color: #444;
        }

        aside.transfers .show-transfers>li>ul {
            position: absolute;
            list-style: none;
            color: #9999;
            display: flex;
            align-items: center;
            font-size: 12px;
            top: 25px;
            left: 8px;
        }

        aside.transfers .show-transfers>li:hover ul {
            display: none;
        }

        aside.transfers .show-transfers>li:hover ul.ul-second {
            display: flex;
        }

        aside.transfers .show-transfers>li>ul.ul-second {
            display: none;
        }

        aside.transfers .show-transfers>li>ul>li {
            /* cursor: pointer; */
            color: #999;
            cursor: default;

        }

        aside.transfers .show-transfers>li>ul.ul-second>li,
        aside.transfers .show-transfers>li>ul.ul-second>li a {
            cursor: pointer;
            transition: 0.2s;
            color: #9999;
            text-decoration: none;
        }

        aside.transfers .show-transfers>li>ul.ul-second>li:hover,
        aside.transfers .show-transfers>li>ul.ul-second>li a:hover {
            color: #999;
        }

        aside.transfers .show-transfers>li>ul>li sup {
            margin: 4px;
            font-size: 16px;
        }

        aside.transfers .show-transfers svg {
            width: 12px;
            float: right;
            transform: rotateY(180deg);
            top: -2px;
            position: relative;
            right: 12px;
            transition: 0.3s;
        }

        aside.transfers .show-transfers svg:hover {
            fill: #0000ffba;
        }

        aside.transfers .trnasfers-send {
            max-height: 350px;
            overflow-y: auto;
        }

        aside.transfers .trnasfers-send>ul {
            list-style: none;
            color: #777;
            margin-top: 30px;
            padding-bottom: 30px;
        }

        aside.transfers .trnasfers-send>ul>li>span {
            margin-bottom: 15px;
            margin-top: 15px;
            display: block;
        }
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
                    <x-partials.input type='email' name='your_email' label='Your email' />
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
                        <x-input-form type='search' name='email' placeholder="search for email, name, company"
                            icon='fa-solid fa-magnifying-glass' required />
                    </div>
                </div>
                <div class="add-contact hidden" id="add-contact">
                    <input type="text" name="" placeholder="Email address">
                    <input type="text" name="" placeholder="Name">
                    <input type="text" name="" placeholder="Company">
                    <div>
                        <i class="fa-regular fa-circle-check true"></i>
                        <i class="fa-regular fa-circle-xmark false"
                            onclick="this.parentNode.parentNode.classList.add('hidden')"></i>
                    </div>
                </div>
                <div class="contact">
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
        <aside class="transfers" style="width:55%">
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
                        <x-input-form type='search' name='email' placeholder="search for title, name, email"
                            icon='fa-solid fa-magnifying-glass' required />
                    </div>
                </div>
                <div class="show-type">
                    <div class="first">
                        <span class="send active">
                            Send
                        </span>
                        <span class="received">
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
                                <i class="fa-solid fa-arrow-up active"></i>
                                <i class="fa-solid fa-arrow-down"></i>
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
                    <ul>
                        <li> <span>August 2023</span>
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
                        </li>
                        <li> <span>August 2023</span>
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
                        </li>
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
        console.log(document.querySelectorAll('ul.contact-options'));

        function deleteContacts() {
            document.querySelectorAll('li.delete-contact').forEach((element, i) => {
                element.onclick = function() {
                    removeContact();
                    selectedCheckedboxClicked(i);
                }
            });
        }
        deleteContacts();
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
                                <input type="text" class='focus' name="" value="${this.parentNode.parentNode.children[0].children[1].innerText.split('.')[1]}" placeholder="Company">
                                <div>
                                    <i class="fa-regular fa-circle-check true"></i>
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
                }
            });
        }
        editContact();
        addContactsToEmail();

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
                    // if(this.parentNode.children[0].innerText == ??)
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

        selectedAllContact();

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

        document.getElementById('change-type-of-sorting').onclick = function() {
            [...this.children].forEach(element => {
                if (element.classList.contains('active')) {
                    element.classList.remove('active')
                } else {
                    element.classList.add('active')
                }
            })
        }
    </script>
</body>

</html>
