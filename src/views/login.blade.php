<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>{{trans("crudbooster.page_title_login")}} : {{Session::get('appname')}}</title>
    <meta name='generator' content='CRUDBooster' />
    <meta name='robots' content='noindex,nofollow' />
    <link rel="shortcut icon"
        href="{{ CRUDBooster::getSetting('favicon')?asset(CRUDBooster::getSetting('favicon')):asset('vendor/crudbooster/assets/logo_crudbooster.png') }}">

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{asset('vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"
        type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css')}}" rel="stylesheet"
        type="text/css" />

    <!-- support rtl-->
    @if (in_array(App::getLocale(), ['ar', 'fa']))
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
    <link href="{{ asset("vendor/crudbooster/assets/rtl.css")}}" rel="stylesheet" type="text/css" />
    @endif

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link rel='stylesheet' href='{{asset("vendor/crudbooster/assets/css/main.css")}}' />
    <style type="text/css">
        .login-page,
        .register-page {
            background-image:url({{url('vendor/crudbooster/assets/background.jpg')}}) !important;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .login-box,
        .register-box {
            margin: 2% auto;
        }

        .login-box-body {
            box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.8);
            background: rgba(255, 255, 255, 0.9);
            color: #666666 !important;
            margin: 0 14px;
            border-radius: 5px;
        }

        html,
        body {
            overflow: hidden;
        }

        .btn-primary {
            background: #ff9f3f !important;
        }

        .newlink {
            text-align: center;
            border: #367fa9;
        }

        .newlink a {
            color: #fff;
        }

        .login-logo,
        .register-logo {
            font-size: 35px;
            text-align: center;
            margin-bottom: 9px;
            font-weight: 300;
            width: 100%;
            margin-top: 20px;
        }

        .mt-65 {
            margin-top: 65px;
        }

        .social-auth-links {
            margin: 5px 52px;
            padding-top: 256px;
            height: 100vh;
        }

        .newlink ul li {
            list-style: none;
            float: left;
            width: 50%;
            text-align: center;
            line-height: 11px;
            background: gray;
            padding: 10px 0;
        }

        .newlink ul li a:hover {
            color: #FF9F3F;
            transition: .5s;
        }

        .footer {
            background: #f39c12;
            color: #fff;
            padding: 10px 30px;
            position: absolute;
            content: '';
            bottom: 0;
            width: 100%;
            left: 0;
        }

        .login-footer-text a {
            font-size: 16px;
            line-height: 22px;
            color: #fff;
            font-weight: 500;
            padding: 0 10px;
        }

        .btn-orange {
            background-color: #f39c12;
            color: #fff;
            box-shadow: 0 3px 4px 0 rgba(0, 0, 0, .14), 0 3px 3px -2px rgba(0, 0, 0, .2), 0 1px 8px 0 rgba(0, 0, 0, .12) !important;
            transition: .5s;
        }

        .btn-orange:hover {
            background: #e89716;
            border: 1px solid #F39C12;
            color: #fff;
            transition: .5s;
        }

        .login-box-msg,
        .register-box-msg {
            padding: 0 20px 10px 20px !important;
        }

        .alert {
            margin-bottom: 8px;
        }

        #terms_and_condition_modal .modal-body,
        #impressum_modal .modal-body,
        #data_protection_modal .modal-body {
            color: #222;
            position: relative;
            max-height: 448px;
            overflow: hidden;
            width: 100%;
            overflow-x: hidden;
            overflow-y: auto;
        }

        #terms_and_condition_modal .modal-footer,
        #impressum_modal .modal-footer,
        #data_protection_modal .modal-footer {
            border-top: 1px solid #f39c12 !important;
        }

        #terms_and_condition_modal .modal-header .close span,
        #impressum_modal .modal-header .close span,
        #data_protection_modal .modal-header .close span {
            position: relative;
            top: -18px;
            border: 3px solid #fff;
            padding: 1px 10px;
            color: #fff;
        }

        #impressum_modal button:focus,
        #terms_and_condition_modal button:focus,
        #data_protection_modal button:focus {
            outline: none;
        }

        .login-footer-text span {
            cursor: pointer;
        }

        .login-footer-text span:hover {
            text-decoration: underline;
            transition: .5s;
        }

        .btn-social {
            color: #fff !important;
            text-decoration: none !important;
        }
    </style>
</head>

