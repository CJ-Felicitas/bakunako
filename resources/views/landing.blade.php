@extends('layouts.app')
@section('custom-css')
    <style>
        #whyimmunized {
            text-align: justify;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-5">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <!-- Left Content -->
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1 class="fw-bold">Schedule the vaccination of your baby today!</h1>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="text-center">
                            <button style="background-color: #cd9f8e; border-radius: 20px" class="btn btn-lg btn-block text-dark">GET SCHEDULE</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center mt-5 align-items-center">
                <img src="/images/image_one.png" width="80%" alt="">
            </div>
        </div>
        {{--  --}}
        <div class="row mt-5"></div>
        <hr>

        <div class="row mt-5">
            <div class="col-md-8">
                <div class="p-5">
                    <h3 class="fw-bolder">Why Immunize your baby?</h3>
                    <p id="whyimmunized">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took
                        a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of
                        the printing and typesetting industry. Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text.</p>
                </div>
            </div>
            <div class="col-md-4 p-5 justify-content-center align-items-center">
                <img width="100%" src="/images/why_image.png" alt="">
            </div>
        </div>
        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
        <hr>
        {{--  --}}
        <div class="row p-5">
            <div class="row align-items-center justify-content-center">
                <h3 class="text-center">About Vaccines</h3>
            </div>
           <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                        <div class="card-body" style="height: 250px">
                          <h5 class="card-title">Bacillus Calmette–Guérin (BCG)</h5>
                          <p class="card-text">Bacillus Calmette–Guérin (BCG) vaccine - is a live attenuated vaccine derived from a strain of
                            Mycobacterium bovis that has been cultured and modified in such a way that it is safe for human use.</p>

                        </div>
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                        <div class="card-body" style="height: 250px">
                          <h5 class="card-title" >Hepatitis B</h5>
                          <p class="card-text">Hepatitis B vaccine is a highly effective prevention measure that can protect individuals from
                            contracting the virus. The vaccine works by helping the immune system build antibodies to fight off the
                            virus if exposed in the future</p>

                        </div>
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                        <div class="card-body" style="height: 250px">
                          <h5 class="card-title">Pentavalent Vaccine</h5>
                          <p class="card-text">Pentavalent vaccine is a combination vaccine that protects against five different diseases. This vaccine
                            is administered to infants and young children to provide immunity against these potentially dangerous
                            infections.</p>

                        </div>
                      </div>
                </div>
           </div>
           <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                    <div class="card-body" style="height: 250px">
                      <h5 class="card-title">Oral Polio Vaccine (OPV)</h5>
                      <p class="card-text">Oral Polio Vaccine (OPV) is a live attenuated vaccine that is administered orally to provide immunity
                        against the poliovirus. Developed by Dr. Albert Sabin in the 1960s, OPV has played a crucial role in the
                        global effort to eradicate polio.</p>

                    </div>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                    <div class="card-body" style="height: 250px">
                      <h5 class="card-title">Inactivated Polio Vaccine (IPV)</h5>
                      <p class="card-text">Inactivated Polio Vaccine (IPV) is a type of vaccine that is used to protect against poliovirus, the
                        virus that causes polio. IPV is made using a virus that has been killed, or inactivated, making it unable to
                        cause infection. When a person is vaccinated with IPV, their immune system recognizes the inactivated
                        virus as a threat and produces antibodies to attack it.</p>

                    </div>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                    <div class="card-body" style="height: 250px">
                      <h5 class="card-title">Pneumococcal Conjugate Vaccine (PCV)</h5>
                      <p class="card-text">Pneumococcal Conjugate Vaccine is a highly effective immunization created using the conjugate
                        vaccine method. It is specifically designed to safeguard infants, young children, and adults from
                        illnesses caused by the bacterium Streptococcus pneumoniae.</p>

                    </div>
                  </div>
            </div>
       </div>
        </div>
        <div class="row mt-3 mb-5 justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                    <div class="card-body" style="height: 250px">
                      <h5 class="card-title">Measles, Mumps, Rubella (MMR)</h5>
                      <p class="card-text">Measles, Mumps, Rubella (MMR) vaccine is a combination vaccine that protects against three serious
                        and highly contagious viral diseases</p>

                    </div>
                  </div>
            </div>


       </div>
    </div>
    @if (session('reg_success'))
        <script>
            window.onload = function() {
                iziToast.success({
                    title: 'Registered',
                    message: 'User Registered Successfully',
                });
            };
        </script>
    @endif
@endsection
