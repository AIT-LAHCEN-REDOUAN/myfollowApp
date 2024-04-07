<!--

=========================================================
* Notus Tailwind JS - v1.1.0 based on Tailwind Starter Kit by Creative Tim
=========================================================

* Product Page: https://www.creative-tim.com/product/notus-js
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/notus-js/blob/main/LICENSE.md)

* Tailwind Starter Kit Page: https://www.creative-tim.com/learning-lab/tailwind-starter-kit/presentation

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000">

    <!-- Favicon -->
    <link rel="icon" sizes="76x76" href="{{asset("assets/img/Green_MyFollowApp-removebg-preview.jpg")}}">

    <!-- Stylesheets -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css">
    <link rel="stylesheet" href="{{ asset('assets/styles/tailwind.css')}}">
      <link href="{{ asset('assets/js/bootstrap.min.css') }}" rel="stylesheet">
      <script src="{{ asset('assets/js/Chart.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <title>ISM</title
  </head>
  <style>
      body{
          background-color: rgba(25, 152, 15, 0.66);
          color: black;
      }
      /* Alert container */
      .alert {
          padding: 20px;
          background-color: #4CAF50; /* Green background color */
          color: white; /* White text color */
          border-radius: 5px;
          position: relative;
          margin-bottom: 20px;
      }

      /* Close button */
      .closebtn {
          position: absolute;
          right: 20px;
          top: 0;
          padding: 10px;
          cursor: pointer;
      }
  </style>

  <body class="text-blueGray-700 antialiased">

    <div id="root" >
        <div class="mt-10 sm:mt-0">
            <div class="w-full sm:w-1/2 md:w-3/4 px-4 py-2.5 mx-auto">
      <nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
      >
        <div
          class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
        >
          <button
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            type="button"
            onclick="toggleNavbar('example-collapse-sidebar')"
          >
            <i class="fas fa-bars"></i>
          </button>
          <a
            class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-1 px-0"
            href="/"
          >
        <img class=" items-center justify-center w-25 h-25" src="{{asset('../../assets/img/Green_MyFollowApp.jpg')}}" alt="">

          </a>
          <div
            class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
            id="example-collapse-sidebar"
          >
            <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200">
              <div class="flex flex-wrap">
                <div class="w-6/12 flex justify-end">
                  <button
                    type="button"
                    class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                    onclick="toggleNavbar('example-collapse-sidebar')"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
            <form class="mt-6 mb-4 md:hidden">
              <div class="mb-3 pt-0">
                <input
                  type="text"
                  placeholder="Search"
                  class="border-0 px-3 py-2 h-1 border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
                />
              </div>
            </form>
            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />
            <!-- Heading -->
            <h6
              class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
            >
              Bienvenue {{Auth::user()->name}} !!
              <br>
              <br>
              Admin
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
              <li class="items-center">
                <a
                  href="/"
                  class="text-xs uppercase py-3 font-bold block {{ request()->is('/') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                >
                  <i class="fas fa-tv mr-2 text-sm opacity-75"></i>
                  Dashboard
                </a>
              </li>
              <hr class="my-4 md:min-w-full" />





                <li class="items-center">
            <a
            href="javascript:void(0);"
            class="text-xs uppercase py-3 font-bold block {{ (request()->is('users*') || request()->is('addOperateur') ) ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
            onclick="toggleSubMenu('submenu-utilisateurs')"
        >
            <i class="fas fa-users mr-2 text-sm text-blueGray-300"></i>
            Utilisateurs
        </a>
                <ul class="mt-4" id="submenu-utilisateurs" style="{{(request()->is('users*') || request()->is('addOperateur') ) ? 'display:block' : 'display:none'}}">
                @can('Gestion_User')
                  <li class=" items-center px-4" >
                    <a
                        href="{{route('users.create')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('users/create') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                        Ajouter Utilisateurs
                    </a>
                </li>
                @endcan
                @can('Gestion_User')



                  <li class=" items-center px-4" >
                    <a
                        href="{{ route('users.index')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('users') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                        Mes Utilisateurs
                    </a>
                </li>
                @endcan
                @can('Gestion_User')


                <li class=" items-center px-4" >
                    <a
                        href="{{route('addOperateur')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('addOperateur') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                        Ajouter Operateur
                    </a>
                </li>
                @endcan


              </ul>
              </li>
              <hr class="my-4 md:min-w-full" />




            <li class="items-center">
                <a
                href="javascript:void(0);"
                class="text-xs uppercase py-3 font-bold block {{ request()->is('colies*') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                onclick="toggleSubColie('submenu-colie')"
                >
                  <i
                    class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                  ></i>
                  Input Database
                </a>
              </li>

              <ul class="mt-4" id="submenu-colie" style="{{request()->is('colies*')  ? 'display:block' : 'display:none'}}">
               @can('Gestion_DataBase')
                <li class=" items-center px-4" >
                    <a
                        href="{{route('colies.index')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('colies') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                        DataBase
                    </a>
                </li>
                @endcan
                @can('Gestion_DataBase')


                <li class=" items-center px-4">
                    <a
                        href="{{ route('colies.create')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('colies/create') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                        Ajouter Nouveau
                    </a>
                </li>
                @endcan
            </ul>
            <hr class="my-4 md:min-w-full" />


            @can('Gestion_Stock')
