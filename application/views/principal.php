<?php
session_start();
require_once '../libraries/Autoloader.php';
if (isset($_SESSION['access_ctrl']) && $_SESSION['access_ctrl'] == session_id()) :
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>cakeorder.fr</title>
        <base href="http://www.cakeorder.fr">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
        <style>
            html,
            body {
                width: 100%;
                min-height: 100%;
            }

            main {
                min-width: 100%;
                min-height: 100%;
            }

            #ctn_div_central {
                width: 100%;
                padding: 0px;
            }

            section[id^="sctn_tab_"] {
                width: 100%;
                padding: 0px 80px;
                margin: 40px 0px;
            }

            nav.mr-2 {
                margin-right: 20px !important;
            }


            /* 
                .dsply-no{
                   display: none;
                            }*/

            #ss_ctn_from {
                display: table;
                width: 100%;
                border-spacing: 25px;
            }

            #ss_ctn_from_left {
                display: table-cell;
                width: 50%;
            }

            .dsply-no {
                display: none !important;
            }

            #slct_cvlt {
                width: 145px;
            }

            input[type=date] {
                width: 150px;
            }

            .header {
                background-color: #2c0d84d9 !important;
                box-shadow: 1px 1px 3px #0c0b0d94;
            }



            #ctn_form_search {
                width: 500px !important;
            }

            #output {
                width: 100% !important;
            }

            /* configuration des fenêtres modales */
            .modal-header {
                padding: 0.5rem 0.5rem !important;
            }

            /*Réajustement de positionnement de la fenêtre modal au centre */
            #dialogInfo .modal-dialog {
                position: absolute;
                width: 100% !important;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            /*Ajustement modal-body*/

            .modal-body {
                padding: 2rem 1rem !important;
            }



            /*Ajustement sur le tableau de résultat*/

            #tbl_result tbody tr:hover {
                background-color: #fdd;
                transition-delay: 0s;
                transition-duration: 1s;
                transition-property: all;
            }

            #tbl_result tr {
                text-align: center;
                cursor: pointer;
            }


            /*Surcharge de la classe active*/
            .active {
                background-color: #bd0dfd !important;
            }


            #ss_ctn_from legend {
                text-align: center;
                text-transform: uppercase;
            }

            /**/
            .form-control:focus {
                box-shadow: none !important;
                border-color: silver;
            }

            /**/
            button.btn:focus {
                box-shadow: none !important;
                border-color: silver;
            }


            /*Ajust first li navbar*/

            ul.navbar-nav:first-child {
                padding: 0.65rem !important;
            }

            .navbar {
                padding: 0px;
            }

            /*Ajustement du ctn li de session*/
            #no_load {
                margin-left: 10px !important;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function() {

                /*===================================================
                 *    Fonction de soumission des données formulaire
                 ===================================================*/
                var ajaxOptions = {
                    method: "POST",
                    cache: false,
                    async: true,
                    timeout: 3000,
                    dataType: "json",
                    processData: false,
                    contentType: false
                };

                /***********************************************************************
                 *              Fonction reset form inscription
                 ***********************************************************************/
                function reset_form() {
                    $("#form_inscription")[0].reset();
                    //$("#bt_submit").prop({disabled: true});
                }


                let launchDialogInfo = function(elemetText) {
                    $("#dialogInfo div.modal-body").html(elemetText);
                    $("#btn_show_dialog_info").click();
                };

                /*
                 | -------------------------------------------------------------------
                 |  Fonction inscription : client
                 | -------------------------------------------------------------------
                 | Définition:
                 | Assure l'enregistrement des données
                 |
                 */
                function inscriptionClient() {
                    //Récupération du formulaire
                    var form = $("#form_inscription").get(0);
                    //Lecteur de la valeur de l'attribut action du formulaire
                    var url = form.getAttribute("action");
                    var formData = new FormData(form);
                    ajaxOptions.data = formData;
                    ajaxOptions.url = url;
                    $.ajax(ajaxOptions).done(function(clbck) {
                        if (clbck.err_flag) {
                            alert(clbck.err_msg);
                        } else {
                            let flag_response = "Les donnée ont été enregistrées!";
                            launchDialogInfo(flag_response);
                            reset_form();
                        }
                        dis_panel_flw();
                    }).fail(function(e) {
                        console.log(e);
                        alert("Error!");
                    }).always(function() {
                        //dis_panel_flw();
                    });
                }
                /*
                 | -------------------------------------------------------------------
                 |  Fonction de effacement : client
                 | -------------------------------------------------------------------
                 | Définition:
                 |
                 | Assure la ré-initialisation du tableau
                 |
                 */
                let resetBodyTableResultSearch = function() {
                    $("tbody[id='tbody_result'] tr").remove(".ajust");
                    $("tbody[id='tbody_result'] td").remove(".ajust");
                };

                var searchClient = function() {
                    resetBodyTableResultSearch();
                    var formSearch = $("#form_search")[0];
                    var url = formSearch.getAttribute('action');
                    if (parseInt(formSearch.elements["keyword"].value.length) >= 4) {
                        var formData = new FormData(formSearch);
                        ajaxOptions.data = formData;
                        ajaxOptions.url = url;
                        $.ajax(ajaxOptions).done(function(tab_acheteurs) {
                            resetBodyTableResultSearch();
                            if (tab_acheteurs) {
                                let response = "";
                                $("#tbl_result").removeClass("dsply-no").fadeIn("2000", function() {
                                    let dateAnniv = null;
                                    for (var index in tab_acheteurs) {
                                        $.datepicker.setDefaults($.datepicker.regional["fr"]);
                                        dateAnniv = $.datepicker.formatDate('dd-mm-yy', new Date(
                                            tab_acheteurs[index].dateAnniversaire));
                                        response += "<tr class='ajust'>\n\
                                                    <td>" + (parseInt(index) + 1) + "</td>\n\
                                                    <td>" + tab_acheteurs[index].nom + "</td>\n\
                                                    <td>" + tab_acheteurs[index].prenom + "</td>\n\
                                                    <td>" + tab_acheteurs[index].email + "</td>\n\
                                                    <td>" + tab_acheteurs[index].telephone + "</td>\n\
                                                    <td>" + dateAnniv + "</td>\n\
                                                </tr>";
                                    }
                                    $("tbody[id='tbody_result']").append(response);
                                });
                            } else {
                                launchDialogInfo("Aucun(s) résultat(s) trouvé(s)!");
                            }
                        }).fail(function() {
                            alert("Une erreur est survenue lors de l'envoie des données!");
                        }).always(function() {

                        });
                    } else {
                        launchDialogInfo("Votre saisie n'est pas correcte!");
                    }
                };


                //                $("#bt_act_inscription").click(function (e) {
                //                    e.preventDefault();
                //                    ajaxFonction();
                //                });

                /***********************************************************************
                 *              Fonction de soumission des données formulaire
                 ***********************************************************************/
                /**
                 * 
                 */
                $("#form_search").submit(function(e) {
                    e.preventDefault();
                    searchClient();

                });

                /*===================================================
                 *    Soumission des données formulaire inscription
                 ===================================================*/
                $("#form_inscription").submit(function(e) {
                    e.preventDefault();
                    inscriptionClient();

                });



                //                    function select_content_sctn(id_tab) {
                //                        $("section[id^='sctn_tab_']").stop(true, true).fadeOut("fast", function (e) {
                //                            $(this).css({"display": "none"});
                //                            $("section[id='sctn_tab_" + id_tab + "']").stop(true, true).fadeIn();
                //                        });
                //                    }


                function select_content_sctn(id_tab) {
                    $("section[id^='sctn_tab_']").addClass("dsply-no").stop(true, true).fadeOut("fast", function(e) {
                        $("section[id='sctn_tab_" + id_tab + "']").stop(true, true).removeClass("dsply-no")
                            .fadeIn();
                    });
                }

                $(" nav li.nav-item:not(li[id='no_load'])").click(function(e) {
                    e.preventDefault();
                    let id_tab = $(this).attr("data-sctn-id");
                    select_content_sctn(id_tab);
                });

                /*===================================================
                 *    Soumission des données formulaire inscription
                 ===================================================*/
                $("li a:not(a[id='navbarDropdown'])").click(function(e) {
                    e.preventDefault();
                    $("li a").removeClass("active");
                    $(this).addClass("active");
                    //                    if ($(this).hasClass("active")) {
                    //                        $("li a").removeClass("active");
                    //                        $(this).addClass("active");
                    //                    } else {
                    //                        $("li a").removeClass("active");
                    //                        $(this).addClass("active");
                    //                    }
                });



                /*===================================================
                 *    Logout  : Déconnexion de l'application
                 ===================================================*/
                $("li[id='btn_actn_logout'] ").click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "http://www.cakeorder.fr/application/controllers/compte.php",
                        method: "POST",
                        data: {
                            "action": "logout"
                        }
                    }).done(function(flag_rsp) {
                        window.location.replace("http://www.cakeorder.fr");
                    }).fail(function() {
                        launchDialogInfo("Une erreur est survenue lors de la requête de deconnexion!");
                    }).always(function() {

                    });
                });



            });
        </script>
    </head>

    <body>
        <div id="ctn_div_central">
            <header class="navbar navbar-expand-md navbar-dark header">
                <section class="navbar-brand">
                    <img src="">
                    <span id="" class="narbar-text ml-3">CAKEORDER ADMINER</span>
                </section>
                <section class="navbar ms-auto ">
                    <nav class="mr-2">
                        <ul class="navbar-nav nav-pills justify-content-center ">
                            <li data-sctn-id="1" class="nav-item">
                                <a class="nav-link " href="#">Dashboard</a>
                            </li>
                            <li data-sctn-id="2" class="nav-item">
                                <a class="nav-link " href="#">Commandes</a>
                            </li>
                            <li data-sctn-id="3" class="nav-item">
                                <a class="nav-link " href="#">Enregistrer</a>
                            </li>
                            <li data-sctn-id="4" class="nav-item">
                                <a class="nav-link " href="#">Rechercher</a>
                            </li>
                            <li class="nav-item dropdown" id="no_load">
                                <a class="nav-link bg-light dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="bg-light text-black p-1 rounded"><?= $_SESSION["nom_admin"] . " " . $_SESSION["prenom_admin"]; ?></span>
                                </a>
                                <ul id="menu_prcpl" class="dropdown-menu dropdown" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Paramètres</a></li>
                                    <li id="btn_actn_logout"><a class="dropdown-item" href="#">Déconnexion</a></li>
                                </ul>
                            </li>
                        </ul>

                    </nav>
                </section>
            </header>
            <main>
                <section class="dsply-no " data-sctn-id="3" id="sctn_tab_3">
                    <form id="form_inscription" action="http://www.cakeorder.fr/application/controllers/inscription.php" method="post" enctype="application/x-www-form-urlencoded">
                        <div id="ss_ctn_from">
                            <input type="hidden" name="action" value="inscription">
                            <div id="ss_ctn_from_left" class="p-3 bg-light border  rounded">
                                <legend class="border-bottom " style="width: 100%;">Données client</legend>
                                <div class="mb-2">
                                    <label class="form-label" for="nom_utlstr">Civilité</label>
                                    <select class="form-select" id="slct_cvlt">
                                        <option selected="selected">--- Choisir ---</option>
                                        <option value="masculin">Mr</option>
                                        <option value="feminin">Mme</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="nom_utlstr">Nom</label>
                                    <input class="form-control" type="text" id="nom_utlstr" name="nom_utlstr">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="prenom_utlstr">Prénom</label>
                                    <input class="form-control" type="text" id="prenom_utlstr" name="prenom_utlstr">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="email_utlstr">Email</label>
                                    <input class="form-control" type="text" id="email_utlstr" name="email_utlstr">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="telephone_utlstr">Téléphone</label>
                                    <input class="form-control" type="text" id="telephone_utlstr" name="telephone_utlstr">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="dateAnniversaire_utlstr">Date anniversaire</label>
                                    <input class="form-control" type="date" id="dateAnniversaire_utlstr" name="dateAnniversaire_utlstr">
                                </div>
                                </fieldset>
                            </div>
                            <div id="ss_ctn_from_right" class="p-3 bg-light border  rounded">
                                <legend class="border-bottom">Adresse client</legend>
                                <div class="mb-2">
                                    <label class="form-label" for="numVoie_utlstr">Numero de voie</label>
                                    <input class="form-control" type="text" id="numVoie_utlstr" name="numVoie_utlstr">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="libelleVoie_utlstr">Libelle de voie</label>
                                    <input class="form-control" type="text" id="libelleVoie_utlstr" name="libelleVoie_utlstr">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="codePostal_utlstr">Code postal</label>
                                    <input class="form-control" type="text" id="codePostal_utlstr" name="codePostal_utlstr">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="ville_utlstr">Ville</label>
                                    <input class="form-control" type="text" id="ville_utlstr" name="ville_utlstr">
                                </div>
                            </div>
                            <div class="mt-4">
                                <input class="btn btn-primary btn-lg ms-auto" type="submit" value="S'inscrire">
                            </div>
                        </div>

                    </form>
                </section>
                <section class="dsply-no" data-sctn-id="4" id="sctn_tab_4">
                    <div id="ctn_form_search" class="mx-auto">
                        <form name="form_search" id="form_search" action="http://www.cakeorder.fr/application/controllers/client.php" method="POST" enctype="application/x-www-form-urlencoded">
                            <input type="hidden" name="action" value="rechercher">
                            <div class="input-group">
                                <input class="form-control w-25 " type="search" id="keyword" name="keyword">
                                <button class="btn btn-secondary btn-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <output id="output" class="mt-4">
                        <table id="tbl_result" class="table table-striped dsply-no">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Anniversaire</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_result"></tbody>
                        </table>
                        <div></div>
                    </output>
                </section>

        </div>
        <div class="mt-4">
            <input class="btn btn-primary btn-lg ms-auto" type="submit" value="valide">
        </div>
        </form>
        </section>
        <!-- section catalogue  -->
        <section>
            <form id="form_saisie" action="http://www.cakeorder.fr/application/controllers/catalogue.php" method="post" enctype="application/x-www-form-urlencoded">
                <div class="mb-2">
                    <label class="form-label" for="reference_cake">reference_cake</label>
                    <input class="form-control" type="text" id="reference_cake" name="reference_cake">
                </div>
                <div class="mb-2">
                    <label class="form-label" for="denomination_cake">denomination_cake</label>
                    <input class="form-control" type="text" id="denomination_cake" name="denomination_cake">
                </div>
                <div class="mb-2">
                    <label class="form-label" for="description_cake">description_cake</label>
                    <input class="form-control" type="text" id="description_cake" name="description_cake">
                </div>
                <div class="mb-2">
                    <label class="form-label" for="prixUnitaire_cake">prixUnitaire_cake</label>
                    <input class="form-control" type="text" id="telephone_utlstr" name="telephone_utlstr">
                </div>
        </section>
        <!-- fin section catalogue -->
        </main>
        </div>
        <!-- Start Popupmodal infos -->
        <span id="btn_show_dialog_info" data-bs-toggle="modal" data-bs-target="#dialogInfo"></span>
        <div id="dialogInfo" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <div class="lead modal-title">Informations</div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        <!-- Stop Popupmodal infos -->
    </body>

    </html>

<?php
else :
    Route::defaultRedirection();
endif;
?>