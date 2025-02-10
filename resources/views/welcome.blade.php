<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>TeleDoctor's | La Consulta Médica en Línea</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        content="Expande tu práctica médica sin límites. Nuestra plataforma de telemedicina te permite ofrecer consultas virtuales a tus pacientes de forma segura y eficiente, ampliando tu alcance y generando nuevos ingresos."
        name="description" />
    <meta content="Gematechnology" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/hyper-config.js') }}"></script>

    <!-- Vendor css -->
    <link href="a{{ asset('ssets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .flecha-arriba {
            background-color: #48cafd;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 100;
            opacity: 0;
            padding: 10px;
            color: #040c1c;
            border-radius: 50%;
            /* Inicialmente oculta */
            /* transition: opacity 0.3s ease-in-out; */
            /* Transición suave para la opacidad */
            transition: transform 0.3s ease, opacity 0.3s ease;
            /* Transición para el efecto */
        }

        .flecha-arriba:hover {
            transform: scale(1.1);
            /* Escala la flecha un poco al pasar el cursor */
            opacity: 0.8;
            /* Reduce un poco la opacidad */
        }

        .flecha-arriba i {
            width: 50px;
            height: 50px;
            font-size: 25px;
        }

        /* Estilos para el botón cuando el usuario hace scroll */
        .flecha-arriba.visible {
            opacity: 1;
        }
    </style>
</head>

