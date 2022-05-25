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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../../assets/js/jquery.min.js"></script>
        <script>
            $("li a").click(function (e) {
                e.preventDefault();
                if ($(this).hasClass("active")) {
                    $("li a").removeClass("active");
                    $(this).addClass("active");
                } else {
                    $("li a").removeClass("active");
                    $(this).addClass("active");
                }
            });
        </script>
        <style>
            section{
                margin:10px;
            }

            #sct_form_search{
                width: 600px;
            }
        </style>
    </head>
    <body>
        <header>
            <nav>
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="http://www.cakeorder.fr/application/views/inscription.php" >Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active " href="#" >Commandes</a></li>
                    <li class="nav-item"><a class="nav-link " href="#" >Clients</a></li>
                    <li class="nav-item"><a class="nav-link " href="#" >Message</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" >Contact</a></li>
                </ul>
            </nav>
        </header>
        <section id="sct_tab_1">
            <form action="http://www.cakeorder.fr/application/controllers/inscription.php" method="POST">
                <input type="hidden" name="action" value="rechercher" >
                <label>Rechercher par id</label>
                <input type="text" name="keyword" >
                <input type="submit" id="bt_actn_search" >
            </form>
        </section>
    <outp></outp>
</body>
</html>
