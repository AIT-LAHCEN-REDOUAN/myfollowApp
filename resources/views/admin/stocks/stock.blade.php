@extends('admin.layouts')
@section('data')

@can('Gestion_Stock')
    <h1 class="text-white text-center font-bold bg-gray-100 p-2 rounded" style="min-width: 100px!important;position: absolute;margin-top: 80px;margin-left: 30px;color:chartreuse">Stock</h1>

    <br>
    <br>
    <br>
    <div class='flex flex-col overflow-x-auto overflow-y-auto p-8' style="margin-top: 80px!important">
<form action="{{route('colie_export')}}" method="get">
  <button style="background-color:darkgreen"
  class=" text-white text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1  ease-linear transition-all duration-150"
  type="Submit"
>
  Export
</button>
</form>
<br>
        <form action="{{ route('stocks.index') }}" method="get">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative flex items-center">
                    <div class="relative flex-grow">
        <span class="z-10 h-full leading-snug font-normal text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
          <i class="fas fa-search"></i>
        </span>
                        <input
                            value="{{$reference??''}}"
                            name="reference"
                            type="text"
                            placeholder="Enter a Reference"
                            class="border-0 px-2 py-2 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
                        />
                    </div>
                </div>

                <div class="relative flex items-center m-2">
                    <div class="relative flex-grow">
        <span class="z-10 h-full leading-snug font-normal text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
          <i class="fas fa-search"></i>
        </span>
                        <input
                            value="{{$fournisseur??''}}"
                            name="fournisseur"
                            type="text"
                            placeholder="Fournisseur Name"
                            class="border-0 px-2 py-2 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
                        />
                    </div>
                </div>

                <div class="relative flex items-center">
                    <div class="relative flex-grow">
        <span class="z-10 h-full leading-snug font-normal text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
          <i class="fas fa-search"></i>
        </span>
                        <input
                            value="{{$designation??''}}"
                            name="designation"
                            type="text"
                            placeholder="Désignation"
                            class="border-0 px-2 py-2 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
                        />
                    </div>
                </div>



            </div>

            <button style="background-color:rgb(24, 160, 24);"
                    class="text-white text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mt-4 ml-2 ease-linear transition-all duration-150" type="Submit">
                Filter
            </button>
        </form>

        <br>
<div class='flex flex-col overflow-x-auto overflow-y-auto'>
    <table id="myTable" style="background-color: white!important; border-radius:20px" class='table-auto w-full '>
      <thead>
      <tr style="background-color: chartreuse" class='text-white font-light'>
          <th class='px-4 py-2 text-center'>QR Code</th>
          <th class='px-4 py-2 text-center'>Reference</th>
          <th class='px-4 py-2 text-center'>Désignation</th>
          <th class='px-4 py-2 text-center'>Quantite Disponible</th>
          <th class='px-4 py-2 text-center'>Fournisseur</th>
          <th class='px-4 py-2 text-center'>Prix</th>
          <th class='px-4 py-2 text-center'>CA</th>
          <th class="class='px-4 py-2 text-center" colspan="2" >Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($colie as $item)
        <tr>
          <td class='px-4 py-2 text-center'>
            {!!DNS2D::getBarcodeHTML("$item->Reference_colie","QRCODE",3,3)!!}
          </td>
          <td class='px-4 py-2 text-center'>{{$item->Reference_colie ?? "---"}}</td>
          <td class='px-4 py-2 text-center'>{{$item->colie->Designation ?? "---"}}</td>
          <td class='px-4 py-2 text-center'>{{$item->Quantite_Disponible ?? "---"}}</td>
          <td class='px-4 py-2 text-center'>{{$item->colie->Fournisseur->name ?? "---"}}</td>
          <td class='px-4 py-2 text-center'>{{$item->colie->Prix ?? "---"}}</td>
          <td class='px-4 py-2 text-center'>{{$item->ca}}</td>
      <td class='px-4 py-2 text-center'>
          <div class="flex">

        @can('Gestion_Stock')
            <div class="w-1/2">
