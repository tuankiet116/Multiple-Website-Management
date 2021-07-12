<!---------- LOGIN ---------->

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-user-content modal-login">
            <div class="modal-header">
                <div class="modal-user-title">
                    <span> Đăng nhập </span>
                </div>

                <button type="button" id="close-login" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-login">
                    <div class="modal-account">
                        <label> Tài khoản </label>
                        <div class="modal-account-content">
                            <input class="user-name" type="text" name="account" placeholder="Nhập tài khoản">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>

                    <div class="modal-account">
                        <label> Mật khẩu </label>
                        <div class="modal-account-content">
                            <input class="user-pass" type="password" name="password" placeholder="Nhập mật khẩu">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>

                    <div class="modal-submit">
                        <button class="user-submit" type="submit" name="login">
                            <i class="fas fa-sign-in-alt"></i>
                            Ðang nhập
                        </button>
                        <span> Bạn chưa có tài khoản? </span>
                        <a class="modal-signup" href="" target="_self" name="signup" data-toggle="modal" data-target="#signupModal"> Đăng ký </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!---------- SIGN UP ---------->

<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-user-content modal-sign">
            <div class="modal-header">
                <div class="modal-user-title">
                    <span> Đăng ký </span>
                </div>

                <button type="button" id="close-signup" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="modal-signup-left col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="modal-account">
                                    <label> Tài khoản </label>
                                    <div class="modal-account-content">
                                        <input class="signup-account" type="text" name="account_signup" placeholder="Nhập tài khoản">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div id="modal-account-name"></div>
                                </div>

                                <div class="modal-account">
                                    <label> Mật khẩu </label>
                                    <div class="modal-account-content">
                                        <input class="signup-password" type="password" name="password_signup" placeholder="Nhập mật khẩu">
                                        <i class="fas fa-unlock"></i>
                                    </div>
                                    <div id="modal-account-password"></div>
                                </div>

                                <div class="modal-account">
                                    <label> Nhập lại mật khẩu </label>
                                    <div class="modal-account-content">
                                        <input class="signup-password-again" type="password" name="password_signup_again" placeholder="Nhập lại mật khẩu">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <div id="modal-account-password-main"></div>
                                </div>
                            </div>

                            <div class="modal-signup-right col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="modal-account">
                                    <label> Email </label>
                                    <div class="modal-account-content">
                                        <input class="signup-email" type="email" name="account_signup" placeholder="Nhập email">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div id="modal-account-email"></div>
                                </div>

                                <div class="modal-account">
                                    <label> Số điện thoại </label>
                                    <div class="modal-account-content">
                                        <input class="signup-phone" type="number" name="password_signup" placeholder="Nhập số điện thoại">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div id="modal-account-phone"></div>
                                </div>

                                <div class="modal-account">
                                    <label> Địa chỉ </label>
                                    <div class="modal-account-content">
                                        <input class="signup-address" type="text" name="password_signup_again" placeholder="Nhập địa chỉ">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                    <div id="modal-account-address"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-submit">
                        <button class="signup-submit" type="submit" name="signup">
                            <i class="fas fa-user-plus"></i>
                            Đăng ký
                        </button>
                        <span> Bạn đã có tài khoản? </span>
                        <a id="back-login" class="modal-back-login" href="" target="_self" name="signup" data-toggle="modal" data-target="#userModal"> Đăng nhập </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>