@extends('admin.layouts')
@section('data')

    <link
        href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css"
        rel="stylesheet"
    />
@can('modifier_utilisateur')
    <h1 class="text-white text-center font-bold bg-gray-100 p-2 rounded" style="min-width: 100px!important;position: absolute;margin-top: 80px;margin-left: 30px;color:darkred">Utilisateur / Modifier</h1>

    <br>
    <br>
    <br>
    <div class='flex flex-col overflow-x-auto overflow-y-auto p-8' style="margin-top: 80px!important">
{{--      @foreach ($data as $item)--}}
           <div class="mt-5 md:mt-0 md:col-span-2">
            <form enctype="multipart/form-data" action="{{route('users.update',["user"=>$item->id])}}" method="POST">
            @method("PUT")
          @csrf
          <div class="shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2 sm:col-span-1">
                  <label class="block text-sm font-medium text-gray-700">Email</label>
                  <input @required(true) value="{{$item->email}}"  type="email" name="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                </div>
                <div class="col-span-2 sm:col-span-1"> <!-- col-span-2 for full width on small screens, col-span-1 for half width on larger screens -->
                  <label class="block text-sm font-medium text-gray-700">Nom</label>
                  <input @required(true) value={{$item->name}}  type="text" name="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700">Matricule</label>
                    <input @required(true) type="text" name="matricule"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value={{$item->Matricule}}>
                </div>
                <div class="col-span-2 sm:col-span-1">
                  <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                  <input @required(true) value={{$item->original_password}} type="text" name="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700">Role</label>
                    <select @required(true) name="role" class="mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @foreach ($role as $r)
                        <option @if($item->id_role==$r->id) selected @endif value={{$r->id}}>{{$r->name}}</option>
                        @endforeach
                    </select>
                </div>
                  <div class="col-span-2 sm:col-span-1">
                      <label class="block text-sm font-medium text-gray-700">Permissions</label>
                      <div
                      >
                          <select @required(true)  name="permissions[]" multiple=""
                                   id="per_select"
                                   placeholder="Select Permissions..." autocomplete="off"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          >
                              @foreach ($permissions as $p)
                                  <option {{ $item->hasPermission($p->name) ? 'selected' : '' }} value="{{$p->id}}"> <span> {{$p->id}}      </span> {{$p->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
                  <script>
                                                      new TomSelect('#per_select', {
  maxItems: 300,
  plugins: {
    remove_button: {
      title: 'Remove this item',
    },
  },
  persist: false,
  create: true,
  onDelete: function (values) {
    // Always return true to skip the confirmation alert
    return true;
  },
});
                  </script>

                <div class="col-span-1 sm:col-span-1">
                  <button style="background-color: #de581e ;" type="submit" class="text-white font-bold py-2 px-4 rounded">
                    Submit
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
{{--      @endforeach--}}


  </div>
@endsection
@section('statistic')
{{--<div class="relative bg-red-600 md:pt-32 pb-32 pt-12">--}}
{{--  <div class="px-4 md:px-10 mx-auto w-full">--}}
{{--    <div class="flex flex-wrap">--}}
{{--      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--        <div--}}
{{--          class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--        >--}}
{{--          <div class="flex-auto p-4">--}}
{{--            <div class="flex flex-wrap">--}}
{{--              <div--}}
{{--                class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--              >--}}
{{--                <h5--}}
{{--                  class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                >--}}
{{--                  Total Produits--}}
{{--                </h5>--}}
{{--                <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                  {{$total_colie}}--}}
{{--                </span>--}}
{{--              </div>--}}
{{--              <div class="relative w-auto pl-4 flex-initial">--}}
{{--                <div--}}
{{--                  class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"--}}
{{--                >--}}
{{--                  <i class="far fa-chart-bar"></i>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--        <div--}}
{{--          class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--        >--}}
{{--          <div class="flex-auto p-4">--}}
{{--            <div class="flex flex-wrap">--}}
{{--              <div--}}
{{--                class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--              >--}}
{{--                <h5--}}
{{--                  class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                >--}}
{{--                  Total Fournisseurs--}}
{{--                </h5>--}}
{{--                <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                  {{$total_fournisseur}}--}}
{{--                </span>--}}
{{--              </div>--}}
{{--              <div class="relative w-auto pl-4 flex-initial">--}}
{{--                <div--}}
{{--                  class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"--}}
{{--                >--}}
{{--                  <i class="fas fa-chart-pie"></i>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--        <div--}}
{{--          class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--        >--}}
{{--          <div class="flex-auto p-4">--}}
{{--            <div class="flex flex-wrap">--}}
{{--              <div--}}
{{--                class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--              >--}}
{{--                <h5--}}
{{--                  class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                >--}}
{{--                  Total Clients--}}
{{--                </h5>--}}
{{--                <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                  {{$total_destinataire}}--}}
{{--                </span>--}}
{{--              </div>--}}
{{--              <div class="relative w-auto pl-4 flex-initial">--}}
{{--                <div--}}
{{--                  class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"--}}
{{--                >--}}
{{--                  <i class="fas fa-users"></i>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">--}}
{{--        <div--}}
{{--          class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--        >--}}
{{--          <div class="flex-auto p-4">--}}
{{--            <div class="flex flex-wrap">--}}
{{--              <div--}}
{{--                class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--              >--}}
{{--                <h5--}}
{{--                  class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                >--}}
{{--                 <span>Produits En Cours</span>--}}
{{--                </h5>--}}
{{--                <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                  1--}}
{{--                </span>--}}
{{--              </div>--}}
{{--              <div class="relative w-auto pl-4 flex-initial">--}}
{{--                <div--}}
{{--                  class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                >--}}
{{--                  <i class="fas fa-percent"></i>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--          </div>--}}

{{--        </div>--}}
{{--      </div>--}}
{{--      <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5 ">--}}
{{--        <div--}}
{{--          class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--        >--}}
{{--          <div class="flex-auto p-4">--}}
{{--            <div class="flex flex-wrap">--}}
{{--              <div--}}
{{--                class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--              >--}}
{{--                <h5--}}
{{--                  class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                >--}}
{{--                 <span>Produit In</span>--}}
{{--                </h5>--}}
{{--                <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                  {{$total_in}}--}}
{{--                </span>--}}
{{--              </div>--}}
{{--              <div class="relative w-auto pl-4 flex-initial">--}}
{{--                <div style="background-color: chartreuse"--}}
{{--                  class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                >--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M392 32H56C25.1 32 0 57.1 0 88v336c0 30.9 25.1 56 56 56h336c30.9 0 56-25.1 56-56V88c0-30.9-25.1-56-56-56zm-108.3 82.1c0-19.8 29.9-19.8 29.9 0v199.5c0 19.8-29.9 19.8-29.9 0V114.1zm-74.6-7.5c0-19.8 29.9-19.8 29.9 0v216.5c0 19.8-29.9 19.8-29.9 0V106.6zm-74.7 7.5c0-19.8 29.9-19.8 29.9 0v199.5c0 19.8-29.9 19.8-29.9 0V114.1zM59.7 144c0-19.8 29.9-19.8 29.9 0v134.3c0 19.8-29.9 19.8-29.9 0V144zm323.4 227.8c-72.8 63-241.7 65.4-318.1 0-15-12.8 4.4-35.5 19.4-22.7 65.9 55.3 216.1 53.9 279.3 0 14.9-12.9 34.3 9.8 19.4 22.7zm5.2-93.5c0 19.8-29.9 19.8-29.9 0V144c0-19.8 29.9-19.8 29.9 0v134.3z"/></svg>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--          </div>--}}

{{--        </div>--}}
{{--      </div>--}}
{{--      <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5 ">--}}
{{--        <div--}}
{{--          class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--        >--}}
{{--          <div class="flex-auto p-4">--}}
{{--            <div class="flex flex-wrap">--}}
{{--              <div--}}
{{--                class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--              >--}}
{{--                <h5--}}
{{--                  class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                >--}}
{{--                 <span>Produit Out</span>--}}
{{--                </h5>--}}
{{--                <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                  {{$total_out}}--}}
{{--                </span>--}}
{{--              </div>--}}
{{--              <div class="relative w-auto pl-4 flex-initial">--}}
{{--                <div style="background-color: aqua"--}}
{{--                  class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                >--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 64C0 46.3 14.3 32 32 32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64zM192 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H224c-17.7 0-32-14.3-32-32zm32 96H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H224c-17.7 0-32-14.3-32-32s14.3-32 32-32zM0 448c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM.2 268.6c-8.2-6.4-8.2-18.9 0-25.3l101.9-79.3c10.5-8.2 25.8-.7 25.8 12.6V335.3c0 13.3-15.3 20.8-25.8 12.6L.2 268.6z"/></svg>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--          </div>--}}

{{--        </div>--}}
{{--      </div>--}}

{{--      <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5">--}}
{{--        <div--}}
{{--          class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--        >--}}
{{--          <div class="flex-auto p-4">--}}
{{--            <div class="flex flex-wrap">--}}
{{--              <div--}}
{{--                class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--              >--}}
{{--                <h5--}}
{{--                  class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                >--}}
{{--                 <span>Produit Retour</span>--}}
{{--                </h5>--}}
{{--                <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                  {{$total_retour}}--}}
{{--                </span>--}}
{{--              </div>--}}
{{--              <div class="relative w-auto pl-4 flex-initial">--}}
{{--                <div style="background-color: lightseagreen"--}}
{{--                  class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                >--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M48.5 224H40c-13.3 0-24-10.7-24-24V72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8H48.5z"/></svg>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--          </div>--}}

{{--        </div>--}}
{{--      </div>--}}
{{--      <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5">--}}
{{--        <div--}}
{{--          class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--        >--}}
{{--          <div class="flex-auto p-4">--}}
{{--            <div class="flex flex-wrap">--}}
{{--              <div--}}
{{--                class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--              >--}}
{{--                <h5--}}
{{--                  class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                >--}}
{{--                 <span>Total</span>--}}
{{--                </h5>--}}
{{--                <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                  {{$total_operation}}--}}
{{--                </span>--}}
{{--              </div>--}}
{{--              <div class="relative w-auto pl-4 flex-initial">--}}
{{--                <div style="background-color: blue"--}}
{{--                  class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                >--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M209.4 39.5c-9.1-9.6-24.3-10-33.9-.9L33.8 173.2c-19.9 18.9-19.9 50.7 0 69.6L175.5 377.4c9.6 9.1 24.8 8.7 33.9-.9s8.7-24.8-.9-33.9L66.8 208 208.5 73.4c9.6-9.1 10-24.3 .9-33.9zM352 64c0-12.6-7.4-24.1-19-29.2s-25-3-34.4 5.4l-160 144c-6.7 6.1-10.6 14.7-10.6 23.8s3.9 17.7 10.6 23.8l160 144c9.4 8.5 22.9 10.6 34.4 5.4s19-16.6 19-29.2V288h32c53 0 96 43 96 96c0 30.4-12.8 47.9-22.2 56.7c-5.5 5.1-9.8 12-9.8 19.5c0 10.9 8.8 19.7 19.7 19.7c2.8 0 5.6-.6 8.1-1.9C494.5 467.9 576 417.3 576 304c0-97.2-78.8-176-176-176H352V64z"/></svg>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--          </div>--}}

{{--        </div>--}}
{{--      </div>--}}
{{--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4 p-5">--}}
{{--            <div--}}
{{--                class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"--}}
{{--            >--}}
{{--                <div class="flex-auto p-4">--}}
{{--                    <div class="flex flex-wrap">--}}
{{--                        <div--}}
{{--                            class="relative w-full pr-4 max-w-full flex-grow flex-1"--}}
{{--                        >--}}
{{--                            <h5--}}
{{--                                class="text-blueGray-400 uppercase font-bold text-xs"--}}
{{--                            >--}}
{{--                                <span>CA</span>--}}
{{--                            </h5>--}}
{{--                            <span class="font-semibold text-xl text-blueGray-700">--}}
{{--                    {{$ca}}--}}
{{--                  </span>--}}
{{--                        </div>--}}
{{--                        <div class="relative w-auto pl-4 flex-initial">--}}
{{--                            <div style="background-color: blue"--}}
{{--                                 class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500"--}}
{{--                            >--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M209.4 39.5c-9.1-9.6-24.3-10-33.9-.9L33.8 173.2c-19.9 18.9-19.9 50.7 0 69.6L175.5 377.4c9.6 9.1 24.8 8.7 33.9-.9s8.7-24.8-.9-33.9L66.8 208 208.5 73.4c9.6-9.1 10-24.3 .9-33.9zM352 64c0-12.6-7.4-24.1-19-29.2s-25-3-34.4 5.4l-160 144c-6.7 6.1-10.6 14.7-10.6 23.8s3.9 17.7 10.6 23.8l160 144c9.4 8.5 22.9 10.6 34.4 5.4s19-16.6 19-29.2V288h32c53 0 96 43 96 96c0 30.4-12.8 47.9-22.2 56.7c-5.5 5.1-9.8 12-9.8 19.5c0 10.9 8.8 19.7 19.7 19.7c2.8 0 5.6-.6 8.1-1.9C494.5 467.9 576 417.3 576 304c0-97.2-78.8-176-176-176H352V64z"/></svg>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--  </div>--}}
{{--</div>--}}
@endcan

@endsection
