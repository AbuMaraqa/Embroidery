<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>تسجيل الدخول</title>

    <style>

*{
            font-family: 'Tajawal', sans-serif;
        }

        @font-face{
            font-family: 'Tajawal';
            src: url('{{ asset('assets/admin/fonts/Tajawal/Tajawal-Regular.ttf') }}');
        }
        /* styles.css */
body {
    font-family: Arial, sans-serif;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login-container {
    background-color: #ffffff;
    color: #333;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

h1 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #430E15;
}

.form-group {
    margin-bottom: 15px;
    text-align: right;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #430E15;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #430E15;
}

.forgot-password {
    margin-top: 10px;
}

.forgot-password a {
    color: #430E15;
    text-decoration: none;
}

.forgot-password a:hover {
    text-decoration: underline;
}
    </style>

</head>
<body>
    <div class="login-container">
        <h1>تسجيل الدخول</h1>
        <form accept="{{ route('login')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" placeholder="أدخل بريدك الإلكتروني" required>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" name="password" class="" id="password" placeholder="أدخل كلمة المرور" required>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit">دخول</button>
            <p class="forgot-password">
                ليس لديك حساب؟ <a href="{{ route('register')}}">سجل حساب هنا</a>
            </p>
        </form>
    </div>
</body>
</html>