<li class="items-center">
              <a
              href="{{route('stocks.index')}}"
              class="text-xs uppercase py-3 font-bold block {{ request()->is('stocks*') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
              >
                <i
                  class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                ></i>
                Stock
              </a>
            </li>
<hr class="my-4 md:min-w-full" />
            @endcan


              <li class="items-center">
              <a
              href="javascript:void(0);"
              class="text-xs uppercase py-3 font-bold block {{
    (request()->is('all_operation')||request()->is('in') || request()->is('Corrige') ||
     request()->is('Deroger') || request()->is('Annuler') || request()->is('NonValider') ||
     request()->is('CorrigeNonValider') || request()->is('DerogerNonValider') || request()->is('out') ||
     request()->is('retour') || request()->is('out/Pending') || request()->is('out/Corrige') || request()->is('out/Annuler'))
      ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
              onclick="toggleSubSuivi('submenu-suivi')"
              >
                <i
                  class="fas fa-chart-pie mr-2 text-sm text-blueGray-300"
                ></i>
                suivi traçabilité
              </a>
            </li>
            <ul class="mt-4" id="submenu-suivi" style="{{(request()->is('all_operation')||request()->is('in') || request()->is('Corrige') ||
     request()->is('Deroger') || request()->is('Annuler') || request()->is('NonValider') ||
     request()->is('CorrigeNonValider') || request()->is('DerogerNonValider') || request()->is('out') ||
     request()->is('retour') || request()->is('out/Pending') || request()->is('out/Corrige') || request()->is('out/Annuler')) ? 'display:block' : 'display:none'}}">
                @can('Gestion_Suivi_tracabilites')


              <li class=" items-center px-4" >
                <a
                    href="{{route('All')}}"
                    class="text-xs uppercase py-2 font-bold block {{ request()->is('all_operation') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                >
                    All Operations
                </a>
            </li>
            @endcan
            <br>
            @can('Gestion_Suivi_tracabilites')


              <li class=" items-center px-4" >
                  <a

                      href="javascript:void(0);"
                      class="text-xs uppercase py-2 font-bold block
                      {{ (request()->is('in') || request()->is('Corrige') || request()->is('Deroger') || request()->is('Annuler') || request()->is('Pending'))
      ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                      onclick="toggleSubIn('submenu-in')"
                  >
                      In
                  </a>
                  <ul class="mt-4" id="submenu-in" style="{{(request()->is('in') || request()->is('Corrige') || request()->is('Deroger') || request()->is('Annuler') || request()->is('Pending')) ? 'display:block' : 'display:none'}}">
                    <li class=" items-center px-4" >
                        <a
                            href="{{route('in')}}"
                            class="text-xs uppercase py-2 font-bold block {{ request()->is('in') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                        >
                            All In
                        </a>
                    </li>
                      <li class=" items-center px-4" >
                          <a
                              href="{{route('Pending')}}"
                              class="text-xs uppercase py-2 font-bold block {{ request()->is('Pending') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                          >
                              En cours
                          </a>
                      </li>
                    <li class=" items-center px-4" >
                        <a
                            href="{{route('Corrige')}}"
                            class="text-xs uppercase py-2 font-bold block {{ request()->is('Corrige') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                        >
                        Corrigé
                        </a>
                    </li>
                    <li class=" items-center px-4" >
                        <a
                            href="{{route('Deroger')}}"
                            class="text-xs uppercase py-2 font-bold block {{ request()->is('Deroger') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                        >
                        Derogé
                        </a>
                    </li>
                    <li class=" items-center px-4" >
                        <a
                            href="{{route('Annuler')}}"
                            class="text-xs uppercase py-2 font-bold block {{ request()->is('Annuler') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                        >
                        Annuler
                        </a>
                    </li>
                </ul>
              </li>
              @endcan
              @can('Gestion_Suivi_tracabilites')

            <br>
            <li class=" items-center px-4">
              <a
                  href="javascript:void(0);"
                  class="text-xs uppercase py-2 font-bold block {{ (request()->is('NonValider') || request()->is('CorrigeNonValider') || request()->is('DerogerNonValider')) ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                  onclick="toggleSubNonValider('submenu-NonValider')"
              >
               Non Valider
              </a>

              <ul class="mt-4" id="submenu-NonValider" style="{{(request()->is('NonValider') || request()->is('CorrigeNonValider') || request()->is('DerogerNonValider')) ? 'display:block' : 'display:none'}}">
                <li class=" items-center px-4" >
                    <a
                        href="{{route('NonValider')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('NonValider') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                        All NonValider
                    </a>
                </li>
               {{--
<li class=" items-center px-4" >
                    <a
                        href="{{route('CorrigeNonValider')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('CorrigeNonValider') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                    Corrigé
                    </a>
                </li>
                <li class=" items-center px-4" >
                    <a
                        href="{{route('DerogeNonValider')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('DerogerNonValider') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                    Derogé
                    </a>
                </li>

                --}}
{{--                <li class=" items-center px-4" >--}}
{{--                    <a--}}
{{--                        href="{{route('DerogeNonValider')}}"--}}
{{--                        class="text-xs uppercase py-2 font-bold block text-blueGray-700 hover:text-blueGray-500"--}}
{{--                    >--}}
{{--                    Annuler--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
           </li>
         <br>
          @endcan
          @can('Gestion_Suivi_tracabilites')


{{--              <li class=" items-center px-4">--}}
{{--                  <a--}}
{{--                      href="{{ route('out')}}"--}}
{{--                      class="text-xs uppercase py-2 font-bold block {{ request()->is('out') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"--}}
{{--                  >--}}
{{--                      Out--}}
{{--                  </a>--}}
{{--              </li>--}}


                        <li class=" items-center px-4" >
                            <a

                                href="javascript:void(0);"
                                class="text-xs uppercase py-2 font-bold block
                      {{ (request()->is('out') || request()->is('out/Corrige') || request()->is('out/Annuler') || request()->is('out/Pending'))
      ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                                onclick="toggleSubOut('submenu-out')"
                            >
                                Out
                            </a>
                            <ul class="mt-4" id="submenu-out" style="{{(request()->is('out') || request()->is('out/Corrige') || request()->is('out/Annuler') || request()->is('out/Pending')) ? 'display:block' : 'display:none'}}">
                                <li class=" items-center px-4" >
                                    <a
                                        href="{{route('out')}}"
                                        class="text-xs uppercase py-2 font-bold block {{ request()->is('out') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                                    >
                                        All Out
                                    </a>
                                </li>
                                <li class=" items-center px-4" >
                                    <a
                                        href="{{route('out.Pending')}}"
                                        class="text-xs uppercase py-2 font-bold block {{ request()->is('out/Pending') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                                    >
                                        En cours
                                    </a>
                                </li>
                                <li class=" items-center px-4" >
                                    <a
                                        href="{{route('out.Corrige')}}"
                                        class="text-xs uppercase py-2 font-bold block {{ request()->is('out/Corrige') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                                    >
                                        Corrigé
                                    </a>
                                </li>
                                <li class=" items-center px-4" >
                                    <a
                                        href="{{route('out.Annuler')}}"
                                        class="text-xs uppercase py-2 font-bold block {{ request()->is('out/Annuler') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                                    >
                                        Annuler
                                    </a>
                                </li>
                            </ul>
                        </li>



                    @endcan
              <br>
              @can('Gestion_Suivi_tracabilites')


              <li class=" items-center px-4">
                <a
                    href="{{route('retour')}}"
                    class="text-xs uppercase py-2 font-bold block {{ request()->is('retour') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                >
                    Retour
                </a>
            </li>
            @endcan



          </ul>
              <hr class="my-4 md:min-w-full" />

</ul>

<ul
              class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4"
            >

              <li class="items-center">
                <a
                href="javascript:void(0);"
                class="text-xs uppercase py-3 font-bold block {{ request()->is('fournisseurs*') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                onclick="toggleSubMenu('submenu-fournisseur')"
                >
                  <i
                    class="fas fa-fingerprint text-blueGray-300 mr-2 text-sm"
                  ></i>
                   Fournisseurs
                </a>
              </li>
              <ul class="mt-4" id="submenu-fournisseur" style="{{request()->is('fournisseurs*') ? 'display:block' : 'display:none'}}">
                @can('Gestion_Fournisseur')
                <li class=" items-center px-4" >
                    <a
                        href="{{route('fournisseurs.index')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('fournisseurs') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                        mes Fournisseurs
                    </a>
                </li>
                @endcan
                @can('Gestion_Fournisseur')

                <li class=" items-center px-4">
                    <a
                        href="{{ route('fournisseurs.create')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('fournisseurs/create') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                        ajouter Fournisseurs
                    </a>
                </li>
                @endcan
            </ul>

            </ul>
            <hr class="my-4 md:min-w-full" />



<ul
              class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4"
            >
              <li class="items-center">
                <a
                href="javascript:void(0);"
                class="text-xs uppercase py-3 font-bold block {{ request()->is('destinataires*') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                onclick="toggleSubDestinataire('submenu-destinataire')"
                >
                  <i
                    class="fas fa-fingerprint text-blueGray-300 mr-2 text-sm"
                  ></i>
                   Clients
                </a>
              </li>
              <ul class="mt-4" id="submenu-destinataire" style="{{request()->is('destinataires*') ? 'display:block' : 'display:none'}}">
                @can('Gestion_Client')


                <li class=" items-center px-4" >
                    <a
                        href="{{route('destinataires.index')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('destinataires') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                        mes clients
                    </a>
                </li>
                @endcan
                @can('Gestion_Client')


                <li class=" items-center px-4">
                    <a
                        href="{{ route('destinataires.create')}}"
                        class="text-xs uppercase py-2 font-bold block {{ request()->is('destinataires/create') ? 'text-red-500' : 'text-blueGray-700' }}  hover:text-pink-600"
                    >
                        ajouter client
                    </a>
                </li>
                @endcan
            </ul>
            <br>
            <br>
            <form action="{{route('logout')}}" method="post">
              @csrf
              <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-red-600 py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Déconnecter
              </button>
            </form>
            <!-- Divider -->

            <!-- Heading -->

            <!-- Navigation -->
            <!-- Divider -->

          </div>
        </div>
      </nav>
      <div class="relative md:ml-64 ">
        <nav
          class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4"
        >
          <div
            class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4"
          >
{{--            <a--}}
{{--              class=" text-sm uppercase hidden lg:inline-block font-semibold"--}}
{{--              href="/"--}}
{{--              >Dashboard</a--}}
{{--            >--}}


          </div>
        </nav>
        <!-- Header -->
        <div>
          @yield("statistic")
        </div>

      </div>
      <!-- Your existing HTML content here -->
        <div class="relative md:ml-64 mb-8 " >
        @yield('data')
        </div>
<!-- Add a container for the table -->

<!-- Continue with the rest of your HTML content -->

      </div>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      charset="utf-8"
    ></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script> -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


  </body>
  <script>

new TomSelect('#select-role', {
    maxItems: 200,
    plugins: {
        remove_button: {
            title: "Remove this item",
        },

    },
    persist: false,
    create: true,
        dropdownParent: '#custom-dropdown',
        // dropdownCss: { 'max-height': '150px' },
    onDelete: function () {
        return true; // Always return true to remove items without confirmation
    }

});
    function toggleSubMenu(id) {
        var submenu = document.getElementById(id);
        if (submenu.style.display === "none" || submenu.style.display === "") {
            submenu.style.display = "block";
        } else {
            submenu.style.display = "none";
        }
    };
    function toggleSubColie(id) {
        var submenu = document.getElementById(id);
        if (submenu.style.display === "none" || submenu.style.display === "") {
            submenu.style.display = "block";
        } else {
            submenu.style.display = "none";
        }
    }
    function toggleSubFournisseur(id) {
        var submenu = document.getElementById(id);
        if (submenu.style.display === "none" || submenu.style.display === "") {
            submenu.style.display = "block";
        } else {
            submenu.style.display = "none";
        }
    }
    function toggleSubDestinataire(id) {
        var submenu = document.getElementById(id);
        if (submenu.style.display === "none" || submenu.style.display === "") {
            submenu.style.display = "block";
        } else {
            submenu.style.display = "none";
        }
    }
    function toggleSubSuivi(id) {
        var submenu = document.getElementById(id);
        if (submenu.style.display === "none" || submenu.style.display === "") {
            submenu.style.display = "block";
        } else {
            submenu.style.display = "none";
        }
    }
    function toggleSubIn(id) {
        var submenu = document.getElementById(id);
        if (submenu.style.display === "none" || submenu.style.display === "") {
            submenu.style.display = "block";
        } else {
            submenu.style.display = "none";
        }
    }
    function toggleSubOut(id) {
        var submenu = document.getElementById(id);
        if (submenu.style.display === "none" || submenu.style.display === "") {
            submenu.style.display = "block";
        } else {
            submenu.style.display = "none";
        }
    }
    function toggleSubNonValider(id){
        var submenu = document.getElementById(id);
        if(submenu.style.display === "none" || submenu.style.display == ""){
            submenu.style.display = "block";
        } else {
            submenu.style.display ="none"
        }
    }

</script>

</html>
