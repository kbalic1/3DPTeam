<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>3D-Platforma</title>

    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" href="css/signup.css" type="text/css">
    <link rel="stylesheet" href="css/kontakt.css" type="text/css">
    <link rel="stylesheet" href="css/logo.css" type="text/css">

</head>

<body id="page-top">
<?php include('nav.php') ?>

    <section id="contactSection">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <h2 class="section-heading">Kontaktirajte nas!</h2>
                    <p>Ukoliko imate neki komentar, primjedbu, prijedlog rado ćemo se odazvati, zato nas kontaktirajte!</p>
                </div>
            </div>
                <div class="row">
                    <form novalidate>
                        <div class="col-lg-6 col-lg-offset-3 text-center">
                            <div class="form-group">
                                <label >Unesite Ime i Prezime</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="InputFullName" name="InputFullName" placeholder="Unesite Ime i Prezime" >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                </div>
                            </div>  
                             <div class="form-group">
                                <label >Unesite Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="InputEmailFirst" name="InputEmail" placeholder="Unesite Email" >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="InputMessage">Vaš komentar</label>
                                <div class="input-group">
                                    <textarea name="InputMessage" id="InputMessage" class="form-control" rows="5" placeholder="Unesite vaš komentar..." required></textarea>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                </div>
                            </div>
                            <input type="submit" name="submit" id="submit" value="Postavi" class="btn btn-info pull-right">
                        </div>
                    </form>

                </div>

        </div>
       
    </section>

    <?php include('footer.php') ?>

</body>
</html>
