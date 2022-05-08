@extends('layouts.front')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/front/css/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/jquery-ui.theme.min.css') }}">    
@endpush

@section('content')
<div class="new-home-banner" onclick="window.location='{{ route('front.find-space') }}'">
   <section id="homemain" class="banner newhome" style="background-image: url('assets/front/img/header-img.png')">
      <div class="container">
         <h2>Park or Dock at residential homes<br> <b>for a fraction of the price</b> </h2>
         @guest
         <a href="{{ route('front.choose-a-plan') }}" class="btn btn-primary btn-default get-started-btn">Get Started <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @endguest
         @admin
         <a href="{{ route('admin.dashboard.index') }}" class="btn btn-primary btn-default get-started-btn"> Go to dashboard   <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @endadmin
         @user
         <a href="{{ route('front.find-space') }}" class="btn btn-primary btn-default get-started-btn">Find a space
         <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @enduser
         @host
         <a href="{{ route('host.dashboard.index') }}" class="btn btn-primary btn-default get-started-btn"> Go to dashboard   <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @endhost       
      </div>
   </section>
</div>
<section class="newhome4">
   <div class="container">
      <h2 class="underlinee">Find a <span class="new-clr">Space</span></h2>
      <p>Select your vehicle or vessel type and search by City/Municipality.</p>
      <form action="{{ route('front.search-space') }}" autocomplete="off" >
      <div class="row">
         <div class="col" id="colone">
            <div class="searchtab">
               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="112.536"
                  height="42.181" viewBox="0 0 112.536 42.181">
                  <defs>
                     <clipPath id="clip-path">
                        <rect id="Rectangle_155" data-name="Rectangle 155" width="112.536" height="42.181"
                           fill="#ffffff" />
                     </clipPath>
                  </defs>
                  <g id="Group_52" data-name="Group 52" clip-path="url(#clip-path)">
                     <path id="Path_49" data-name="Path 49"
                        d="M0,13.886c.948-1.52,2.049-2.848,3.956-3.172a2.484,2.484,0,0,1,.65-.1c3.067.337,5.732-.916,8.429-2.084C18.547,6.143,24.079,3.8,29.589,1.406A16.629,16.629,0,0,1,36.423,0c6.2.039,12.4.025,18.605.008A22.12,22.12,0,0,1,64.6,2.136q10.351,4.852,20.727,9.65a6.451,6.451,0,0,0,2.517.553c6.014.105,11.942.684,17.531,3.113a27.968,27.968,0,0,1,3.947,2.157,6.732,6.732,0,0,1,3.192,5.932q.031,4.018,0,8.037a4.993,4.993,0,0,1-5.2,5.21,5.613,5.613,0,0,0-4.9,2.124,10.22,10.22,0,0,1-15.883-1.136,2.008,2.008,0,0,0-1.883-.949q-26.752.031-53.5,0a1.934,1.934,0,0,0-1.795.9A9.929,9.929,0,0,1,19.16,41.977a9.986,9.986,0,0,1-8.39-7.59c-.221-.762-.525-1.15-1.335-1.263-1.3-.182-2.583-.567-3.89-.719A6.537,6.537,0,0,1,0,28.86Zm105.727,5.388c-.453-.225-.805-.414-1.168-.578A37.455,37.455,0,0,0,89.12,15.7c-13.431-.087-26.863-.062-40.294-.016A7.937,7.937,0,0,1,42.2,12.663c-1.972-2.415-4.052-4.741-6.078-7.113-2.084-2.44-2.08-2.444-5.093-1.154-6.063,2.595-12.141,5.156-18.181,7.8a16.785,16.785,0,0,1-7.642,1.714,1.826,1.826,0,0,0-2.078,1.556,17.722,17.722,0,0,0-.018,2.2,18.232,18.232,0,0,1,2.01.014A1.59,1.59,0,0,1,6.59,19.433a1.555,1.555,0,0,1-1.6,1.506c-.609.031-1.221.006-1.9.006,0,2.157-.084,4.175.054,6.177a2.093,2.093,0,0,0,1.136,1.546c2.024.564,4.111.9,6.187,1.328A10.557,10.557,0,0,1,17,21.949a10.027,10.027,0,0,1,7.922.089,1.63,1.63,0,0,1,1,2.151,1.655,1.655,0,0,1-2.1.93c-.282-.074-.554-.191-.833-.279a7.13,7.13,0,1,0,4.942,5.6c-.148-1.27.4-2.122,1.43-2.166a1.539,1.539,0,0,1,1.749,1.455c.138,1.224.163,2.46.238,3.725H84.536V29.777c-.63,0-1.209.02-1.786,0a1.6,1.6,0,0,1-1.739-1.584,1.628,1.628,0,0,1,1.752-1.7c.806-.036,1.62.049,2.419-.036a1.647,1.647,0,0,0,1.055-.554c4.632-6.3,12.9-6.306,17.493.006.173.239.473.536.722.544,1.562.05,3.126.025,4.663.025V22.71c-1.278,0-2.45.026-3.62-.009a1.506,1.506,0,0,1-1.523-1.334,1.53,1.53,0,0,1,.963-1.782c.222-.1.455-.179.792-.31M47.435,3.369c2.562,2.991,4.956,5.818,7.406,8.6a1.867,1.867,0,0,0,1.268.381q10.57.034,21.14.014c.3,0,.61-.028,1.213-.057-.594-.3-.906-.47-1.226-.62-4.082-1.91-8.28-3.609-12.222-5.775-5.532-3.041-11.43-2.64-17.579-2.539M94.954,38.819a7.161,7.161,0,0,0,7.209-7.172,7.164,7.164,0,0,0-14.327-.064,7.107,7.107,0,0,0,7.119,7.235M50.768,12.344c-2.6-3.035-5.02-5.872-7.452-8.7-.112-.131-.285-.293-.432-.3-1.362-.023-2.725-.013-4.318-.013,2.409,2.8,4.588,5.418,6.888,7.927A4.2,4.2,0,0,0,47.668,12.3a17.645,17.645,0,0,0,3.1.041M105.405,33.4c3.042.707,4.324-.51,3.662-3.547h-3.662Z"
                        transform="translate(0 0)" fill="#ffffff" />
                     <path id="Path_50" data-name="Path 50"
                        d="M141.376,72.316c-4.66,0-9.32-.048-13.979.02a5.869,5.869,0,0,1-5.253-2.613c-1.165-1.646-2.461-3.2-3.581-4.875a2.245,2.245,0,0,1-.323-1.875,2.4,2.4,0,0,1,1.75-.974c2.232-.114,4.474-.07,6.712-.035a5.131,5.131,0,0,1,4.17,2.1c1.046,1.37,2.1,2.733,3.091,4.145a1.745,1.745,0,0,0,1.633.816c6.788-.027,13.576-.018,20.363-.012a4.61,4.61,0,0,1,1.2.1,1.5,1.5,0,0,1,1.188,1.636,1.52,1.52,0,0,1-1.449,1.531,9.454,9.454,0,0,1-1.1.028q-7.21,0-14.419,0m-18.164-6.941c1.475,3.221,3.727,4.336,6.988,3.463-1.906-3.442-3.211-4.089-6.988-3.463"
                        transform="translate(-81.147 -42.535)" fill="#ffffff" />
                     <path id="Path_51" data-name="Path 51"
                        d="M59.019,97.019a3.434,3.434,0,0,1-3.375-3.466,3.506,3.506,0,0,1,3.414-3.35,3.441,3.441,0,0,1,3.4,3.445,3.364,3.364,0,0,1-3.443,3.371"
                        transform="translate(-38.219 -61.957)" fill="#ffffff" />
                     <path id="Path_52" data-name="Path 52"
                        d="M295.864,97.02a3.374,3.374,0,0,1-3.368-3.449,3.458,3.458,0,0,1,3.375-3.367,3.5,3.5,0,0,1,3.445,3.428,3.419,3.419,0,0,1-3.452,3.388"
                        transform="translate(-200.907 -61.958)" fill="#ffffff" />
                  </g>
               </svg>
               <input type="radio" name="type" value="car" style="visibility: hidden">
               <h3>Car</h3>
            </div>
         </div>
         <div class="col" id="coltwo">
            <div class="searchtab">   
               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="106.119"
               height="39.801" viewBox="0 0 106.119 39.801">
               <defs>
                  <clipPath id="clip-path">
                     <rect id="Rectangle_17234" data-name="Rectangle 17234" width="106.119" height="39.801"
                        fill="#ffffff" />
                  </clipPath>
               </defs>
               <g id="Group_20485" data-name="Group 20485" clip-path="url(#clip-path)">
                  <path id="Path_28706" data-name="Path 28706"
                     d="M106.119,20.9c-.829-1.218-1.69-2.416-2.48-3.659a5.5,5.5,0,0,0-3.9-2.619q-12.643-2.2-25.271-4.492a3.237,3.237,0,0,1-1.442-.7C69.6,6.534,66.219,3.578,62.771.7A3.078,3.078,0,0,0,60.827,0C51.655.536,43.3,3.247,36.282,9.423a3.015,3.015,0,0,1-1.547.667c-7.778.94-15.564,1.818-23.342,2.762a8.014,8.014,0,0,0-6.176,4.06c-1.666,2.823-3.256,5.69-4.9,8.525a1.877,1.877,0,0,0,.165,2.3c1.547,2.034,3.033,4.115,4.636,6.1a2.748,2.748,0,0,0,1.707.941q14.4,1.215,28.806,2.308,15.391,1.153,30.792,2.19c3,.206,6.006.241,9,.467a23.16,23.16,0,0,0,13.442-3.377,72.368,72.368,0,0,0,17.255-14.223V20.9m-6.385,2.907a5.188,5.188,0,0,1-.361.462,63.161,63.161,0,0,1-11.1,8.624c-3.472,2.06-7.092,3.782-11.283,3.538-9.582-.557-19.164-1.11-28.741-1.756-7.612-.513-15.215-1.154-22.821-1.755q-8.621-.68-17.238-1.412a1.409,1.409,0,0,1-.908-.34c-1.2-1.5-2.347-3.034-3.555-4.615.315-.1.507-.179.707-.221a200.494,200.494,0,0,1,28.114-4.289,82.755,82.755,0,0,1,20.435.9,140.446,140.446,0,0,0,21.989,2.521,128.417,128.417,0,0,0,24.763-1.661m1.622-3.769c-.4.084-.759.187-1.125.232-4.143.51-8.277,1.134-12.434,1.489a116.488,116.488,0,0,1-29.927-1.41,107.6,107.6,0,0,0-16.224-1.935,140.234,140.234,0,0,0-28.809,2.809c-2.291.431-4.576.889-7.061,1.373.821-1.429,1.533-2.686,2.262-3.932a5.058,5.058,0,0,1,4.034-2.548c5.623-.653,11.242-1.344,16.865-2a78.509,78.509,0,0,1,8.337-.849c11.572-.1,23.144-.041,34.717-.037a7.745,7.745,0,0,1,1.339.091c8.358,1.472,16.708,2.995,25.078,4.4a3.572,3.572,0,0,1,2.948,2.315M53.382,4.595l.116-.344c2.183-.31,4.363-.647,6.552-.906a1.756,1.756,0,0,1,1.189.387c2.173,1.815,4.305,3.68,6.462,5.516a3.265,3.265,0,0,0,.706.354l-.258.309q-4.5,0-9-.007a.885.885,0,0,1-.57-.158c-1.742-1.706-3.466-3.431-5.194-5.151m.557,5.259H41.09A31.5,31.5,0,0,1,49.4,5.6a.959.959,0,0,1,.775.281c1.23,1.258,2.426,2.55,3.763,3.968"
                     transform="translate(0 0)" fill="#ffffff" />
                  <rect id="Rectangle_17230" data-name="Rectangle 17230" width="3.175" height="3.225" rx="1.588"
                     transform="translate(26.591 26.548)" fill="#ffffff" />
                  <rect id="Rectangle_17231" data-name="Rectangle 17231" width="3.175" height="3.225" rx="1.588"
                     transform="translate(19.957 26.548)" fill="#ffffff" />
                  <rect id="Rectangle_17232" data-name="Rectangle 17232" width="3.192" height="3.189" rx="1.594"
                     transform="translate(13.297 26.543)" fill="#ffffff" />
                  <rect id="Rectangle_17233" data-name="Rectangle 17233" width="3.196" height="3.189" rx="1.594"
                     transform="translate(69.683 14.936)" fill="#ffffff" />
               </g>
            </svg>          
               <input type="radio" name="type" value="boat" style="visibility: hidden">
               <h3>Boat</h3>
            </div>
         </div>
         <div class="col" id="colthree">
            <div class="searchtab">
               <svg xmlns="http://www.w3.org/2000/svg" width="116.667" height="54.098" viewBox="0 0 116.667 54.098">
                  <g id="Group_20546" data-name="Group 20546" transform="translate(-1707.115 -511.609)">
                     <path id="Path_28814" data-name="Path 28814"
                        d="M1841.153,588.844c-.295-1.154-1.512-.261-2.222-.135a134.441,134.441,0,0,1-17.042,1.676c-.971.039-2.768.845-2.811-.662-.039-1.435,1.763-.662,2.7-.686,5.453-.145,10.9-.2,16.23-1.816-.391-.019-.787-.034-1.179-.068-.671-.053-1.642.3-1.72-.758-.073-1,.86-.956,1.565-1.077a14.13,14.13,0,0,0,2.111-.444c1.927-.657,1.425-2.435,1.319-3.7-.111-1.285-1.4-.449-2.145-.449-1.526,0-3.053.188-4.579.217-4.584.092-9.173.179-13.757.193-1.386,0-1.85.464-1.541,1.84.444,1.971,1.449,3.193,3.618,3.12,1.526-.048,3.053-.063,4.579-.135.623-.029,1.2,0,1.217.763.015.72-.556.971-1.159.884-3.473-.507-7.463,1.512-10.308-2.092a.9.9,0,0,0-.42-.2,8.028,8.028,0,0,0-10.013,4.937c-.5,1.555-1.058,1.956-2.647,1.792-5-.517-10.047-1.657-14.9.9-.686.362-1.744.063-2.623.01-10.033-.642-20.065-1.319-30.1-1.932-4.057-.246-4.116-.174-4.956-4.13-.43-2.029-1.531-2.86-3.565-2.671-2.111.193-2.082,1.715-1.99,3.188.111,1.71.043,3.087-2.3,2.666-.488-.087-1.324-.13-1.222.7.087.715.879.584,1.406.536a2.276,2.276,0,0,1,2.681,1.652c1.232,2.821,6.777,3.193,8.366.546a2.684,2.684,0,0,1,3.043-1.459q23.686,1.971,47.376,3.821c1.251.1,1.575.831,2.034,1.671,1.937,3.526,5.188,3.966,8.738,3.686a7,7,0,0,0,6.057-4.5c1.309-2.85,3.019-3.12,5.183-.778,2.947,3.193,7.323,3.212,10.139-.039,1.082-1.246,1.9-2.517,3.734-3.067S1841.516,590.24,1841.153,588.844Zm-2.029-6.8c.039,1.816.039,1.816-1.9,2.323C1837.96,583.473,1838.482,582.83,1839.125,582.048Zm-16.515,2.942c-.865.671-1.758-.019-3.1-.652a7.633,7.633,0,0,0,3.159-1.72C1822.957,583.637,1823.237,584.5,1822.609,584.989Zm1.879-.266c.1-.9.889-1.212,1.372-2.029C1826.266,584.758,1826.266,584.758,1824.489,584.724Zm-8.627,9.617c-.145,2.217-1.922,4-3.845,3.864a4.047,4.047,0,0,1-3.4-4.526,3.748,3.748,0,0,1,3.942-3.686A3.994,3.994,0,0,1,1815.861,594.341Z"
                        transform="translate(-17.66 -35.591)" fill="#ffffff" />
                     <path id="Path_28815" data-name="Path 28815"
                        d="M1886.432,522.688a41.631,41.631,0,0,0-6.342-7.874,3.062,3.062,0,0,0-1.435-.831c-7.193-2.048-14.525-2.13-21.969-1.807.328,1.787,1.555,1.555,2.661,1.584,5.222.145,10.429.444,15.626,1.1,5.8.725,7.236,5.743,10.709,9.7-7.845,0-14.911,0-21.974,0-1.043,0-2.092-.188-2.5,1.217-.449,1.526-1.565,1.951-3.145,1.927-5.888-.082-11.781-.029-17.674-.029,0,.256,0,.512,0,.773a16.955,16.955,0,0,0,9.511,1.57,3.946,3.946,0,0,1,4.463,2.265,55.414,55.414,0,0,0,4.579,6.487,4.273,4.273,0,0,0,3.4,2.063q8.072-.3,16.134-.807c1.546-.1,2.637-3.033,1.662-4.217a1.158,1.158,0,0,0-.811-.4c-.546.015-.478.536-.536.9-.367,2.415-1.488,1.86-2.633.6a86.965,86.965,0,0,0-7.033-6.854c.787,0,1.57.029,2.352,0,3.772-.15,7.555-.232,11.322-.5C1887.046,529.262,1888.524,526.412,1886.432,522.688ZM1874.8,538.58c-2.333-.077-4.091-.43-5.69-2.014-1.459-1.449-2.69.425-4.169,1.13a10.561,10.561,0,0,0-5.7-5.734C1865.43,530.368,1870.241,532.392,1874.8,538.58Z"
                        transform="translate(-68.895 -0.22)" fill="#ffffff" />
                     <path id="Path_28816" data-name="Path 28816"
                        d="M1823.9,539.041c.29,2.208-.575,2.937-2.826,2.942s-3.019-.729-2.84-2.937a50.129,50.129,0,0,0,.01-6.023c-.082-2.251,1.5-1.845,2.816-1.85s2.922-.391,2.831,1.845c-.043,1.2,0,2.41,0,3.613A19.117,19.117,0,0,0,1823.9,539.041Z"
                        transform="translate(-57.433 -10.099)" fill="#ffffff" />
                     <path id="Path_28817" data-name="Path 28817"
                        d="M1779.566,511.692c-14.607,1.739-29.147,3.961-43.706,6.038-9.076,1.295-18.143,2.647-27.21,3.99-.642.092-1.609-.188-1.531,1,.082,1.232.961.8,1.613.7,3.811-.584,7.618-1.2,11.429-1.8a1.438,1.438,0,0,1,.773-.034s.01,0,.019,0a.009.009,0,0,1,.014,0c.614.193.329,1.068.391,1.633a17.4,17.4,0,0,1-.058,3.686v.029c-.063.623-.14,1.222-.213,1.845a23.076,23.076,0,0,0-.2,3.739c.068,1.406.159,2.806.246,4.212.073,1.121.14,2.241.188,3.362v.034c.077,1.58.121,3.159.092,4.743v.01c0,.184,0,.362-.01.546,0,.145.116.29.188.435-.377.8-1.111.5-1.7.488-3.217-.029-6.434-.121-9.651-.174-.522,0-1.271-.179-1.232.686.034.638.681.526,1.135.565.319.029.642.029.961.039,14.955.4,29.91.816,44.865,1.15,1.908.043,3.352.121,2.889,2.623-.1.531.034,1.237.773,1.275.961.048.99-.783.865-1.372-.522-2.459.87-2.6,2.7-2.386a11.822,11.822,0,0,0,2.41.048c1.734-.15,3.072.043,2.686,2.338-.082.483.121,1,.787.913a.8.8,0,0,0,.715-.831c.034-.642.034-1.285.034-1.932q.007-14.6,0-29.2c0-5.685.053-5.342,5.724-6.241,5.623-.9,10.438-.667,13.428,5.193C1788.212,513.735,1784.512,511.1,1779.566,511.692Zm-13.332,35.866c-5.84-.237-5.821-.15-5.893-6.048-.077-6.27-.2-12.54-.3-18.8-.039-2.521.71-3.367,3.145-3.5,2.942-.159,5.028,1.222,5.067,3.512.063,3.937.019,7.878.019,11.815,0,3.618-.068,7.236.029,10.854C1768.34,546.958,1768.084,547.63,1766.234,547.557Z"
                        transform="translate(0 0)" fill="#ffffff" />
                     <path id="Path_28818" data-name="Path 28818"
                        d="M1728.086,532.282c1.41-.107,1.444-.107,1.446,1.566q.01,11.336-.013,22.672c-.684-2.982,0-6.026-.383-9.143a16.305,16.305,0,0,1-1.96.392c-4.727.365-4.728.355-4.727-4.316,0-4.81.037-4.852,4.843-4.416a15.187,15.187,0,0,1,1.943.456c0-2.082-.024-4.074.012-6.066C1729.26,532.577,1728.827,532.3,1728.086,532.282Z"
                        transform="translate(-7.927 -10.667)" fill="#ffffff" />
                     <path id="Path_28819" data-name="Path 28819"
                        d="M1854.318,520.514c-.658-.907-1.487-.613-2.1-1.275,1.855,0,3.713-.061,5.564.018,1.664.071,4.334,3.758,4,5.373-.2.973-1,1.21-1.762,1.426a21.033,21.033,0,0,1-6.469.537c-1.107-.036-1.734-.606-1.546-1.662C1852.3,523.287,1850.738,520.676,1854.318,520.514Z"
                        transform="translate(-74.854 -3.932)" fill="#ffffff" />
                     <path id="Path_28820" data-name="Path 28820"
                        d="M1849.736,555.28c1.134,2.29,2.51,3.728,4.962,3.108,1.616-.408,2.209-1.643,2.254-3.27.123-4.413-3.452-3.049-6.338-3.575,4.953-1.185,5.882-.874,8.275,2.7,1.087,1.622,2.645,3.032,2.364,5.328-.132,1.079-.483,1.632-1.594,1.609-3.124-.064-6.249-.152-9.373-.157-1.03,0-1.216-.478-1.1-1.331C1849.361,558.339,1849.523,556.986,1849.736,555.28Z"
                        transform="translate(-73.428 -20.323)" fill="#ffffff" />
                     <path id="Path_28821" data-name="Path 28821"
                        d="M1821.077,541.982c-2.261.01-3.019-.729-2.84-2.937a50.129,50.129,0,0,0,.01-6.023c-.082-2.251,1.5-1.845,2.816-1.85s2.922-.391,2.831,1.845c-.043,1.2,0,2.41,0,3.613a19.117,19.117,0,0,0,.014,2.41C1824.193,541.248,1823.328,541.977,1821.077,541.982Z"
                        transform="translate(-57.433 -10.099)" fill="#ffffff" />
                     <path id="Path_28822" data-name="Path 28822"
                        d="M1797.145,545.212h-.48c-3.658,0-5.345-2.227-3.735-5.6,1.172-2.455,3.884-.839,5.877-1.175,1.071-.181,2.472-.258,2.709,1.24a19.526,19.526,0,0,1,.039,4.3c-.053.812-.708,1.215-1.529,1.225-.96.013-1.921,0-2.881,0Z"
                        transform="translate(-44.047 -13.757)" fill="#ffffff" />
                     <path id="Path_28823" data-name="Path 28823"
                        d="M1821.077,541.982c-2.261.01-3.019-.729-2.84-2.937a50.129,50.129,0,0,0,.01-6.023c-.082-2.251,1.5-1.845,2.816-1.85s2.922-.391,2.831,1.845c-.043,1.2,0,2.41,0,3.613a19.117,19.117,0,0,0,.014,2.41C1824.193,541.248,1823.328,541.977,1821.077,541.982Z"
                        transform="translate(-57.433 -10.099)" fill="#ffffff" />
                  </g>
               </svg>              
               <input type="radio" name="type" value="rv" style="visibility: hidden">
               <h3>RV</h3>
            </div>
         </div>
         {{-- <div class="row ser-row">
            <div class="search_box">
               <div class="input-group">
                  <input type="text" name="address" required id="address"  class="form-control rounded" placeholder="Search location" aria-label="Search"
                     aria-describedby="search-addon" />
                     <a href="javascript:void(0)" onclick="getLocation()"><img src="{{ asset('assets/front/img/my-location.png')}}"></a>
                     <input type="hidden" name="lng" id="lng">
                     <input type="hidden" name="lat" id="lat">

                  <button type="submit" class="btn btn-outline-primary">search</button>
               </div>
            </div>
         </div>  --}}
{{-- New Search start --}}
         <div class="row w-100 mt-5 p-lg-0">

            <div class="col-md-4 loc_input">
               <a href="javascript:void(0)" onclick="getLocation()"><img src="{{ asset('assets/front/img/my-location.png')}}"></a>
               <label>Location</label>
               <input class="form-control" type="text" name="address" id="address" required  placeholder="WHERE DO YOU WANT TO PARK?" aria-label="Search" value="{{ $_GET['address'] ?? '' }}">
               <input type="hidden" name="lng" id="lng" value="{{ $_GET['lng'] ?? '' }}">
               <input type="hidden" name="lat" id="lat" value="{{ $_GET['lat'] ?? '' }}">

           </div>
           <div class="col-md-2 arivall">
               <label>Arrival</label>
               <input type='text' name="arrival" class="form-control" id="input_dpick" value="" placeholder="YYYY MM DD" />
           </div>
           <div class="col-md-2 depart">
               <label>Departure</label>
               <input type='text' name="departure" class="form-control" id='input_dpick2' value="" placeholder="YYYY MM DD" />           

           </div>
           <div class="col-md-2 depart">
           <button type="submit" class="btn btn-outline-primary home-search-btn">search</button>
         </div>
      </div>
      {{-- New Search end --}}
   </form>
   </div>
