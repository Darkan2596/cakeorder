<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <base href="http://www.cakeorder.fr" >
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../../assets/js/jquery.min.js"></script>
    </head>
    <style>
        #sctn_from_cnx{
            width:400px;
            position: absolute;
            top : 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
    </style>
    
    <body>
        <main style="color: red" >
            <section id="sctn_from_cnx" class="p-4 border rounded bg-light">
                <form method="post" action="/application/controllers/authentification.php">
                    <input type="hidden" name="action" value="login">
                    <div  class="mb-2">
                        <label class="form-label">Login</label>
                        <input class="form-control" type="text" name="identifiant">
                    </div>
                    <div  class="mb-2">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <div  class="ajust-ctn-btn">
                        <input type="submit" class="btn btn-secondary mt-3 " value="Connexion" >
                    </div>
                </form>
            </section>
        </main>
    
    </body>
</html>
