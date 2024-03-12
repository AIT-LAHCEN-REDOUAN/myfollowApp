@extends('admin.layouts')
@section('data')




    {{--<div class="flex flex-wrap">--}}
{{--    <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">--}}
{{--      <div--}}
{{--        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-blueGray-700"--}}
{{--      >--}}
{{--        <div class="rounded-t mb-0 px-4 py-3 bg-transparent">--}}
{{--          <div class="flex flex-wrap items-center">--}}
{{--            <div class="relative w-full max-w-full flex-grow flex-1">--}}
{{--              <h6--}}
{{--                class="uppercase text-blueGray-100 mb-1 text-xs font-semibold"--}}
{{--              >--}}
{{--                Overview--}}
{{--              </h6>--}}
{{--              <h2 class="text-white text-xl font-semibold">--}}
{{--                Sales value--}}
{{--              </h2>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="p-4 flex-auto">--}}
{{--          <!-- Chart -->--}}
{{--          <div class="relative h-350-px">--}}
{{--            <canvas id="line-chart"></canvas>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--    <div class="w-full xl:w-4/12 px-4">--}}
{{--      <div--}}
{{--        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"--}}
{{--      >--}}
{{--        <div class="rounded-t mb-0 px-4 py-3 bg-transparent">--}}
{{--          <div class="flex flex-wrap items-center">--}}
{{--            <div class="relative w-full max-w-full flex-grow flex-1">--}}
{{--              <h6--}}
{{--                class="uppercase text-blueGray-400 mb-1 text-xs font-semibold"--}}
{{--              >--}}
{{--                Performance--}}
{{--              </h6>--}}
{{--              <h2 class="text-blueGray-700 text-xl font-semibold">--}}
{{--                Total orders--}}
{{--              </h2>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="p-4 flex-auto">--}}
{{--          <!-- Chart -->--}}
{{--          <div class="relative h-350-px">--}}
{{--            <canvas id="bar-chart"></canvas>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </div>--}}


<!-- Continue with the rest of your HTML content -->
@endsection
@section('statistic')
<div class="relative bg-red-600 md:pt-32 pb-32 pt-12">

    <div class="px-4 md:px-10 mx-auto w-full">
      <div>
          <h6 class="text-white pl-3 font-bold uppercase">Periode : </h6>
          <form action="/" method="GET" class="w-full pb-16 md:flex">
              <div class="relative flex items-center w-full md:w-1/2 lg:w-1/3 p-3">
                  <div class="relative flex-grow">
            <span class="z-10 h-full leading-snug font-normal text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                <i class="far fa-calendar-alt"></i>
            </span>
                      <input
                          value="{{ $start_date ?? '' }}"
                          name="start_date"
                          type="date"
                          class="border-0 px-2 py-2 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
                      />
                  </div>
              </div>

              <div class="relative flex items-center w-full md:w-1/2 lg:w-1/3 p-3">
                  <div class="relative flex-grow">
            <span class="z-10 h-full leading-snug font-normal text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                <i class="far fa-calendar-alt"></i>
            </span>
                      <input
                          value="{{ $end_date ?? '' }}"
                          name="end_date"
                          type="date"
                          class="border-0 px-2 py-2 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
                      />
                  </div>
              </div>

              <div class="relative flex items-center w-full md:w-1/2 lg:w-1/3 p-3">
                  <button class="text-white font-bold py-2 px-4 rounded" style="background-color: #080f96">Filtrer</button>
              </div>
          </form>

          <!-- Card stats -->
        <div class="flex flex-wrap">


            <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    Opérations En cours
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                      {{$total_operation_pending}}
                    </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"
                                >
                                    <i class="far fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    Opérations corrigés
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                      {{$total_operation_corrigee}}
                    </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"
                                >
                                    <i class="far fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    Opérations dérogées
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                      {{$total_operation_derogee}}
                    </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"
                                >
                                    <i class="far fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    Opérations annulées
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                      {{$total_operation_annulee}}
                    </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"
                                >
                                    <i class="far fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-10">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    Total des opérations
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                      {{$total_operation}}
                    </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"
                                >
                                    <i class="far fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-10">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    Opérations retour
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                      {{$total_retour}}
                    </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M48.5 224H40c-13.3 0-24-10.7-24-24V72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8H48.5z"/></svg>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-10">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    Opérations Out
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                      {{$total_out}}
                    </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 64C0 46.3 14.3 32 32 32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64zM192 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H224c-17.7 0-32-14.3-32-32zm32 96H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H224c-17.7 0-32-14.3-32-32s14.3-32 32-32zM0 448c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM.2 268.6c-8.2-6.4-8.2-18.9 0-25.3l101.9-79.3c10.5-8.2 25.8-.7 25.8 12.6V335.3c0 13.3-15.3 20.8-25.8 12.6L.2 268.6z"/></svg>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-10">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    Opérations In
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                      {{$total_in}}
                    </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M392 32H56C25.1 32 0 57.1 0 88v336c0 30.9 25.1 56 56 56h336c30.9 0 56-25.1 56-56V88c0-30.9-25.1-56-56-56zm-108.3 82.1c0-19.8 29.9-19.8 29.9 0v199.5c0 19.8-29.9 19.8-29.9 0V114.1zm-74.6-7.5c0-19.8 29.9-19.8 29.9 0v216.5c0 19.8-29.9 19.8-29.9 0V106.6zm-74.7 7.5c0-19.8 29.9-19.8 29.9 0v199.5c0 19.8-29.9 19.8-29.9 0V114.1zM59.7 144c0-19.8 29.9-19.8 29.9 0v134.3c0 19.8-29.9 19.8-29.9 0V144zm323.4 227.8c-72.8 63-241.7 65.4-318.1 0-15-12.8 4.4-35.5 19.4-22.7 65.9 55.3 216.1 53.9 279.3 0 14.9-12.9 34.3 9.8 19.4 22.7zm5.2-93.5c0 19.8-29.9 19.8-29.9 0V144c0-19.8 29.9-19.8 29.9 0v134.3z"/></svg>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-10">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    <span>CA</span>
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                    {{$ca}}
                  </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                     class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M209.4 39.5c-9.1-9.6-24.3-10-33.9-.9L33.8 173.2c-19.9 18.9-19.9 50.7 0 69.6L175.5 377.4c9.6 9.1 24.8 8.7 33.9-.9s8.7-24.8-.9-33.9L66.8 208 208.5 73.4c9.6-9.1 10-24.3 .9-33.9zM352 64c0-12.6-7.4-24.1-19-29.2s-25-3-34.4 5.4l-160 144c-6.7 6.1-10.6 14.7-10.6 23.8s3.9 17.7 10.6 23.8l160 144c9.4 8.5 22.9 10.6 34.4 5.4s19-16.6 19-29.2V288h32c53 0 96 43 96 96c0 30.4-12.8 47.9-22.2 56.7c-5.5 5.1-9.8 12-9.8 19.5c0 10.9 8.8 19.7 19.7 19.7c2.8 0 5.6-.6 8.1-1.9C494.5 467.9 576 417.3 576 304c0-97.2-78.8-176-176-176H352V64z"/></svg>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-10">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    Total Clients
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                      {{$total_destinataire}}
                    </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"
                                >
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-10">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    Total Fournisseurs
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                      {{$total_fournisseur}}
                    </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"
                                >
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-10">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div
                                class="relative w-full pr-4 max-w-full flex-grow flex-1"
                            >
                                <h5
                                    class="text-blueGray-400 uppercase font-bold text-xs"
                                >
                                    Total Produits
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                      {{$total_colie}}
                    </span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"
                                >
                                    <i class="far fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>




{{--            <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--            <div--}}
{{--              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--            >--}}
{{--              <div class="flex-auto p-4">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                  <div--}}
{{--                    class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                  >--}}
{{--                    <h5--}}
{{--                      class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                    >--}}
{{--                      Total Produits--}}
{{--                    </h5>--}}
{{--                    <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                      {{$total_colie}}--}}
{{--                    </span>--}}
{{--                  </div>--}}
{{--                  <div class="relative w-auto pl-4 flex-initial">--}}
{{--                    <div--}}
{{--                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"--}}
{{--                    >--}}
{{--                      <i class="far fa-chart-bar"></i>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--            <div--}}
{{--              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--            >--}}
{{--              <div class="flex-auto p-4">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                  <div--}}
{{--                    class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                  >--}}
{{--                    <h5--}}
{{--                      class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                    >--}}
{{--                      Total Fournisseurs--}}
{{--                    </h5>--}}
{{--                    <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                      {{$total_fournisseur}}--}}
{{--                    </span>--}}
{{--                  </div>--}}
{{--                  <div class="relative w-auto pl-4 flex-initial">--}}
{{--                    <div--}}
{{--                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"--}}
{{--                    >--}}
{{--                      <i class="fas fa-chart-pie"></i>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--            <div--}}
{{--              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--            >--}}
{{--              <div class="flex-auto p-4">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                  <div--}}
{{--                    class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                  >--}}
{{--                    <h5--}}
{{--                      class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                    >--}}
{{--                      Total Clients--}}
{{--                    </h5>--}}
{{--                    <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                      {{$total_destinataire}}--}}
{{--                    </span>--}}
{{--                  </div>--}}
{{--                  <div class="relative w-auto pl-4 flex-initial">--}}
{{--                    <div--}}
{{--                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"--}}
{{--                    >--}}
{{--                      <i class="fas fa-users"></i>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--            <div--}}
{{--              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--            >--}}
{{--              <div class="flex-auto p-4">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                  <div--}}
{{--                    class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                  >--}}
{{--                    <h5--}}
{{--                      class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                    >--}}
{{--                     <span>Produits En Cours</span>--}}
{{--                    </h5>--}}
{{--                    <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                      1--}}
{{--                    </span>--}}
{{--                  </div>--}}
{{--                  <div class="relative w-auto pl-4 flex-initial">--}}
{{--                    <div--}}
{{--                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                    >--}}
{{--                      <i class="fas fa-percent"></i>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--              </div>--}}

{{--            </div>--}}
{{--          </div>--}}
{{--          <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5 ">--}}
{{--            <div--}}
{{--              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--            >--}}
{{--              <div class="flex-auto p-4">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                  <div--}}
{{--                    class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                  >--}}
{{--                    <h5--}}
{{--                      class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                    >--}}
{{--                     <span>Produit In</span>--}}
{{--                    </h5>--}}
{{--                    <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                      {{$total_in}}--}}
{{--                    </span>--}}
{{--                  </div>--}}
{{--                  <div class="relative w-auto pl-4 flex-initial">--}}
{{--                    <div style="background-color: chartreuse"--}}
{{--                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                    >--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M392 32H56C25.1 32 0 57.1 0 88v336c0 30.9 25.1 56 56 56h336c30.9 0 56-25.1 56-56V88c0-30.9-25.1-56-56-56zm-108.3 82.1c0-19.8 29.9-19.8 29.9 0v199.5c0 19.8-29.9 19.8-29.9 0V114.1zm-74.6-7.5c0-19.8 29.9-19.8 29.9 0v216.5c0 19.8-29.9 19.8-29.9 0V106.6zm-74.7 7.5c0-19.8 29.9-19.8 29.9 0v199.5c0 19.8-29.9 19.8-29.9 0V114.1zM59.7 144c0-19.8 29.9-19.8 29.9 0v134.3c0 19.8-29.9 19.8-29.9 0V144zm323.4 227.8c-72.8 63-241.7 65.4-318.1 0-15-12.8 4.4-35.5 19.4-22.7 65.9 55.3 216.1 53.9 279.3 0 14.9-12.9 34.3 9.8 19.4 22.7zm5.2-93.5c0 19.8-29.9 19.8-29.9 0V144c0-19.8 29.9-19.8 29.9 0v134.3z"/></svg>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--              </div>--}}

{{--            </div>--}}
{{--          </div>--}}
{{--          <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5 ">--}}
{{--            <div--}}
{{--              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--            >--}}
{{--              <div class="flex-auto p-4">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                  <div--}}
{{--                    class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                  >--}}
{{--                    <h5--}}
{{--                      class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                    >--}}
{{--                     <span>Produit Out</span>--}}
{{--                    </h5>--}}
{{--                    <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                      {{$total_out}}--}}
{{--                    </span>--}}
{{--                  </div>--}}
{{--                  <div class="relative w-auto pl-4 flex-initial">--}}
{{--                    <div style="background-color: aqua"--}}
{{--                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                    >--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 64C0 46.3 14.3 32 32 32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64zM192 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H224c-17.7 0-32-14.3-32-32zm32 96H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H224c-17.7 0-32-14.3-32-32s14.3-32 32-32zM0 448c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM.2 268.6c-8.2-6.4-8.2-18.9 0-25.3l101.9-79.3c10.5-8.2 25.8-.7 25.8 12.6V335.3c0 13.3-15.3 20.8-25.8 12.6L.2 268.6z"/></svg>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--              </div>--}}

{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5">--}}
{{--            <div--}}
{{--              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--            >--}}
{{--              <div class="flex-auto p-4">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                  <div--}}
{{--                    class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                  >--}}
{{--                    <h5--}}
{{--                      class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                    >--}}
{{--                     <span>Produit Retour</span>--}}
{{--                    </h5>--}}
{{--                    <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                      {{$total_retour}}--}}
{{--                    </span>--}}
{{--                  </div>--}}
{{--                  <div class="relative w-auto pl-4 flex-initial">--}}
{{--                    <div style="background-color: lightseagreen"--}}
{{--                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                    >--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M48.5 224H40c-13.3 0-24-10.7-24-24V72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8H48.5z"/></svg>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--              </div>--}}

{{--            </div>--}}
{{--          </div>--}}
{{--          <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5">--}}
{{--            <div--}}
{{--              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--            >--}}
{{--              <div class="flex-auto p-4">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                  <div--}}
{{--                    class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                  >--}}
{{--                    <h5--}}
{{--                      class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                    >--}}
{{--                     <span>Total</span>--}}
{{--                    </h5>--}}
{{--                    <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                      {{$total_operation}}--}}
{{--                    </span>--}}
{{--                  </div>--}}
{{--                  <div class="relative w-auto pl-4 flex-initial">--}}
{{--                    <div style="background-color: blue"--}}
{{--                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                    >--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M209.4 39.5c-9.1-9.6-24.3-10-33.9-.9L33.8 173.2c-19.9 18.9-19.9 50.7 0 69.6L175.5 377.4c9.6 9.1 24.8 8.7 33.9-.9s8.7-24.8-.9-33.9L66.8 208 208.5 73.4c9.6-9.1 10-24.3 .9-33.9zM352 64c0-12.6-7.4-24.1-19-29.2s-25-3-34.4 5.4l-160 144c-6.7 6.1-10.6 14.7-10.6 23.8s3.9 17.7 10.6 23.8l160 144c9.4 8.5 22.9 10.6 34.4 5.4s19-16.6 19-29.2V288h32c53 0 96 43 96 96c0 30.4-12.8 47.9-22.2 56.7c-5.5 5.1-9.8 12-9.8 19.5c0 10.9 8.8 19.7 19.7 19.7c2.8 0 5.6-.6 8.1-1.9C494.5 467.9 576 417.3 576 304c0-97.2-78.8-176-176-176H352V64z"/></svg>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--              </div>--}}

{{--            </div>--}}
{{--          </div>--}}
{{--            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5">--}}
{{--                <div--}}
{{--                    class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--                >--}}
{{--                    <div class="flex-auto p-4">--}}
{{--                        <div class="flex flex-wrap">--}}
{{--                            <div--}}
{{--                                class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                            >--}}
{{--                                <h5--}}
{{--                                    class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                                >--}}
{{--                                    <span>CA</span>--}}
{{--                                </h5>--}}
{{--                                <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                    {{$ca}}--}}
{{--                  </span>--}}
{{--                            </div>--}}
{{--                            <div class="relative w-auto pl-4 flex-initial">--}}
{{--                                <div style="background-color: blue"--}}
{{--                                     class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                                >--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M209.4 39.5c-9.1-9.6-24.3-10-33.9-.9L33.8 173.2c-19.9 18.9-19.9 50.7 0 69.6L175.5 377.4c9.6 9.1 24.8 8.7 33.9-.9s8.7-24.8-.9-33.9L66.8 208 208.5 73.4c9.6-9.1 10-24.3 .9-33.9zM352 64c0-12.6-7.4-24.1-19-29.2s-25-3-34.4 5.4l-160 144c-6.7 6.1-10.6 14.7-10.6 23.8s3.9 17.7 10.6 23.8l160 144c9.4 8.5 22.9 10.6 34.4 5.4s19-16.6 19-29.2V288h32c53 0 96 43 96 96c0 30.4-12.8 47.9-22.2 56.7c-5.5 5.1-9.8 12-9.8 19.5c0 10.9 8.8 19.7 19.7 19.7c2.8 0 5.6-.6 8.1-1.9C494.5 467.9 576 417.3 576 304c0-97.2-78.8-176-176-176H352V64z"/></svg>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}


        </div>
      </div>
    </div>
  </div>
{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >--}}


<div class="container">
    <h2 class="text-center font-bold text-black text-xl mt-4 mb-3">Statistiques</h2>

</div>
<div class="container-fluid">
    <div class="flex flex-wrap">
        <div id="mouvementsChartContainer" class="chart-container pie-chart w-full lg:w-1/2 bg-white p-4">
            <canvas id="mouvements_chart"></canvas>
            <h6 class="text-center text-blueGray-700 p-4 font-bold">Opérations par type de mouvement</h6>
        </div>
        <div id="caChartContainer" class="chart-container pie-chart w-full lg:w-1/2 bg-white p-4">
            <canvas id="ca_chart"></canvas>
            <h6 class="text-center text-blueGray-700 p-4 font-bold">Evolution CA</h6>
        </div>
    </div>
</div>
<div class="container-fluid mt-4">
    <div class="flex flex-wrap">
        <div id="statutChartContainer" class="chart-container pie-chart w-full lg:w-1/2 bg-white p-4">
            <canvas id="statut_chart"></canvas>
            <h6 class="text-center text-blueGray-700 p-4 font-bold">Opérations In par statut</h6>
        </div>
        <div id="operationChartContainer" class="chart-container pie-chart w-full lg:w-1/2 bg-white p-4">
            <canvas id="operation_chart"></canvas>
            <h6 class="text-center text-blueGray-700 p-4 font-bold">Total Opération par mois</h6>
        </div>
    </div>
</div>
<script>
    function setChartContainerWidth() {
        var mouvementsChartContainer = document.getElementById('mouvementsChartContainer');
        var statutChartContainer = document.getElementById('statutChartContainer');
        var operationChartContainer = document.getElementById('operationChartContainer');
        var caChartContainer = document.getElementById('caChartContainer');

        if (window.innerWidth >= 1024) { // Adjust the breakpoint as needed
            mouvementsChartContainer.classList.remove('w-full');
            mouvementsChartContainer.classList.add('w-1/2');
            statutChartContainer.classList.remove('w-full');
            statutChartContainer.classList.add('w-1/2');
            operationChartContainer.classList.remove('w-full');
            operationChartContainer.classList.add('w-1/2');
            caChartContainer.classList.remove('w-full');
            caChartContainer.classList.add('w-1/2');
        } else {
            mouvementsChartContainer.classList.add('w-full');
            statutChartContainer.classList.add('w-full');
            operationChartContainer.classList.add('w-full');
            caChartContainer.classList.add('w-full');
        }
    }

    // Initial call to set the width on page load
    setChartContainerWidth();

    // Listen for window resize events to update the width dynamically
    window.addEventListener('resize', setChartContainerWidth);
</script>

<script>

    $(function(){


        makechart();

        function makechart()
        {
            var mouvements=['In','Out','Retour'];
            var mouvements_color=['#a60303','#080f96','#da3a00'];
            var mouvements_total=[];

            var operations_par_etat = @json($operations_par_etat);

            for(let i=0 ;i<mouvements.length;i++){
                let exist = false;
                for (let j=0 ;j<operations_par_etat.length;j++){
                    if(mouvements[i]===operations_par_etat[j].etat){
                        exist = !exist;
                        mouvements_total[i] = operations_par_etat[j].count;
                    }
                }
                if (!exist){
                    mouvements_total[i] = 0;
                }
            }

            ////////////////////////////////////////////////////////////////////////////////////

            var status=['Valider_Automatique','Corrigée','Dérogée',"Annuler",'Pending'];
            var status_color=['#a60303','#080f96','#da3a00','#168abb','#face00'];
            var status_total=[];

            var in_operations_par_statut = @json($in_operations_par_statut);

            for(let i=0 ;i<status.length;i++){
                let exist = false;
                for (let j=0 ;j<in_operations_par_statut.length;j++){
                    if(status[i]===in_operations_par_statut[j].statut){
                        exist = !exist;
                        status_total[i] = in_operations_par_statut[j].count;
                    }
                }
                if (!exist){
                    status_total[i] = 0;
                }
            }

            ////////////////////////////////////////////////////////////////////////////////////

            var months= [
                'Janvier',
                'Fevrier',
                'Mars',
                'Avril',
                'Mai',
                'Juin',
                'Juillet',
                'Août',
                'Septembre',
                'Octobre',
                'Novembre',
                'Décembre'
            ];

            // console.log(months);
            // console.log(months);
            var operation_color=['#080f96','#080f96','#080f96','#080f96','#080f96','#080f96','#080f96','#080f96','#080f96','#080f96','#080f96','#080f96','#080f96'];
            var operation_total=[];
            var operation_par_mois = @json($operations_by_month);

            // Initialize an array with zeros for each month
            var resultArray = Array.from({ length: 12 }, () => 0);

// Loop through the original array and update the result array
            operation_par_mois.forEach(item => {
                resultArray[item.month - 1] = item.count;
            });


            ///////////////////////////////////////////////////////////////////////////////////////////

            var ca_color=['#8a1212','#8a1212','#8a1212','#8a1212','#8a1212','#8a1212','#8a1212','#8a1212','#8a1212','#8a1212','#8a1212','#8a1212','#8a1212'];
            var ca_total=[];
            var ca_par_mois = @json($ca_by_months);

            // Initialize an array with zeros for each month
            let resultArray1 = [];

// Loop through months 1 to 12
            for (let i = 1; i <= 12; i++) {
                // If the month exists in the original object, use its value, otherwise use 0
                resultArray1.push(ca_par_mois[i] || 0);
            }

            var mouvement_chart_data = {
                labels:mouvements,
                datasets:[
                    {
                        label:'Opérations par type de mouvement',
                        backgroundColor:mouvements_color,
                        data:mouvements_total
                    }
                ]
            };

            var status_chart_data = {
                labels:status,
                datasets:[
                    {
                        label:'Opérations In par statut',
                        backgroundColor:status_color,
                        data:status_total
                    }
                ]
            };

            var operation_chart_data = {
                labels:months,
                datasets:[
                    {
                        label:'Total Opérations par mois',
                        backgroundColor:operation_color,
                        data:resultArray
                    }
                ]
            };

            var ca_chart_data = {
                labels:months,
                datasets:[
                    {
                        label:'Evolution CA',
                        backgroundColor:ca_color,
                        data:resultArray1
                    }
                ]
            };

            var options = {
                responsive:true,
                scales:{
                    yAxes:[{
                        ticks:{
                            min:0
                        }
                    }]
                }
            };

            var group_chart1 = $('#mouvements_chart');

            var graph1 = new Chart(group_chart1, {
                type:"pie",
                data:mouvement_chart_data
            });

            var group_chart = $('#statut_chart');

            var graph = new Chart(group_chart, {
                type:"pie",
                data:status_chart_data
            });

            var group_chart2 = $('#operation_chart');

            var graph2 = new Chart(group_chart2, {
                type:'bar',
                data:operation_chart_data,
                options:options
            });

            var group_chart3 = $('#ca_chart');

            var graph3 = new Chart(group_chart3, {
                type:'bar',
                data:ca_chart_data,
                options:options
            });

            // var group_chart2 = $('#doughnut_chart');
            //
            // var graph2 = new Chart(group_chart2, {
            //     type:"doughnut",
            //     data:chart_data
            // });
            //
            // var group_chart3 = $('#bar_chart');
            //
            // var graph3 = new Chart(group_chart3, {
            //     type:'bar',
            //     data:chart_data,
            //     options:options
            // });

        }

    });

</script>
@endsection