</section>
<section class="newhome5">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <h2 class="underlinee"> Why <span class="new-clr">Parking</span><br> Genie</h2>
            <p>Parking Genie connects guests with verified hosts to grant one single wish; Save Money on Parking. Tired
               of
               paying overpriced sporting event parking prices; ask the Genie. Hotel parking prices impacting your
               vacation
               or get away budget; ask the Genie. Everyone wins with Parking Genie.
            </p>
            <p>Don’t forget to ask the Genie for a safe and convenient place to park your RV or dock your boat.</p>
         </div>
         <div class="col-md-6">
            <h2 class="underlinee">Your Very Own <br><span class="new-clr">Parking Business</span></h2>
            <p>Parking Genie allows residential and commercial owners or lease holders the potential to earn income by
               renting unused space to park vehicles or dock boats.
            </p>
            <p>Whether you have space in your drive way, an unused garage, boat dock or strip mall/office building
               space,
               list and allow Parking Genie to do the rest.
            </p>
         </div>
      </div>
   </div>
</section>
<section class="newhome6" id="ask-the-genie">
   <div class="container">
      <h2 class="underlinee" id="redclrh2">Ask The<span class="new-red-clr"> Genie</span></h2>
      <div class="row">
         <div class="col-md-6 ">
            <h2 class="underlinee-bottom"> GUESTS </h2>
            <div class="guest-f-row">
               <div class="guests-text">
                  <div class="col-md-6 ">
                     <div class="card">
                        <div class="card-body">
                           <div class="guest-img">
                              <img src="{{ asset('assets/front/img/g-1.png') }}">
                              <h5 class="card-title">Discovery</h5>
                           </div>
                           <p class="card-text">Our platform allows guests the ability quickly search and discover ideal
                              parking arrangements with vetted hosts for any occasion. Whether you are in need of a boat
                              dock,
                              or wanting to save on costly sporting event parking, allow the Genie to grant your parking
                              wish.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="card">
                        <div class="card-body">
                           <div class="guest-img">
                              <img src="{{ asset('assets/front/img/g-6.png') }}">
                              <h5 class="card-title">Book</h5>
                           </div>
                           <p class="card-text">Booking a space is as easy as conducting the search. Once a desirable
                              boat dock
                              or parking space has been located, allow the Parking Genie easy pay system to do the rest.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="card">
                        <div class="card-body">
                           <div class="guest-img">
                              <img src="{{ asset('assets/front/img/g-2.png') }}">
                              <h5 class="card-title">Park</h5>
                           </div>
                           <p class="card-text">Park and be confident our vetted Genie Hosts will safeguard your vehicle
                              throughout the duration of your booking.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <h2 class="underlinee-bottom"> HOSTS </h2>
            <div class="guests-text">
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-body">
                        <div class="guest-img">
                           <img src="{{ asset('assets/front/img/g-3.png') }}">
                           <h5 class="card-title">List Your Place</h5>
                        </div>
                        <p class="card-text">Turn your parking space, garage, driveway or boat dock into an effortless
                           income
                           producing business. There is no requirement to advertise or market, simply list a space and
                           allow
                           Parking Genie to do the rest.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-body">
                        <div class="guest-img">
                           <img src="{{ asset('assets/front/img/g-5.png') }}">
                           <h5 class="card-title">Accept Bookings</h5>
                        </div>
                        <p class="card-text">Parking Genie makes the booking process super easy for everyone. Once a
                           host
                           accepts a booking; the guest receives notification.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-body">
                        <div class="guest-img">
                           <img src="{{ asset('assets/front/img/g-4.png') }}">
                           <h5 class="card-title">Get Paid</h5>
                        </div>
                        <p class="card-text">Earn as much income as you desire by creating available space around your
                           homes,
                           commercial properties or waterways. Rent those spaces through the Parking Genie platform and
                           receive
                           payments immediately following acceptance of bookings.
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="cont-form">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <h2 class="underlinee">Contact<span class="new-clr"> us</span></h2>
            <p>Feel free to contact the Parking Genie team with any questions you may have. We are a team of dedicated
               Genies working to make parking wishes become reality.
            </p>
            <div class="iconcontact">
               <a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i></a>
               <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
               <a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
         </div>
         <div class="col-md-6" id="contact-col">
            @include('front.partials.contact')
         </div>
      </div>
   </div>
