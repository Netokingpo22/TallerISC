<!DOCTYPE html>
<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>const color = 'DEC239');</script>

<head>
    <title></title>
    <?php require_once "scripts.php";  ?>
</head>
<style type="text/css">
    body {
        background-color: #dc3545
    }

    .login-container {
        margin-top: 5%;
        margin-bottom: 5%;
    }

    .login-logo {
        position: relative;
        margin-left: -41.5%;
    }

    .login-logo img {
        position: absolute;
        width: 20%;
        margin-top: 19%;
        background: #282726;
        border-radius: 4.5rem;
        padding: 5%;
    }

    .login-form-1 {
        padding: 9%;
        background: #282726;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
    }

    .login-form-1 h3 {
        text-align: center;
        margin-bottom: 12%;
        color: #fff;
    }

    .login-form-2 {
        padding: 9%;
        background: #f05837;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
    }

    .login-form-2 h3 {
        text-align: center;
        margin-bottom: 12%;
        color: #fff;
    }

    .btnSubmit {
        font-weight: 600;
        width: 50%;
        color: #282726;
        background-color: #fff;
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
    }

    .btnForgetPwd {
        color: #fff;
        font-weight: 600;
        text-decoration: none;
    }

    .btnForgetPwd:hover {
        text-decoration: none;
        color: #fff;
    }
</style>

<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 login-form-1">
                <h3>Iniciar Sesion</h3>

                <div class="form-group">
                    <input type="text" class="form-control" id="Usuario" placeholder="Usuario *" value="" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="Contraseña" placeholder="Contraseña *" value="" />
                </div>
                <div class="form-group">
                    <input type="button" onclick="validar()" class="btnSubmit" value="Login" />
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    function validar() {
        const nom = document.getElementById('Usuario');
        const nomm = nom.value.trim();
        const cos = document.getElementById('Contraseña');
        const coss = cos.value.trim();
        var band = "1";
        var datos = "nom=" + nomm + "&con=" + coss;
        if (nomm === '') {
            band = "0";
        } else if (nomm.length < 4) {
            band = "0";
        }

        if (coss === '') {
            band = "0";
        }

        if (band === "1") {
            $.ajax({
                type: "POST",
                data: datos,
                url: "Trabajos/procesos/validar.php",
                success: function(r) {
                    if (r == 1) {
                        location.replace("inicio.php");
                    } else {
                        alertify.error("Usuario o Contraseña incorrectos");
                    }
                }
            });
        } else {
            alertify.error("Error al Iniciar Sesion ");
        }
    }
</script>