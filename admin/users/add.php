<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới người dùng</title>
    <!-- Thêm link CSS của Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-12" >
    <h2 class="mb-4">Thêm account</h2>

    <form method="post" enctype="multipart/form-data" onsubmit="return validateAddUser()">
        <div class="form-group">
            <label for="username">Tài khoản</label>
            <input type="text" class="form-control" id="username" name="username" >
            <span id="usernameError" style="color: red;"></span>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" >
            <span id="passwordError" style="color: red;"></span>
        </div>
        <div class="form-group">
            <label for="fullname">Họ và tên</label>
            <input type="text" class="form-control" id="fullname" name="fullname" >
            <span id="fullnameError" style="color: red;"></span>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" >
            <span id="emailError" style="color: red;"></span>
        </div>

        <div class="form-group">
            <label for="role">Phân quyền</label>
            <select class="form-control" id="role" name="role">
                <option value="0">User</option>
                <option value="1">Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*">
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="tel" class="form-control" id="phone" name="phone">
            <span id="phoneError" style="color: red;"></span>
        </div>


        <a href="index.php?act=listuser" type="button" class="btn btn-danger">Hủy</a>
        <button class="btn btn-primary" name="addUser">Thêm</button>
    </form>
</div>

<script src="/validate/validateuser.js"></script>


<!-- Thêm link JavaScript của Bootstrap (nếu cần) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>