</section>
<div class="img-overly" onclick="window.location='{{ route('front.find-space') }}'">
   <section id="bottom-foot" style="background-image: url('assets/front/img/PaulGym06.png')">
      <div class="container">
         <h2>Start Booking on<br> <b>Parking Genie</b> </h2>
         @guest
         <a href="{{ route('front.choose-a-plan') }}" class="btn btn-primary btn-default get-started-btn">Get Started  <i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
         @endguest
         @admin
         <a href="{{ route('admin.dashboard.index') }}" class="btn btn-primary btn-default get-started-btn"> Go to dashboard   <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @endadmin
         @host
         <a href="{{ route('host.dashboard.index') }}" class="btn btn-primary btn-default get-started-btn"> Go to dashboard   <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @endhost      
      </div>
   </section>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.map_key') }}&callback=initMap&libraries=places&v=weekly"
async defer></script>
<script src="{{ asset('assets/front/js/map-list.js') }}"></script>

<script>
   let arrival = "{{ request()->arrival ?? null }}"
    let departure = "{{ request()->departure ?? null}}"
    $('#input_dpick, #input_dpick2').datepicker({
        dateFormat: 'yy-mm-dd',
        onClose: function () {
            $("#input_dpick2").datepicker(
                "change", {  minDate: new Date($('#input_dpick').val())  });
            }
    });
    if(arrival){
        $('#input_dpick').datepicker('setDate', new Date(arrival.replace(/-/g, ',')));
    }
    if(departure){
        $('#input_dpick2').datepicker('setDate', new Date(departure.replace(/-/g, ',')));
    }

    // To empty longitute and latitute inputs
    $(document).on('keyup', 'input[name="address"]', function(){
        if($(this).val() == ''){ $('#lng, #lat').val('') }
    })


</script>
<script>
   $(document).ready(function(){
      

      @if(Session::has('password-success'))
         toastr.success("{{ Session::get('password-success') }}");                                          
      @endif

   @if(Session::has('toastr.error'))
      toastr.options =
      {
         "closeButton": true,
         "progressBar": true,
         "positionClass": "toast-top-center",
      }
  		toastr.error("{{ session('toastr.error') }}");
  @endif
   @if(Session::has('toastr.success'))
      toastr.options =
      {
         "closeButton": true,
         "progressBar": true,
         "positionClass": "toast-top-center",
         "timeOut": 8000,

      }
  		toastr.success("{{ session('toastr.success') }}");
  @endif
});

</script>
@endpush