<body class="login-page">
    <section class="login-page-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-logo">
                        <a href="{{url('/')}}">
                            <img title='{!!(Session::get(' appname')=='CRUDBooster'
                                )?"<b>CRUD</b>Booster":CRUDBooster::getSetting('appname')!!}'
                            src='{{ CRUDBooster::getSetting("logo")?asset(CRUDBooster::getSetting('logo')):asset('vendor/crudbooster/assets/logo_crudbooster.png') }}'
                            style='max-width: 100%;max-height: 120px;'/>
                        </a>
                    </div><!-- /.login-logo -->
                    <div class="login-box-body">

                        @if ( Session::get('message') != '' )
                        <div class='alert alert-warning'>
                            {{ Session::get('message') }}
                        </div>
                        @endif

                        @if ( Session::get('msg') != '' )
                        <div class='alert alert-info'>
                            {{ Session::get('msg') }}
                        </div>
                        @endif

                        <p class='login-box-msg'>Logge dich hier ein</p>
                        <form autocomplete='off' action="{{ route('postLogin') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="form-group has-feedback">
                                <input autocomplete='off' type="text" class="form-control" name='email' required
                                    placeholder="Email" />
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input autocomplete='off' type="password" class="form-control" name='password' required
                                    placeholder="Passwort" />
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div style="margin-bottom:10px" class='row'>
                                <div class='col-xs-12'>
                                    <button type="submit" class="btn btn-orange btn-block btn-flat"> Anmelden</button>
                                </div>
                            </div>
                        </form>


                        <!--<div class='newlink'>-->
                        <!--    <ul style="padding-left: 0;">-->
                        <!--        <li><a href="{{url('page/impressum')}}" target="_new">Impressum</a></li>-->
                        <!--        <li><a href="{{url('page/agb')}}" target="_new">AGB</a></li>-->
                        <!--    </ul>-->
                        <!--</div>-->

                        <!--a href="#">I forgot my password</a-->
                        <div class="text-center">
                            <p>- Oder -</p>
                            <a href="{{ url('/auth/redirect/facebook') }}"
                                class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i>
                                Melde dich mit Facebook an</a>
                            <a href="{{ url('/auth/redirect/linkedin') }}"
                                class="btn btn-block btn-social btn-linkedin"><i class="fa fa-linkedin"></i> Melde dich
                                mit LinkedIn an </a>
                            <a href="{{ url('/auth/redirect/google') }}" class="btn btn-block btn-social btn-google"><i
                                    class="fa fa-google"></i>Melde dich mit Google an</a>
                        </div>

                        <div class='row' style="margin-top:5px;">
                            <div class='col-xs-6' align="center">
                                <p style="margin-bottom:0px;line-height: 17px;">Du hast dein Passwort vergessen ?<a
                                        href='{{route("getForgot")}}'> Klicke hier</a></p>
                            </div>
                            <div class='col-xs-6' align="center">
                                <p style=""><a href='{{ url('registration/sign-up') }}'>Erstelle einen Account</a>
                                </p>
                            </div>
                        </div>
                    </div><!-- /.login-box-body -->

                </div>
            </div>
        </div>
    </section>

    <section class="footer-section">
        <div class="footer">
            <div class="row">
                <div class="col-md-12 pl-0 pr-0">
                    <div class="login-footer-text">
                        <span id="impressum" style="padding-right: 5px;">IMPRESSUM</span> |
                        <span id="terms_condition" style="padding-left: 5px; padding-right: 5px;">AGB</span> |
                        <span id="data_protection" style="padding-left: 5px;">Datenschutzerklärung</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.login-box -->


    @php
    $pages = DB::table('drm_pages')->get();
    @endphp


    <!-- Modal Terms And Condition-->
    <div class="modal fade" id="terms_and_condition_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #f39c12;color: #fff;">
                    <h5 class="modal-title">AGB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($pages as $page)
                    @if($page->id == 4)
                    {!!$page->page_content!!}
                    @endif
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-orange" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal IMPRESSUM-->
    <!--<div class="modal fade" id="impressum_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--  <div class="modal-dialog" role="document">-->
    <!--    <div class="modal-content">-->
    <!--      <div class="modal-header" style="background: #f39c12;color: #fff;">-->
    <!--        <h5 class="modal-title">Privacy Policy</h5>-->
    <!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
    <!--          <span aria-hidden="true">&times;</span>-->
    <!--        </button>-->
    <!--      </div>-->
    <!--      <div class="modal-body">-->
    <!--        <h5><b>ALLGEMEINE GESCHÄFTSBEDINGUNGEN</b></h5><br/>-->
    <!--            <b>-->
    <!--            1. Allgemeines-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Diese Allgemeinen Geschäftsbedingungen gelten für sämtliche Module der Software Dropshipping Resource Management (im Folgenden DRM), an der EXPERTISEROCKS sämtliche Nutzungsrechte innehat.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. DRM ist eine cloudbasierte Software, bei der ein Händler im Rahmen eines sogenannten Dropshipping – Geschäfts die Möglichkeit hat, mit seinen Lieferanten in der Form zu kommunizieren, dass dieser seine aktuellen Lagerbestände in das DRM einpflegen kann. Der Händler kann damit auch mehrere Onlineshops und Angebote auf anderen Verkaufsplattformen wie bspw. AMAZON und eBay gleichzeitig verwalten. Über DRM besteht auch die Möglichkeit einer Anbindung zum ECommerce Automatisierungsdienstleister LENGOW, der Produkte automatisiert auf anderen Plattformen listet.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Die Software DRM ist modular aufgebaut. Im Einzelnen ergibt sich der Leistungsumfang der lizenzierten Software aus der Leistungsbeschreibung der einzelnen lizenzierten Module.-->
    <!--            </P>-->
    <!--            <b>-->
    <!--            1. Lizenz und Lizenzgegenstand -->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. EXPERTISEROCKS überlässt dem Händler ein einfaches, nicht ausschließliches, nicht übertragbares, zeitlich auf die Vertragsdauer begrenztes Nutzungsrecht an der DRM Software für einen Arbeitsplatz (Lizenz). Weitere Arbeitsplätze erfordern zusätzliche Lizenzen).-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Die Übermittlung der Daten vom DRM zu und von den Verkaufsplattformen und verbundenen Shops erfolgt nur bei solchen Systemen, bei denen der Händler sich zur Vermittlung registriert hat und die das DRM als Schnittstelle gemäß Leistungsbeschreibung unterstützt.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Das DRM sieht keine Funktionalität vor, die darauf gerichtet ist, Verpflichtungen wie bspw. Verhaltenskodizes von mit DRM verbundenen Onlineplattformen (Marktplätze) und Shop-Systemen (Onlineshops) einzuhalten oder dort entstehende Gebühren zu entrichten. Zudem enthält DRM keine Funktionalität, die die Vollständigkeit, Richtigkeit, Rechtmäßigkeit und Aktualität der vom Händler übermittelten Daten überprüft.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            4. Der Leistungsumfang kann entgegen der Beschreibung eingeschränkt sein, wenn die Technik der Drittsysteme nicht entsprechend ausgelegt ist.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            - Vertragsschluss-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Voraussetzung für die Nutzung des DRM ist eine Anmeldung durch den Händler. Die Anmeldung erfolgt durch eine Registrierung auf der Website <a href="https://www.drm.software" target="_blank">https://www.drm.software</a> oder einer der gelabelten Registrierungsseiten.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Der Händler erklärt durch Ausfüllen und Versenden des Registrierungsformulars gegenüber Expertiserocks verbindlich, ein Nutzungsrecht an den ausgewählten DRM Softwaremodulen, zu den unter <a href="https://www.drm.software" target="_blank">https://www.drm.software</a> dargestellten Tarifen und Laufzeiten erwerben zu wollen. Der Versand des Registrierungsformulars stellt seitens des Händlers ein Angebot zum Abschluss eines Lizenzvertrages dar.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Das Registrierungsformular ist in den Sprachen Deutsch, Englisch und Spanisch verfügbar. Vor Versenden des Registrierungsformulars erscheinen alle Eingaben noch einmal in einem Bestätigungsfenster und können dort korrigiert werden.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            4. Wenn der Händler von EXPERTISEROCKS eine Email erhält, mit der EXPERISEROCKS erklärt, dass sie das Vertragsangebot annimmt, kommt der Vertrag zustande. Händlern, die bereits Lizenznehmer von DRM waren, erhalten eine Email vom Zahlungsdienstleisters Digistore24 mit einer Zahlungsaufforderung für die erste Monatsgebühr.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            5. Der Vertrag wird von EXPERTISEROCKS gespeichert und steht dem Händler unter seinem Kundenaccount auch zum Download zur Verfügung.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            6. Händler, die noch nicht Lizenznehmer von DRM waren bzw. Nutzer von Beta Versionen erhalten Zugangsdaten in Form eines Benutzernamen per Email und ein dynamisch erzeugtes Passwort per SMS auf das Mobiltelefon.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            7. Händler, die bereits Lizenznehmer von DRM waren, weil Sie bereits über einen 21 tägigen Testzugang verfügten, erhalten nach Zahlung der ersten Monatsgebühr über den Zahlungsdienstleister Digistore24, Zugangsdaten in Form eines Benutzernamens per Email und ein dynamisch erzeugtes Passwort per SMS auf das Mobiltelefon.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            1. Abonnement von Beta-Services -->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Bestimmte DRM Softwaremodule können als geschlossene oder offene Beta-Services ("Beta-Service" bzw. “Beta-Services”) angeboten werden, die zu Test- und Bewertungszwecken dienen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Der Händler stimmt zu, dass die Festlegung des Zeitraums zum Testen und Bewerten der Beta-Services im alleinigen Ermessen von EPERTISEROCKS liegt. EPERTISEROCKS ist der alleinige Entscheidungsträger bei der Bestimmung über den Erfolg des Tests und der Entscheidung, ob die Beta-Services nachfolgend als kommerzielle Services angeboten werden. Die Teilnahme an einem Beta-Service verpflichtet den Händler nicht zum Abschluss eines Abonnements oder zur Nutzung eines zahlungspflichtigen Services. EPERTISEROCKS behält sich das Recht vor, Beta-Services mit oder ohne Ankündigung jederzeit und von Zeit zu Zeit vorübergehend oder dauerhaft ganz oder teilweise einzustellen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Der Händler stimmt zu, dass Expertiserocks nicht für Schäden haftbar ist, die durch die Änderung, Aussetzung oder Einstellung eines Beta-Services aus einem beliebigen Grund entstanden sind.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            1. Identifikation und Authentifikation-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Die übermittelten Zugangsdaten zur DRM-Nutzung dienen der Identifikation und Authentifikation. Dem Händler ist es nicht gestattet, diese Zugangsdaten unberechtigten Dritten zu überlassen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Der Händler muss dann seinen Benutzernamen und das per SMS erhaltene Passwort auf der Website https://www.drm.software eingeben, um sich zu authentifizieren und sich in seinem Kundenaccount einzuloggen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Expertiserocks haftet nicht für Schäden, die aus der missbräuchlichen Verwendung der Zugangsdaten entstehen.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            1. Testzeitraum, Abrechnung, Fälligkeit der Gebühren-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Der kostenlose Testzeitraum beginnt mit dem Tag des Zugangs der Zugangsdaten für den Kundenaccount und beträgt 21 Tage.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Innerhalb des kostenlosen Testzeitraums kann der Händler jederzeit zum Ende des Testzeitraums kündigen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Der kostenlose Testzeitraum gilt nur für Neukunden. Meldet sich ein Händler erneut an, beginnt die Vertragslaufzeit gemäß dem ausgewählten Tarif ab dem Zeitpunkt des Zugangs der Zugangsdaten für den Kundenaccount-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            4. Verstreicht der kostenlose Testzeitraum ohne Kündigung, werden die Leistungen aus dem Vertrag gemäß ausgewähltem Tarif und Laufzeit kostenpflichtig und der Händler erhält eine Email des Zahlungsdienstleisters Digistore24 mit einer entsprechenden Abrechnung der Gebühr für den verbleibenden Zeitraum des Kalendermonats. Diese Gebühr wird an dem Tag fällig, der auf den letzten Tag des kostenlosen Testzeitraums folgt.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            Im Übrigen wird die erstmalig zu entrichtende Monatsgebühr, an dem Tag fällig, an dem dem Händler die Annahmeerklärung von EXPERTISEROCKS und eine Rechnung des Zahlungsdienstleisters Digistore24 zugeht. In der Folge werden die monatlich abzurechnenden Gebühren jeweils am ersten eines Kalendermonats fällig. Der Zahlungsdienstleisters Digistore24 wird dem Händler zum jeweils 1. eines Monats eine entsprechende Abrechnung per Email zukommen lassen.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            - Tarif und Tarifwechsel-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Es gelten jeweils die in dem Registrierungsformular aufgeführten Tarife. Die jeweiligen Tarife inkludieren die, in dem jeweils gültigen Leistungsverzeichnis beschriebene Anzahl an Artikel Uploads und Bestellimporten (Inklusiv Transfers), sowie die anfallenden Gebühren für Einzel-Artikel-Uploads und Bestellimporte bei Überschreiten der vorgesehenen Anzahl an Inklusiv-Transfers.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Ein vom Händler gewünschter Tarifwechsel in einen höheren Tarif oder Hinzufügen weiterer Online-Verkaufsplattformen kann jederzeit im laufenden Monat mit Rückwirkung zum Beginn des laufenden Kalendermonats erfolgen. Eine Tarifanpassung ist maximal einmal je Abrechnungsmonat möglich.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Ein Tarifwechsel in einen günstigeren Tarif ist nur unter Einhaltung einer Kündigungsfrist von drei Monaten zum Monatsende möglich.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            4. Der Tarifwechsel kann vom Händler über seinen Kunden-Login, aber auch per E-Mail (auch gegenüber Digistore24) beantragt werden.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            - Zahlungsabwicklung-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Sämtlicher Zahlungsverkehr wird von Digistore24 abgewickelt. Anderweitige Zahlungen können nicht verarbeitet werden.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Die von Digistore24 in Rechnung gestellten Nutzungsgebühren und Entgelte werden für Händlern mit einer Bankverbindung in der EU ausnahmslos im SEPA-Basis-Lastschriftverfahren eingezogen oder mittels PayPal bzw. einer Kreditkarte des Händlern belastet. Der Händler kann die bevorzugte Zahlmethode in seinem Bestellprozess gegenüber dem Zahlungsdienstleisters Digistore24 hinterlegen und auswählen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Händler, die nicht über eine Bankverbindung in der EU verfügen, können ausschließlich mittels hinterlegter Kreditkarte oder PayPal via Digistore24 bezahlen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            4. Die Rechnungen werden ausschließlich als PDF-Datei in elektronischer Form an die vom Händler angegebene E-Mail-Adresse vom Zahlungsdienstleister Digistore24 versandt. Für die Anforderung von Belegkopien wendet sich der Händler an den Zahlungsdienstleister direkt.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            5. Entstehende Bankgebühren durch Rücklastschriften, gleich welcher Art, werden dem Händlern pauschal mit 10 EUR in Rechnung gestellt.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            6. Wird eine Lastschrift durch den Händler widerrufen, wird das Lastschriftverfahren beendet, bis er einem erneuten Lastschriftverfahren auf schriftlichem Wege wieder zustimmt. Gleiches gilt, wenn eine Lastschrift auch nach dem zweiten Abbuchungsversuch erfolglos bleibt – egal welche Gründe dazu vorliegen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            7. Die Rechnung gilt als anerkannt, wenn keine Einwände innerhalb einer Ausschlussfrist von 7 Tagen nach Erhalt schriftlich gegenüber Digistore24 geltend gemacht werden.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            8. Berechtigte Einwände in der Rechnung werden dem Händler von Digistore24 gutgeschrieben oder mit folgenden Gebühren verrechnet.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            9. Eine Aufrechnung von Forderungen von Expertiserocks durch den Händler kann nur mit rechtskräftig festgestellten Forderungen erfolgen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            10. Bei Zahlungsverzug von mehr zwei Monatsgebühren oder bei ausdrücklicher Zahlungsverweigerung ist Expertiserocks berechtigt, weitere Leistungen einzustellen und sämtliche Schnittstellen zu sperren, sowie Listings auf sämtlichen Marketplaces und Onlineshops zu löschen, bis die offenen Forderungen vollständig beglichen sind. Expertiserocks weist mit einer ausreichenden Frist von 7 Tagen auf die Sperrung und Löschung hin. Das Recht zur außerordentlichen Kündigung bleibt unberührt.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            11. Alle Preise verstehen sich netto und zzgl. gültiger Umsatzsteuer. Die Eingabe einer (sofern vorhandenen) gültigen Umsatzsteuernummer muss direkt bei Zahlungsdienstleister Digistore24 erfolgen.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            1. Pflichten und Obliegenheiten des Händlern-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Der Händler hat Expertiserocks bei Veränderung seiner bei Anmeldung hinterlegter Daten unverzüglich zu informieren und die neuen Daten in seinem Kundenaccount oder per E-Mail bekannt zu geben. Etwaige Änderungen sind auch gegenüber dem Zahlungsdienstleister Digistore24 anzugeben.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Der Händler verpflichtet sich, über das DRM keine strafrechtlich relevanten Inhalte zu übermitteln, oder Rechte Dritter zu verletzen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Der Händler hat nach jedem Zugriff auf sein Kundenaccount ein Backup seiner Daten zu erstellen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            4. Etwaige Mängel hat der Händler unverzüglich anzuzeigen und Expertiserocks bei der Mängelanalyse und Mängelbeseitigung in angemessener Weise zu unterstützen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            5. Der Händler verhindert den unbefugten Zugriff Dritter auf das DRM und verpflichtet auch seine angestellten und freien Mitarbeiter und sonstigen Dienstleister zur Einhaltung dieser Pflicht.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            6. Für die Vollständigkeit, Richtigkeit, Rechtmäßigkeit und Aktualität sämtlicher vom Händler übermittelter und verwendeter Daten, insbesondere der Produkte, Preise, Preisgrenzen und Preiskalkulationen, ist ausschließlich der Händler selbst verantwortlich.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            7. Die Abwicklung und ggf. Rückabwicklung der auf den Handelsplattformen geschlossenen Verträge ist alleinige Angelegenheit des Händlers.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            1. Laufzeit des Vertrages, Kündigung-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Das Vertragsverhältnis beginnt mit dem Tag des Zugangs der Zugangsdaten für den Kundenaccount.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Ordentliche Kündigung und Kündigungsfristen-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            1. Es gelten folgende Kündigungsfristen:-->
    <!--            </b>-->
    <!--            <b>-->
    <!--            1. Bei einer gewählten Laufzeit von einem Monat kann der Vertrag jeweils zum Ende des Folgemonats gekündigt werden.-->
    <!--            </b>-->
    <!--            <b>-->
    <!--            1. Bei einer gewählten Laufzeit von sechs Monaten kann der Vertrag mit einer Frist von einem Monat zum Ende des sechsten Monats nach Beginn der Vertragslaufzeit gekündigt werden.-->
    <!--            </b>-->
    <!--            <b>-->
    <!--            12. Bei einer gewählten Laufzeit von zwölf 12 Monaten kann der Vertrag mit einer Frist von drei Monaten zum Ende des 12. Monats nach Beginn der Vertragslaufzeit gekündigt werden.-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            24. Bei einer gewählten Laufzeit von zwölf 24 Monaten kann der Vertrag mit einer Frist von 6 Monaten zum Ende des 24. Monats nach Beginn der Vertragslaufzeit gekündigt werden.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Der Vertrag verlängert sich stillschweigend um die gewählte Laufzeit, wenn er nicht wirksam zum Vertragsende gekündigt wird.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Die Kündigung kann vom Händler über seinen Kundenaccount, aber auch über E-Mail gegenüber Expertiserocks oder dem Zahlungsdienstleister Digistore24 ausgesprochen werden.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Um ungewollte Löschungen zu vermeiden, erhält der Händler nach Eingang der Kündigung einen Hinweis per E-Mail, dass die Kündigung zur Löschung der über das DRM in die Shops eingestellten Produkte und den mit dem Benutzerkonto verknüpften Daten führt. Der Händler muss per Email oder einen Link bestätigen, dass die über das DRM in die Shops eingestellten Produkte und die verknüpften Daten gelöscht werden, damit die Kündigung wirksam wird.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Soweit der Händler selbst zur Löschung von Produktangeboten auf mit dem DRM verknüpften Plattformen verpflichtet ist gilt die Kündigung als zurückgenommen, wenn die über das DRM auf Onlineshops und Marktplätzen eigestellten Produkte nicht einer Frist von 7 Tagen von den Onlineshops oder Marktplätzen gelöscht werden.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            3. Außerordentliche Kündigung-->
    <!--            </b>-->
    <!--            <p>-->
    <!--            EPERTISEROCKS kann den Vertrag fristlos kündigen, wenn-->
    <!--            </p>-->
    <!--            <p>-->
    <!--            1. der Händler mit der Zahlung von mehr als mehr zwei Monatsgebühren in Verzug gerät,-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. der Kundenaccount für einen Zeitraum von 120 Tagen inaktiv war. Zur Berechnung der Inaktivitätsdauer gilt jeder Service als unabhängiger und separater Service. Ein Service versteht sich als Leistungsmodul, ein Beispiel hierzu: Der Repricer versteht sich als ein eigener Service, da als optionales Modul buchbar. Eine Aktivität in einem solchen Servicemodul reicht daher nicht aus, um eine Kündigung eines Benutzerkontos für einen anderen Service zu vermeiden. Falls der Händler über einen DRM-Account mit mehreren Benutzern verfügen, gilt das Konto als aktiv, sofern mindestens ein Benutzer aktiv ist.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            4. Vertragsabwicklung bei Kündigung-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Zum Ende des Vertragsverhältnisses werden sowohl die über das DRM auf entsprechende Marketplaces und Shops eingestellten Produkte aus den Marktplaces und Shops als auch alle mit dem betreffenden Benutzerkonto verknüpften Daten gelöscht. Im Falle einer außerordentlichen fristlosen Kündigung durch EPERTISEROCKS hat der Händler ab Zugang der Kündigung eine Frist von 7 Tagen seine mit dem betreffenden Benutzerkonto verknüpften Daten zu sichern.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Sollte EXPERTISEROCKS keinen Zugang mehr zum Löschen über das DRM auf entsprechende Marketplaces und Shops eingestellten Produkte haben, ist der Händler verpflichtet, diese Bestände bis zum Ende des Vertragsverhältnisses aus dem jeweiligen Marketplace sowie Shops zu entfernen. Im Falle einer fristlosen Kündigung durch EPERTISEROCKS hat der Händler ab Zugang der Kündigung eine Frist von 7 Tagen über das DRM auf entsprechende Marketplaces und Shops eingestellte Produkte zu löschen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Zwei Wochen nach Beendigung des Vertrages (etwa aufgrund von Kündigung oder mangels Verlängerung) kann EPERTISEROCKS sämtliche Daten des Händlers löschen.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            1. Datenschutz, Datenverarbeitung-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Über die Software DRM werden von EXPERTISEROCKS personenbezogene Daten der Händlern und Lieferanten der Händler erhoben. Auf Verlangen des Händlers wird EXPERTISEROCKS eine DSGVO konforme Vereinbarung zur Auftragsverarbeitung abschließen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Expertiserocks ist berechtigt, Inhalte des Accounts ausschließlich zum Zwecke der Bereitstellung der Services an den Händler abzurufen, zu kopieren, zu verteilen, zu speichern, zu übertragen, neu zu formatieren, öffentlich anzuzeigen und öffentlich auszuführen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Der Händler willigt ein, dass EXPERTISEROCKS Zahlen wie Gesamtumsatz, durchschnittlicher Verkaufspreis, Anzahl der Bestellungen, Verkaufter Artikel und Menge etc. – jedoch ohne Kundendaten wie Adresse oder Mailadresse - anonymisiert für statistische interne Zwecke auswerten darf. Auf Grundlage dieser Angaben ist es EXPERTISEROCKS möglich, das Angebot weiter zu verbessern.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            - Softwareaktualisierung-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Bei Änderung der über DRM angebundenen Drittsysteme oder bei Gesetzesänderungen, die Anpassungen erforderlich machen um das DRM lauffähig und rechtskonform zu halten oder um den Marktbedürfnissen Rechnung zu tragen, behält sich EXPERTISEROCKS vor, Aufwandspauschalen von maximal 180,00 EUR zzgl. gesetzlicher MwSt. pro Jahr und pro angebundenem Marktplatz zu berechnen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Der Händler kann für den Fall, wenn Anpassungen zu einer geänderten Technik nicht innerhalb von einem Monat von Expertiserocks bereitgestellt werden, den Vertrag zum Ende des Kalendermonats kündigen, der auf den Monat folgt, in dem die Änderungen vom Drittanbieter veröffentlicht wurden.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            - Gewährleistung, Haftung-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Expertiserocks gewährleistet die Aufrechterhaltung der vertraglich vereinbarten Beschaffenheit der DRM Software während der Vertragslaufzeit sowie, dass einer vertragsgemäßen Nutzung der Software keine Rechte Dritter entgegenstehen. Expertiserocks wird auftretende Sach- und Rechtsmängel an der DRM Software in angemessener Zeit beseitigen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. EXPERTISEROCKS haftet für Schäden gleich aus welchem Rechtsgrund nur bei Vorsatz und grober Fahrlässigkeit. EXPERISEROCKS haftet ferner für die fahrlässige Verletzung von wesentlichen Vertragspflichten (Kardinalpflichten), d. h. solchen Pflichten, deren Verletzung die Erreichung des Vertragszwecks gefährdet und auf deren Einhaltung ein Vertragspartner regelmäßig vertrauen darf. Im Fall der fahrlässigen Verletzung von Kardinalspflichten haftet EXPERTISEROCKS jedoch nur für den bei Vertragsschluss vorhersehbaren, vertragstypischen Schaden. Ein Ausschluss oder eine Begrenzung der Haftung von EXPERTISEROCKS wirkt auch für die persönliche Haftung ihrer gesetzlichen Vertreter, Angestellten und sonstigen Erfüllungsgehilfen. Die vorstehenden Haftungsbeschränkungen gelten nicht bei der Verletzung von Leben, Körper und Gesundheit, Arglist, Fehlen einer zugesicherten Eigenschaft oder einer ausdrücklichen Garantieübernahme. Die Haftung nach dem Produkthaftungsgesetz bleibt ebenfalls unberührt. Die Haftung für Datenverlust wird auf den typischen Wiederherstellungsaufwand beschränkt, der bei regelmäßiger und gefahrenentsprechender Anfertigung von Sicherungskopien eingetreten ist.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            - Änderung der AGB und Tarife-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Sollten wirtschaftliche oder rechtliche Gründe dies erfordern, ist Expertiserocks berechtigt, diese AGB jederzeit zu ändern. Die Änderungen erfolgen unter Abwägung der Interessen beider Vertragsparteien und werden dem Händler unverzüglich elektronisch per Email oder in seinem Kundenaccount mitgeteilt. Der Händler hat die Möglichkeit den Vertrag innerhalb von 14 Tagen nach Mitteilung zu zum Ende des laufenden Kalendermonats zu kündigen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Expertiserocks behält sich ferner das Recht vor, jederzeit die Tarife anzupassen oder für bislang kostenlose Services Gebührenverlangen (Tarifänderung). Im Fall einer Tarifänderung wird Expertiserocks den Händlern hierüber binnen vier Wochen vor Wirksamwerden der Tarifänderung elektronisch per Email oder in seinem Kundenaccount Der Händler hat das Recht, den Vertrag binnen 14 Tagen ab Zugang der Mitteilung der Tarifänderung zum Monatsende zu kündigen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Macht der Händler von diesem außerordentlichen Kündigungsrechten keinen Gebrauch, gilt die Tarifänderung bzw. Änderung der AGB als vereinbart.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            4. Expertiserocks behält sich ferner das Recht vor, jederzeit neue Leistungen optional anzubieten oder bestehende Leistungspakete anzupassen. Sofern daraus keine Preiserhöhung resultiert, verstehen sich zusätzliche kostenlose Features als angenommen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            5. Das DRM versteht sich aus Cloudlösung, es wird daher stets immer die aktuellste Version ausgespielt. Für ein Update bedarf es keiner expliziten Zustimmung eines einzelnen Händlers. Expertiserocks ist berechtigt, den Inhalt der Leistungen einschließlich der bereitgestellten Software zu verändern und anzupassen, insbesondere bei technologischen Weiterentwicklungen.-->
    <!--            </p>-->
    <!--            <b>-->
    <!--            1. Schlussbestimmungen-->
    <!--            </b>-->
    <!--            <p style="text-align: justify;">-->
    <!--            1. Individuelle Vereinbarungen, die diese AGB ändern oder abbedingen bedürfen der Schriftform. Dies gilt auch für die Änderung dieser Klausel.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            2. Diesen AGB widersprechende AGB werden durch EXPERTISEROCKS nicht angenommen.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            3. Sollten eine oder mehrere Regelungen dieser AGB unwirksam sein oder werden, so berührt dies nicht die Wirksamkeit der übrigen Klauseln, bzw. des Vertrages. An die Stelle der unwirksamen Regelung tritt die einschlägige gesetzliche Regelung.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            4. Es gilt ausschließlich das Recht der Bundesrepublik Deutschland.-->
    <!--            </p>-->
    <!--            <p style="text-align: justify;">-->
    <!--            5. Ausschließlicher Gerichtsstand für alle Streitigkeiten aus diesem Vertrag der Geschäftssitz von Expertiserocks. Dasselbe gilt, wenn der Händler keinen allgemeinen Gerichtsstand in Deutschland (SPANIEN) hat oder Wohnsitz oder gewöhnlicher Aufenthalt im Zeitpunkt der Klageerhebung nicht bekannt ist.-->
    <!--            </p>-->
    <!--      </div>-->
    <!--      <div class="modal-footer">-->
    <!--        <button type="button" class="btn btn-orange" data-dismiss="modal">Close</button>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->


    <!-- Modal IMPRESSUM-->
    <div class="modal fade" id="impressum_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #f39c12;color: #fff;">
                    <h5 class="modal-title">IMPRESSUM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($pages as $page)
                    @if($page->id == 3)
                    {!!$page->page_content!!}
                    @endif
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-orange" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Data Protection -->
    <div class="modal fade" id="data_protection_modal" tabindex="-1" role="dialog"
        aria-labelledby="dataProtectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #f39c12;color: #fff;">
                    <h5 class="modal-title">IMPRESSUM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($pages as $page)
                    @if($page->id == 2)
                    {!!$page->page_content!!}
                    @endif
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-orange" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery 2.1.3 -->
    <script src="{{asset('vendor/crudbooster/assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js')}}" type="text/javascript">
    </script>

    <script>
        $('#terms_condition').click(function(){
        $('#terms_and_condition_modal').modal('show');
    });

    $('#impressum').click(function(){
        $('#impressum_modal').modal('show');
    });

    $('#data_protection').click(function(){
        $('#data_protection_modal').modal('show');
    });
    </script>
</body>

</html>
