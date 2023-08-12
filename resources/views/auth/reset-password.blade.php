<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/js.js'])
    <style>
        .reset-password form {
            width: 45%;
            margin-left: auto;
            margin-right: auto;
        }

        .reset-password form input {
            width: 100%;
            background: #eee;
            border: none;
            height: 55px;
            font-size: 15px;
            border-radius: 5px;
            padding-left: 40px;
            color: #66666648;
            border: 2px solid transparent;
            transition: 0.3s;
        }

        .reset-password form input::-webkit-input-placeholder {
            color: #666666b0;
            transition: 0.3s;
        }

        .reset-password form input:focus::-webkit-input-placeholder {
            color: rgba(0, 0, 255, 0.651);
        }

        .reset-password form input:focus {
            /* color: blue; */
            color: rgba(0, 0, 255, 0.651);
            border: 2px solid rgba(0, 0, 255, 0.486);
        }

        .reset-password form input:focus+i {
            color: rgba(0, 0, 255, 0.486);
        }

        .reset-password form button {
            border: none;
            border-radius: 25px;
            display: block;
            width: fit-content;
            /* height: 50px; */
            padding: 15px 30px;
            background: #333;
            color: #fff;
            font-size: 17px;
            font-weight: 500;
            cursor: pointer;
            margin-left: auto;
            margin-right: auto;
            transition: 0.2s;
        }

        .reset-password form button:hover {
            background: #191919;
        }

        .reset-password form i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #66666648;
            left: 10px;
            font-size: 18px;
        }

        .reset-password form>div {
            position: relative;
            margin: 10px 0;
        }

        .reset-password {
            display: flex;
            align-items: center;
            height: 100vh;
        }

        .reset-password .image {
            flex: 1;
            background: #858eff1f;
            background: #45359e0c;
            background: #6666660a;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reset-password img {
            width: 80%;
            /* filter: grayscale(1); */
        }

        .reset-password .form {
            flex: 1;
        }

        .reset-password .form span {
            color: #666;
            line-height: 1.6;
            text-align: center;
            display: block;
            margin-bottom: 18px;
        }

        .reset-password .form span span {
            color: #222;
        }

        /* .reset-password .form>div {
            background: #ffb5ef;
            border-radius: 719px 416px 364px 204px;
            width: 70%;
            text-align: center;
            justify-content: center;
            align-items: center;
            display: inline;flex;
        } */
    </style>
</head>

<body style="background: #fff">
    <section class="reset-password">
        <div class="image">
            {{-- <img src="{{ asset('assets/image/authentication-security-3887132-3240392.png') }}" alt=""> --}}
            {{-- <img src="{{ asset('assets/image/il2.png') }}" alt=""> --}}
            <img src="{{ asset('assets/image/il2-fotor-20230805185326.png') }}" alt="">
        </div>
        <div class="form">
            <form action="reset-password" method="post" class="register" id="form-forgot">
                @csrf
                <input type="text" name="token" value="{{ $token }}" hidden>
                <input type="email" name="email" value="{{ $email }}"hidden>
                <span>
                    {{-- <span> Reset Your Password</span> --}}
                    Set a new password that's long, strong, adn memorable, Like a good superhero movie.
                    <span>{{ $email }}</span>
                </span>
                <x-input-form type='password' name='password' placeholder="New password" icon='fa-solid fa-key'
                    required />
                <x-input-form type='password' name='password_confirmation' placeholder="Confirm new password"
                    icon='fa-solid fa-key' required />

                <button type="submit" style="width: 100%">Save new password</button>
            </form>
        </div>
    </section>
</body>

</html>
