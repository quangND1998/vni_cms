@extends('landingpage.layout2')
@section('content')

        <div class="page_contact">
            <div class="container">
                 @if (session()->has('success'))
                   <h1>{{ session()->get('success') }} !</h1>
                 @endif
               
            </div>
        </div>

        <style>
            .single_page_contact{
                text-align: center;
            }
            .btn_hotline{
               margin: auto;
               margin-top:3rem;
                color:#ffff;
            }
            .title_form{
                margin-top:3rem;
                justify-content: center;
            }
            .form_contact{
                margin-top: 3rem;
                padding-bottom: 4rem;
            }
            .form-group{
                width: 50%;
                margin: auto;
                padding:1rem;
            }
            .form-control{
               height: 50px;
               border-radius: 8px;
            }
            .page_contact{
                padding-top: 12rem;
            }
            .input_contact{
                margin: auto;
            }
        </style>
@endsection


