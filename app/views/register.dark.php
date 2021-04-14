<extends:layout.base title="[[Welcome To Spiral]]"/>

<stack:push name="styles">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</stack:push>

<stack:push name="scripts">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
            integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha256-CjSoeELFOcH0/uxWu6mC/Vlrc1AARqbm/jiiImDGV3s=" crossorigin="anonymous"></script>
</stack:push>

<define:body>
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page section-image">
            <div class="content">
                <div class="container">
                    <div class="col-md-4 ml-auto mr-auto">
                        <form class="form" method="post" action="/register">
                            <div class="card card-login card-plain">
                                <div class="card-header ">
                                    <div class="logo-container text-center" style="width: auto;">
                                        <h4>Register</h4>
                                    </div>
                                    <div id='messages'>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="input-group no-border form-control-lg">
                                        <span class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="now-ui-icons users_circle-08"></i>
                                          </div>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Email..."
                                               name="email">
                                    </div>
                                    <div class="input-group no-border form-control-lg">
                                        <span class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="now-ui-icons users_circle-08"></i>
                                          </div>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Username..."
                                               name="username">
                                    </div>
                                    <div class="input-group no-border form-control-lg">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="now-ui-icons objects_key-25"></i>
                                            </div>
                                        </div>
                                        <input type="password" placeholder="Password..." class="form-control"
                                               name="password">
                                    </div>
                                    <div class="input-group no-border form-control-lg">
                                        <span class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="now-ui-icons users_circle-08"></i>
                                          </div>
                                        </span>
                                        <input type="text" class="form-control" placeholder="First Name..."
                                               name="first_name">
                                    </div>
                                    <div class="input-group no-border form-control-lg">
                                        <span class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="now-ui-icons users_circle-08"></i>
                                          </div>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Last Name..."
                                               name="last_name">
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <input type="submit" class="btn btn-info btn-round btn-lg btn-block mb-3"
                                           value="Register"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</define:body>
