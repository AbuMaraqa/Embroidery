<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب</title>

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
    margin: 0;
    font-family: 'Arial', sans-serif;
    /* background: linear-gradient(135deg, #ff7eb3, #ff758c); */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.signup-container {
    background: #fff;
    padding: 30px 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
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
    font-size: 14px;
    margin-bottom: 5px;
    color: #333;
}

input {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    outline: none;
}

select {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    outline: none;
}

input:focus {
    border-color: #430E15;
    box-shadow: 0 0 5px rgba(255, 126, 179, 0.5);
}

.signup-btn {
    background: #430E15;
    color: #fff;
    font-size: 16px;
    padding: 10px;
    width: 100%;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.signup-btn:hover {
    background: #430E15;
}

.login-link {
    margin-top: 10px;
    font-size: 14px;
}

.login-link a {
    text-decoration: none;
    color: #430E15;
}

.login-link a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>
    <div class="signup-container">
        <h1>تسجيل حساب جديد</h1>
        @if($errors->any())
    <ul>
    @foreach($errors->all() as $error)
        <li class="text-danger">{{ $error }}</li>
    @endforeach
    </ul>
@endif
        <form action="{{ route('register')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">الاسم الكامل</label>
                <input type="text" name="name" id="name" placeholder="أدخل اسمك الكامل" required>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" placeholder="أدخل بريدك الإلكتروني" required>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" name="password" id="password" placeholder="أدخل كلمة المرور" required>
            </div>
            <div class="form-group">
                <label for="password">رقم الهاتف</label>
                <input type="number" name="phone" id="phone" placeholder="ادخل رقم الهاتف" required>
            </div>
            <div class="form-group">
                <label>اختر مستخدم</label>
                <select name="user_role" required>
                    <option value="">اختر مستخدم</option>
                    <option value="embroider">مطرز</option>
                    <option value="client">عميل</option>
                </select>
            </div>
            <button type="submit" class="signup-btn">تسجيل</button>
            <p class="login-link">
                لديك حساب؟ <a href="{{ route('login')}}">سجل الدخول هنا</a>
            </p>
        </form>
    </div>
</body>
</html>