<form id="delete-form-{{ $item->Reference_colie }}" action="{{ route('colies.destroy', ['coly'=>$item->Reference_colie])}}" method="POST">
          @csrf
          @method("DELETE")
          <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#d11566}</style><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
          </button>
        </form>
            </div>
        @endcan

    @can('Gestion_Stock')
                <div class="w-1/2">
                <a href="{{ route('colies.edit', ['coly'=>$item->Reference_colie])}}">
          <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#184ecd}</style><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
        </a>
                </div>
    @endcan
          </div>
      </td>


        </tr>
        @endforeach
      </tbody>

    </table>
    <div class="mt-5">
    {{$colie->links("pagination::tailwind")}}
    </div>
  </div>
    </div>

<!-- Continue with the rest of your HTML content -->
@endsection
@section('statistic')
{{--<div class="relative bg-red-600 md:pt-32 pb-32 pt-12">--}}
{{--    <div class="px-4 md:px-10 mx-auto w-full">--}}
{{--      <div class="flex flex-wrap">--}}
{{--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--          <div--}}
{{--            class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--          >--}}
{{--            <div class="flex-auto p-4">--}}
{{--              <div class="flex flex-wrap">--}}
{{--                <div--}}
{{--                  class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                >--}}
{{--                  <h5--}}
{{--                    class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                  >--}}
{{--                    Total Produits--}}
{{--                  </h5>--}}
{{--                  <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                    {{$total_colie}}--}}
{{--                  </span>--}}
{{--                </div>--}}
{{--                <div class="relative w-auto pl-4 flex-initial">--}}
{{--                  <div--}}
{{--                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"--}}
{{--                  >--}}
{{--                    <i class="far fa-chart-bar"></i>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--          <div--}}
{{--            class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--          >--}}
{{--            <div class="flex-auto p-4">--}}
{{--              <div class="flex flex-wrap">--}}
{{--                <div--}}
{{--                  class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                >--}}
{{--                  <h5--}}
{{--                    class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                  >--}}
{{--                    Total Fournisseurs--}}
{{--                  </h5>--}}
{{--                  <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                    {{$total_fournisseur}}--}}
{{--                  </span>--}}
{{--                </div>--}}
{{--                <div class="relative w-auto pl-4 flex-initial">--}}
{{--                  <div--}}
{{--                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"--}}
{{--                  >--}}
{{--                    <i class="fas fa-chart-pie"></i>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--          <div--}}
{{--            class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--          >--}}
{{--            <div class="flex-auto p-4">--}}
{{--              <div class="flex flex-wrap">--}}
{{--                <div--}}
{{--                  class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                >--}}
{{--                  <h5--}}
{{--                    class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                  >--}}
{{--                    Total Clients--}}
{{--                  </h5>--}}
{{--                  <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                    {{$total_destinataire}}--}}
{{--                  </span>--}}
{{--                </div>--}}
{{--                <div class="relative w-auto pl-4 flex-initial">--}}
{{--                  <div--}}
{{--                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"--}}
{{--                  >--}}
{{--                    <i class="fas fa-users"></i>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--          <div--}}
{{--            class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--          >--}}
{{--            <div class="flex-auto p-4">--}}
{{--              <div class="flex flex-wrap">--}}
{{--                <div--}}
{{--                  class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                >--}}
{{--                  <h5--}}
{{--                    class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                  >--}}
{{--                   <span>Produits En Cours</span>--}}
{{--                  </h5>--}}
{{--                  <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                    1--}}
{{--                  </span>--}}
{{--                </div>--}}
{{--                <div class="relative w-auto pl-4 flex-initial">--}}
{{--                  <div--}}
{{--                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                  >--}}
{{--                    <i class="fas fa-percent"></i>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--            </div>--}}

{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5 ">--}}
{{--          <div--}}
{{--            class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--          >--}}
{{--            <div class="flex-auto p-4">--}}
{{--              <div class="flex flex-wrap">--}}
{{--                <div--}}
{{--                  class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                >--}}
{{--                  <h5--}}
{{--                    class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                  >--}}
{{--                   <span>Produit In</span>--}}
{{--                  </h5>--}}
{{--                  <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                    {{$total_in}}--}}
{{--                  </span>--}}
{{--                </div>--}}
{{--                <div class="relative w-auto pl-4 flex-initial">--}}
{{--                  <div style="background-color: chartreuse"--}}
{{--                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                  >--}}
{{--                  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M392 32H56C25.1 32 0 57.1 0 88v336c0 30.9 25.1 56 56 56h336c30.9 0 56-25.1 56-56V88c0-30.9-25.1-56-56-56zm-108.3 82.1c0-19.8 29.9-19.8 29.9 0v199.5c0 19.8-29.9 19.8-29.9 0V114.1zm-74.6-7.5c0-19.8 29.9-19.8 29.9 0v216.5c0 19.8-29.9 19.8-29.9 0V106.6zm-74.7 7.5c0-19.8 29.9-19.8 29.9 0v199.5c0 19.8-29.9 19.8-29.9 0V114.1zM59.7 144c0-19.8 29.9-19.8 29.9 0v134.3c0 19.8-29.9 19.8-29.9 0V144zm323.4 227.8c-72.8 63-241.7 65.4-318.1 0-15-12.8 4.4-35.5 19.4-22.7 65.9 55.3 216.1 53.9 279.3 0 14.9-12.9 34.3 9.8 19.4 22.7zm5.2-93.5c0 19.8-29.9 19.8-29.9 0V144c0-19.8 29.9-19.8 29.9 0v134.3z"/></svg>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--            </div>--}}

{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5 ">--}}
{{--          <div--}}
{{--            class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--          >--}}
{{--            <div class="flex-auto p-4">--}}
{{--              <div class="flex flex-wrap">--}}
{{--                <div--}}
{{--                  class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                >--}}
{{--                  <h5--}}
{{--                    class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                  >--}}
{{--                   <span>Produit Out</span>--}}
{{--                  </h5>--}}
{{--                  <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                    {{$total_out}}--}}
{{--                  </span>--}}
{{--                </div>--}}
{{--                <div class="relative w-auto pl-4 flex-initial">--}}
{{--                  <div style="background-color: aqua"--}}
{{--                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                  >--}}
{{--                  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 64C0 46.3 14.3 32 32 32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64zM192 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H224c-17.7 0-32-14.3-32-32zm32 96H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H224c-17.7 0-32-14.3-32-32s14.3-32 32-32zM0 448c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM.2 268.6c-8.2-6.4-8.2-18.9 0-25.3l101.9-79.3c10.5-8.2 25.8-.7 25.8 12.6V335.3c0 13.3-15.3 20.8-25.8 12.6L.2 268.6z"/></svg>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--            </div>--}}

{{--          </div>--}}
{{--        </div>--}}

{{--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5">--}}
{{--          <div--}}
{{--            class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--          >--}}
{{--            <div class="flex-auto p-4">--}}
{{--              <div class="flex flex-wrap">--}}
{{--                <div--}}
{{--                  class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                >--}}
{{--                  <h5--}}
{{--                    class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                  >--}}
{{--                   <span>Produit Retour</span>--}}
{{--                  </h5>--}}
{{--                  <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                    {{$total_retour}}--}}
{{--                  </span>--}}
{{--                </div>--}}
{{--                <div class="relative w-auto pl-4 flex-initial">--}}
{{--                  <div style="background-color: lightseagreen"--}}
{{--                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                  >--}}
{{--                  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M48.5 224H40c-13.3 0-24-10.7-24-24V72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8H48.5z"/></svg>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--            </div>--}}

{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5">--}}
{{--          <div--}}
{{--            class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--          >--}}
{{--            <div class="flex-auto p-4">--}}
{{--              <div class="flex flex-wrap">--}}
{{--                <div--}}
{{--                  class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                >--}}
{{--                  <h5--}}
{{--                    class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                  >--}}
{{--                   <span>Total</span>--}}
{{--                  </h5>--}}
{{--                  <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                    {{$total_operation}}--}}
{{--                  </span>--}}
{{--                </div>--}}
{{--                <div class="relative w-auto pl-4 flex-initial">--}}
{{--                  <div style="background-color: blue"--}}
{{--                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                  >--}}
{{--                  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M209.4 39.5c-9.1-9.6-24.3-10-33.9-.9L33.8 173.2c-19.9 18.9-19.9 50.7 0 69.6L175.5 377.4c9.6 9.1 24.8 8.7 33.9-.9s8.7-24.8-.9-33.9L66.8 208 208.5 73.4c9.6-9.1 10-24.3 .9-33.9zM352 64c0-12.6-7.4-24.1-19-29.2s-25-3-34.4 5.4l-160 144c-6.7 6.1-10.6 14.7-10.6 23.8s3.9 17.7 10.6 23.8l160 144c9.4 8.5 22.9 10.6 34.4 5.4s19-16.6 19-29.2V288h32c53 0 96 43 96 96c0 30.4-12.8 47.9-22.2 56.7c-5.5 5.1-9.8 12-9.8 19.5c0 10.9 8.8 19.7 19.7 19.7c2.8 0 5.6-.6 8.1-1.9C494.5 467.9 576 417.3 576 304c0-97.2-78.8-176-176-176H352V64z"/></svg>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--            </div>--}}

{{--          </div>--}}
{{--        </div>--}}

{{--          <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5">--}}
{{--              <div--}}
{{--                  class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--              >--}}
{{--                  <div class="flex-auto p-4">--}}
{{--                      <div class="flex flex-wrap">--}}
{{--                          <div--}}
{{--                              class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                          >--}}
{{--                              <h5--}}
{{--                                  class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                              >--}}
{{--                                  <span>CA</span>--}}
{{--                              </h5>--}}
{{--                              <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                    {{$ca}}--}}
{{--                  </span>--}}
{{--                          </div>--}}
{{--                          <div class="relative w-auto pl-4 flex-initial">--}}
{{--                              <div style="background-color: blue"--}}
{{--                                   class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                              >--}}
{{--                                  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M209.4 39.5c-9.1-9.6-24.3-10-33.9-.9L33.8 173.2c-19.9 18.9-19.9 50.7 0 69.6L175.5 377.4c9.6 9.1 24.8 8.7 33.9-.9s8.7-24.8-.9-33.9L66.8 208 208.5 73.4c9.6-9.1 10-24.3 .9-33.9zM352 64c0-12.6-7.4-24.1-19-29.2s-25-3-34.4 5.4l-160 144c-6.7 6.1-10.6 14.7-10.6 23.8s3.9 17.7 10.6 23.8l160 144c9.4 8.5 22.9 10.6 34.4 5.4s19-16.6 19-29.2V288h32c53 0 96 43 96 96c0 30.4-12.8 47.9-22.2 56.7c-5.5 5.1-9.8 12-9.8 19.5c0 10.9 8.8 19.7 19.7 19.7c2.8 0 5.6-.6 8.1-1.9C494.5 467.9 576 417.3 576 304c0-97.2-78.8-176-176-176H352V64z"/></svg>--}}
{{--                              </div>--}}
{{--                          </div>--}}
{{--                      </div>--}}

{{--                  </div>--}}

{{--              </div>--}}
{{--          </div>--}}

{{--      </div>--}}
{{--    </div>--}}
{{--  </div>--}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[id^="delete-form-"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                Swal.fire({
                    title: 'Vous étes sur ?',
                    text: 'Vous voulez vraiment supprimer ca !',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui!',
                    cancelButtonText: 'Annuler',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Submit the form
                    }
                });
            });
        });
    });
</script>
@endcan

@endsection

