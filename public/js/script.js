$(document).ready(function () {
    $('#signupForm').validate({
        rules: {
            address: {
                required: true,
                minlength: 15
            },
            phone: {
                required: true,
                minlength: 10,
            },
            username: {
                required: true,
                minlength: 5
            },
            password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                minlength: 8,
                equalTo: '#password',
            },
            email: {
                required: true,
                email: true
            },
            agree: 'required',
        },
        messages: {
            address: {
                required: 'Bạn chưa nhập địa chỉ',
                minlength: 'Bạn cần nhập đầy đủ địa chỉ'
            },
            phone: {
                minlength: 'Số điện thoại phải đủ 10 kí tự',
                required: 'Bạn chưa nhập số điện thoại'
            },
            username: {
                required: 'Bạn chưa nhập vào tên đăng nhập',
                minlength: 'Tên đăng nhập phải có ít nhất 5 ký tự',
            },
            password: {
                required: 'Bạn chưa nhập mật khẩu',
                minlength: 'Mật khẩu phải có ít nhất 8 ký tự',
            },
            confirm_password: {
                required: 'Bạn chưa nhập mật khẩu',
                minlength: 'Mật khẩu phải có ít nhất 8 ký tự',
                equalTo: 'Mật khẩu không trùng khớp với mật khẩu đã nhập',
            },
            email: 'Hộp thư điện tử không hợp lệ',
            agree: 'Bạn phải đồng ý với các quy định của chúng tôi',
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            if (element.prop('type') == 'checkbox') {
                error.insertAfter(element.siblings('label'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element)
                .addClass('is-invalid')
                .removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element)
                .addClass('is-valid')
                .removeClass('is-invalid');
        },
    });
});
$(document).ready(function () {
    $('#changepwForm').validate({
        rules: {
            oldpassword: {
                required: true,
                minlength: 8
            },
            password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                minlength: 8,
                equalTo: '#password',
            }
        },
        messages: {
            oldpassword: {
                required: 'Bạn chưa nhập mật khẩu',
                minlength: 'Mật khẩu phải có ít nhất 8 ký tự',
            },
            password: {
                required: 'Bạn chưa nhập mật khẩu',
                minlength: 'Mật khẩu phải có ít nhất 8 ký tự',
            },
            confirm_password: {
                required: 'Bạn chưa nhập mật khẩu',
                minlength: 'Mật khẩu phải có ít nhất 8 ký tự',
                equalTo: 'Mật khẩu không trùng khớp với mật khẩu đã nhập',
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            if (element.prop('type') == 'checkbox') {
                error.insertAfter(element.siblings('label'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element)
                .addClass('is-invalid')
                .removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element)
                .addClass('is-valid')
                .removeClass('is-invalid');
        },
    });
});
$(document).ready(function () {
    $('#changeacc').validate({
        rules: {
            changeaddress: {
                required: true,
                minlength: 5
            },
            changephone: {
                required: true,
                minlength: 10,
            },
        },
        messages: {
            changeaddress: {
                required: 'Bạn chưa nhập địa chỉ',
                minlength: 'Bạn cần nhập đầy đủ địa chỉ'
            },
            changephone: {
                minlength: 'Số điện thoại phải đủ 10 kí tự',
                required: 'Bạn chưa nhập số điện thoại'
            },
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            if (element.prop('type') == 'checkbox') {
                error.insertAfter(element.siblings('label'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element)
                .addClass('is-invalid')
                .removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element)
                .addClass('is-valid')
                .removeClass('is-invalid');
        },
    });
});
