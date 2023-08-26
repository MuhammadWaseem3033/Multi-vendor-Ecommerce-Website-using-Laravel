@extends('frontend.layout.layout')
@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Account</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="account.html">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Account-Page -->
    <br><br>
    <div style="margin-left:10rem;">
    </div>
    <div class="page-account u-s-p-t-80">
        <div class="container">
            <div class="row">
                <!-- Login -->
                <div class="col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="col-lg-6">
                    <div class="login-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Updata Contact Details</h2>
                        <form action="{{ route('user.login.register') }}" method="post">
                            @csrf
                            <div class="u-s-m-b-30">
                                <label for="user-email"> Email
                                    <span class="astk">*</span>
                                </label>
                                <input id="user-email" value="{{ Auth::user()->email }}" readonly class="text-field"
                                    style="background-color: rgb(85, 79, 79);color:#fff">
                                <p id="account-email"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-name"> Name
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="name" id="user-name" value="{{ Auth::user()->name }}"
                                    class="text-field">
                                <p id="account-name"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="account-address">Address
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="address" id="user-address" value="{{ Auth::user()->address }}"
                                    class="text-field">
                                <p id="account-address"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-city"> City
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="city" id="user-city" value="{{ Auth::user()->city }}"
                                    class="text-field">
                                <p id="account-city"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-state"> State
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="state" id="user-state" value="{{ Auth::user()->state }}"
                                    class="text-field">
                                <p id="account-state"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-pincode"> pincode
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="pincode" id="user-pincode" value="{{ Auth::user()->pincode }}"
                                    class="text-field">
                                <p id="account-pincode"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-mobile"> Mobile
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="mobile" id="user-mobile" value="{{ Auth::user()->mobile }}"
                                    class="text-field">
                                <p id="account-mobile"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="account-country"> Country
                                    <span class="astk">*</span>
                                </label>
                                <select name="country" id="user-country" class="text-field">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['country_name'] }}"
                                            @if ($country['country_name'] == Auth::user()->country) selected @endif>{{ $country['country_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <p id="account-country"></p>
                            </div>
                            <div class="m-b-45">
                                <button class="button button-outline-secondary w-100">Update Details</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login /- -->
                <!-- Register -->
                <div class="col-lg-6">
                    <div class="reg-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Register</h2>
                        <h6 class="account-h6 u-s-m-b-30">Registering for this site allows you to access your order status
                            and history.</h6>
                        <form id="registerForm" action="{{ route('user.register') }}" method="post">
                            @csrf
                            <div class="u-s-m-b-30">
                                <label for="username">Username
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-name" name="name" class="text-field"
                                    placeholder="Username">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="usermobile">Mobile
                                    <span class="astk">*</span>
                                </label>
                                <input type="number" min="5" maxlength="10" id="user-mobile" name="mobile"
                                    class="text-field" placeholder="user Moblie">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="useremail">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" id="user-email" name="email" class="text-field"
                                    placeholder="user Email">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="userpassword">Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-password" name="password" class="text-field"
                                    placeholder="Vednor Password">
                            </div>
                            <div class="u-s-m-b-30">
                                <input type="checkbox" name="accept" class="check-box" id="accept">
                                <label class="label-text no-color" for="accept">I’ve read and accept the
                                    <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                                </label>
                            </div>
                            <div class="u-s-m-b-45">
                                <button class="button button-primary w-100">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Register /- -->
            </div>
        </div>
    </div>
    <!-- Account-Page /- -->
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#formid").on("submit", function() {
            $(".loader").show();
        }); //submit
    }); //document ready
</script>