<body>

    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg navbar-dark"
        style="position: fixed;
    width: 100%;
    z-index: 1;
    /* margin-botton: 30px; */
    background-color: #040c1c;"
        id="inicio">
        <div class="container">

            <!-- logo -->
            <a href="/" class="navbar-brand me-lg-5">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="logo-dark" height="60" />
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- menus -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <!-- left menu -->
                <ul class="navbar-nav me-auto align-items-center">
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link" href="#precios">Precios</a>
                    </li>
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link" href="#clientes">Clientes</a>
                    </li>
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link" href="#contacto">Contactanos</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item mx-lg-1">
                                <a href="{{ url('/inicio') }}" class="nav-item nav-link">{{ __('Dashboard') }}</a>
                            </li>
                        @else
                            <li class="nav-item mx-lg-1">
                                <a href="{{ route('login') }}" class="nav-item nav-link">{{ __('Login') }}</a>
                            </li>

                            @if (Route::has('register'))
                                <li class="nav-item mx-lg-1">
                                    <a href="{{ route('register') }}" class="nav-item nav-link">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>

                <!-- right menu -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-0">
                        <a href="{{ route('register') }}" class="nav-link d-lg-none">{{ 'Prueba Gratis' }}</a>
                        <a href="#" class="btn btn-sm btn-light rounded-pill d-none d-lg-inline-flex">
                            <i class="mdi mdi-basket me-2"></i> {{ 'Compra Ahora' }}
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- START HERO -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center" style="margin-top: 120px;">
                <div class="col-md-5">
                    <div class="md-4">
                        <div>
                            <span class="text-white-50 ms-1">{{ "Bienvenidos a TeleDoctor's" }}</span>
                        </div>
                        <h2 class="text-white fw-normal mb-4 mt-3 lh-base">
                            La Consulta Médica en Línea
                        </h2>

                        <p class="mb-4 font-16 text-white-50">Expande tu práctica médica sin límites. Nuestra plataforma
                            de telemedicina te permite ofrecer consultas virtuales a tus pacientes de forma segura y
                            eficiente, ampliando tu alcance y generando nuevos ingresos.</p>

                        <a href="{{ route('register') }}" target="_blank"
                            class="btn btn-lg font-16 btn-success">{{ 'Prueba Gratis' }} <i
                                class="mdi mdi-arrow-right ms-1"></i></a>

                        <a href="#contacto" class="btn btn-lg font-16 btn-info">{{ 'Contactanos Ahora' }}</a>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="text-md-end mt-3 mt-md-0">
                        <img src="{{ asset('assets/images/portada.jpg') }}" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END HERO -->

    <!-- START SERVICES -->
    <section class="py-5">
        <div class="container">
            <div class="row py-4">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="mt-0"><i class="mdi mdi-infinity"></i></h1>
                        <h1>Lleva tu consultorio donde quieras con <span class="text-primary">TeleDoctor's.</span></h1>
                        <p class="text-muted mt-2">¿Quieres ofrecer una atención médica de calidad superior y al mismo
                            tiempo optimizar tu práctica? TeleDoctor's es la solución perfecta. Nuestra plataforma de
                            telemedicina te permite expandir tu alcance, mejorar la experiencia de tus pacientes y
                            aumentar tu eficiencia.</p>
                        <p class="text-muted mt-2"> TeleDoctor's es la plataforma de telemedicina que
                            necesitas.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-desktop text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Consultas Online</h4>
                        <p class="text-muted mt-2 mb-0">Atiende a tus pacientes desde cualquier lugar y a cualquier
                            hora.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-calendar-alt text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Agenda Tu cita</h4>
                        <p class="text-muted mt-2 mb-0">Agenda tu cita desde cualquier lugar y a cualquier hora
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-presentation text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Diversidad de Reportes</h4>
                        <p class="text-muted mt-2 mb-0">Genera reportes ajustados a tus necesidades específicas
                        </p>
                    </div>
                </div>

                {{-- <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-apps text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Multiple Applications</h4>
                        <p class="text-muted mt-2 mb-0">Et harum quidem rerum as expedita distinctio nam libero tempore
                            cum soluta nobis est cumque quo.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-shopping-cart-alt text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Ecommerce Pages</h4>
                        <p class="text-muted mt-2 mb-0">Temporibus autem quibusdam et aut officiis necessitatibus saepe
                            eveniet ut sit et recusandae.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-grids text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Multiple Layouts</h4>
                        <p class="text-muted mt-2 mb-0">Nam libero tempore, cum soluta a est eligendi minus id quod
                            maxime placeate facere assumenda est.
                        </p>
                    </div>
                </div> --}}
            </div>

        </div>
    </section>
    <!-- END SERVICES -->

    <!-- START FEATURES 2 -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="mt-0 text-primary"><i class="mdi mdi-heart-pulse"></i></h1>
                        <h3><span class="text-primary">TeleDoctor's</span>, La solución perfecta para tu práctica
                            médica</h3>
                        <p class="text-muted mt-2">¿Estás buscando una forma de expandir tu práctica médica y ofrecer
                            una atención más flexible a tus pacientes? TeleDoctor's es la plataforma de telemedicina que
                            necesitas.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row py-5 align-items-center">
                <div class="col-lg-5 col-md-6">
                    <img src="{{ asset('assets/images/svg/features-1.svg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 offset-md-1 col-md-5">
                    <div>
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Ofrecer consultas
                            virtuales: Atiende a tus pacientes desde cualquier lugar y a cualquier hora.</p>
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Optimizar tu flujo de
                            trabajo: Gestiona tus citas, realiza diagnósticos y emite recetas de forma digital.
                            Pages</p>
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Aumentar tu alcance:
                            Atrae a nuevos pacientes y refuerza la relación con los existentes.
                            invoice</p>
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Cumplir con las
                            regulaciones: Nuestra plataforma garantiza la seguridad y privacidad de tus datos y los de
                            tus pacientes.
                            password</p>
                    </div>

                    {{-- <a href="" class="btn btn-primary rounded-pill mt-3">Read More <i
                            class="mdi mdi-arrow-right ms-1"></i></a> --}}

                </div>
            </div>
        </div>
    </section>
    <!-- END FEATURES 2 -->

    <!-- START PRICING -->
    <section class="py-5 bg-light-lighten border-top border-bottom border-light" id="precios">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="mt-0"><i class="mdi mdi-tag-multiple"></i></h1>
                        <h3>Choose Simple <span class="text-primary">Pricing</span></h3>
                        <p class="text-muted mt-2">The clean and well commented code allows easy customization of the
                            theme.It's designed for
                            <br>describing your app, agency or business.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row mt-5 pt-3">
                @foreach ($plans as $plan)
                    <div class="col-md-3 mb-3">
                        <div class="card card-pricing {{ $plan->name == 'Medio' ? 'card-pricing-recommended' : '' }}">
                            <div class="card-body text-center">
                                @if ($plan->name == 'Medio')
                                    <div class='card-pricing-plan-tag'>{{ __('Recommended') }}</div>
                                @endif

                                <p class="card-pricing-plan-name fw-bold text-uppercase">{{ $plan->name }} </p>
                                <i class="card-pricing-icon ri-user-line text-primary"></i>
                                <h2 class="card-pricing-price">{{ $plan->price }} <span>/
                                        {{ $plan->duration }}{{ '/Días' }}</span></h2>
                                <ul class="card-pricing-features">
                                    @foreach ($plan->benefits as $item)
                                        <li>{{ $item->name }}</li>
                                    @endforeach
                                </ul>
                                <button class="btn btn-primary mt-4 mb-2 rounded-pill">Choose Plan</button>
                            </div>
                        </div>
                        <!-- end Pricing_card -->
                    </div>
                @endforeach

            </div>

        </div>
    </section>
    <!-- END PRICING -->

    <!-- START CONTACT -->
    <section class="py-5 bg-light-lighten border-top border-bottom border-light" id="contacto">
        <div class="container card p-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3>Póngase en <span class="text-primary">Contacto</span></h3>
                        <p class="text-muted mt-2">Por favor, rellene el siguiente formulario y nos pondremos en
                            contacto con usted próximamente. Para obtener más
                            información,
                            <br>póngase en contacto con nosotros.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mt-3">
                <div class="col-md-4">
                    <p class="text-muted"><span class="fw-bold">Apoyo al cliente:</span><br> <span
                            class="d-block mt-1">+58 412 997 7546</span></p>
                    <p class="text-muted mt-4"><span class="fw-bold">Dirección de correo electrónico:</span><br> <span
                            class="d-block mt-1">info@gematechnology.tech</span></p>
                    {{-- <p class="text-muted mt-4"><span class="fw-bold">Office Address:</span><br> <span
                            class="d-block mt-1">4461 Cedar Street Moro, AR 72368</span></p> --}}
                    <p class="text-muted mt-4"><span class="fw-bold">Horario de oficina:</span><br> <span
                            class="d-block mt-1">8:00AM a 6:00PM</span></p>
                </div>

                <div class="col-md-7">
                    <form action="{{ route('contactanos') }}" method="post" name="sentMessage" id="contactForm">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="fullname" class="form-label">Nombre Completo</label>
                                    <input class="form-control form-control-light py-2" type="text" id="fullname"
                                        placeholder="Nombre...">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="emailaddress" class="form-label">Correo Eléctronico</label>
                                    <input class="form-control form-control-light py-2" type="email" required=""
                                        id="emailaddress" placeholder="Ingresa tu correo...">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="subject" class="form-label">Asunto</label>
                                    <input class="form-control form-control-light py-2" type="text" id="subject"
                                        placeholder="Asunto...">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="comments" class="form-label">Mensaje</label>
                                    <textarea id="comments" rows="4" class="form-control form-control-light"
                                        placeholder="Ingrese su mensaje aquí..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button class="btn btn-primary">Enviar Mensaje <i class="mdi mdi-telegram ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTACT -->

    <!-- START FOOTER -->
    <footer class="bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="logo-dark"
                        height="100" />
                    <p class="text-light text-opacity-50 mt-4">Expande tu práctica médica sin límites. Nuestra
                        plataforma de telemedicina te permite ofrecer consultas virtuales a tus pacientes de forma
                        segura y eficiente, ampliando tu alcance y generando nuevos ingresos.
                    </p>

                    <ul class="social-list list-inline mt-3">
                        <li class="list-inline-item text-center">
                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                    class="mdi mdi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item text-center">
                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                    class="mdi mdi-google"></i></a>
                        </li>
                        <li class="list-inline-item text-center">
                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                    class="mdi mdi-twitter"></i></a>
                        </li>
                        <li class="list-inline-item text-center">
                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                    class="mdi mdi-github"></i></a>
                        </li>
                    </ul>

                </div>

                <div class="col-lg-2 col-md-4 mt-3 mt-lg-0">
                    <h5 class="text-light">Company</h5>

                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                        <li class="mt-2"><a href="javascript: void(0);" class="text-light text-opacity-50">About
                                Us</a></li>
                        <li class="mt-2"><a href="javascript: void(0);"
                                class="text-light text-opacity-50">Documentation</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-light text-opacity-50">Blog</a>
                        </li>
                        <li class="mt-2"><a href="javascript: void(0);"
                                class="text-light text-opacity-50">Affiliate Program</a></li>
                    </ul>

                </div>

                <div class="col-lg-2 col-md-4 mt-3 mt-lg-0">
                    <h5 class="text-light">Apps</h5>

                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                        <li class="mt-2"><a href="javascript: void(0);"
                                class="text-light text-opacity-50">Ecommerce Pages</a></li>
                        <li class="mt-2"><a href="javascript: void(0);"
                                class="text-light text-opacity-50">Email</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-light text-opacity-50">Social
                                Feed</a></li>
                        <li class="mt-2"><a href="javascript: void(0);"
                                class="text-light text-opacity-50">Projects</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-light text-opacity-50">Tasks
                                Management</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 mt-3 mt-lg-0">
                    <h5 class="text-light">Discover</h5>

                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                        <li class="mt-2"><a href="javascript: void(0);" class="text-light text-opacity-50">Help
                                Center</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-light text-opacity-50">Our
                                Products</a></li>
                        <li class="mt-2"><a href="javascript: void(0);"
                                class="text-light text-opacity-50">Privacy</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <p class="text-light text-opacity-50 mt-4 text-center mb-0">© 2024 -
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Diseñado por.
                            <a href="https://gematechnology.tech" target="_blank"
                                rel="noopener noreferrer">Gematechnology</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" id="flecha-arriba" title="Ir al inicio" class="flecha-arriba">
            <i class="uil-arrow-up"></i>
        </a>
    </footer>
    <!-- END FOOTER -->
    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            const flechaArriba = $('#flecha-arriba');

            // Mostrar/ocultar la flecha al hacer scroll
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) { // Mostrar después de 100px de scroll
                    flechaArriba.addClass('visible');
                } else {
                    flechaArriba.removeClass('visible');
                }
            });

            // Scroll suave al hacer clic en la flecha
            flechaArriba.click(function(event) {
                event.preventDefault();

                $('html, body').animate({
                    scrollTop: 0
                }, 500); // 500 milisegundos para la animación
            });
        });
    </script>
</body>

</html>
