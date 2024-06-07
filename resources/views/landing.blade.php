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
                            <a href="/login_parent" style="background-color: #cd9f8e; border-radius: 24px"
                                class="btn btn-lg btn-block text-dark">GET SCHEDULE</a>
                            {{-- <button style="background-color: #cd9f8e; border-radius: 20px" class="btn btn-lg btn-block text-dark">GET SCHEDULE</button> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center mt-5 align-items-center">
                <img src="/images/1.png" width="80%" alt="">
            </div>
        </div>
        {{--  --}}
        <div class="row mt-5"></div>
        <hr>

        <div class="row mt-5">
            <div class="col-md-8">
                <div class="p-5" style="margin-top:100px">
                    <h3 class="fw-bolder">Why Vaccinate your Baby?</h3>
                    <p id="whyimmunized" style="font-size: 19px">Keeping your baby healthy and strong is every parent's
                        biggest wish. Just like we give our kids healthy food and keep them safe, vaccines are another
                        important way to protect them. Think of vaccines as a shield, a special shield that teaches your
                        baby's body how to fight off nasty bugs that can make them very sick. These bugs can cause serious
                        illnesses that might make your baby miss out on playtime and growing up strong.

                        You see, babies are born with their bodies still learning how to fight off germs. That's why
                        vaccines are super important, especially in the first few years of life. They help your baby's body
                        learn to recognize and fight off those bad bugs before they have a chance to cause trouble. It's
                        like giving your little one a head start in the battle against germs!

                        When you follow the recommended vaccine schedule, you're not just protecting your baby, but also
                        helping to protect other kids and even grown-ups who might be more vulnerable to getting sick. It's
                        like teamwork, we all play a part in keeping our community healthy and happy. Talk to your baby's
                        doctor to learn more about each vaccine and how it can help your child grow up healthy and strong.
                        Remember, vaccinating your baby is an act of love, giving them the best chance to live a long,
                        happy, and healthy life.</p>
                </div>
            </div>
            <div class="col-md-4 p-5 mt-5 justify-content-center align-items-center">
                <img width="100%" src="/images/2.png" alt="">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4 p-5 mt-5 justify-content-center align-items-center">
                <img width="100%" src="/images/whatisbakunako.png" alt="">
            </div>
            <div class="col-md-8 justify-content-center">
                <div class="p-5" style="margin-top: 130px">
                    <h3 class="fw-bolder">What is Bakunako?</h3>
                    <p id="whyimmunized" style="font-size: 19px">BakunAko knows how important your baby's health is. That's
                        why we created an easy way to keep them safe from dangerous illnesses. Think of vaccines as a shield
                        that teaches your baby's body how to fight off those nasty bugs. With BakunAko, it's easy to track
                        your baby's vaccinations and get reminders when it's time for the next one.

                        And there's more! BakunAko even gives you rewards for keeping your baby's vaccinations up-to-date.
                        Think of it as a thank you for helping your baby grow up happy and healthy!

                        Learn more about how BakunAko can protect your little one. Remember, vaccinating your baby is an act
                        of love. BakunAko is here to make it even easier!</p>
                </div>
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
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <img src="/images/BCG.png" height="200px" width="200px" class="card-img-top"
                            alt="Fissure in Sandstone" />
                        <div class="card-body" style="height: 250px">
                            <h5 class="card-title text-center">Bacillus Calmette–Guérin (BCG)</h5>
                            <p class="card-text text-center">Bacillus Calmette–Guérin (BCG) vaccine - is a live attenuated
                                vaccine derived from a strain of
                                Mycobacterium bovis that has been cultured and modified in such a way that it is safe for
                                human use.</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <img src="/images/HepatitisB.png" height="200px" width="200px" class="card-img-top"
                            alt="Fissure in Sandstone" />
                        <div class="card-body" style="height: 250px">
                            <h5 class="card-title text-center">Hepatitis B</h5>
                            <p class="card-text text-center">Hepatitis B vaccine is a highly effective prevention measure
                                that can protect individuals from
                                contracting the virus. The vaccine works by helping the immune system build antibodies to
                                fight off the
                                virus if exposed in the future</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <img src="/images/pentavalent-vaccine.png" height="200px" width="200px" class="card-img-top"
                            alt="Fissure in Sandstone" />
                        <div class="card-body" style="height: 250px">
                            <h5 class="card-title text-center">Pentavalent Vaccine</h5>
                            <p class="card-text text-center">Pentavalent vaccine is a combination vaccine that protects
                                against five different diseases. This vaccine
                                is administered to infants and young children to provide immunity against these potentially
                                dangerous
                                infections.</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <img src="/images/opv.png" class="card-img-top" height="200px" width="200px"
                            alt="Fissure in Sandstone" />
                        <div class="card-body" style="height: 250px">
                            <h5 class="card-title text-center">Oral Polio Vaccine (OPV)</h5>
                            <p class="card-text text-center">Oral Polio Vaccine (OPV) is a live attenuated vaccine that is
                                administered orally to provide immunity
                                against the poliovirus. Developed by Dr. Albert Sabin in the 1960s, OPV has played a crucial
                                role in the
                                global effort to eradicate polio.</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <img src="/images/ipv.png" class="card-img-top" height="200px" width="200px"
                            alt="Fissure in Sandstone" />
                        <div class="card-body" style="height: 250px">
                            <h5 class="card-title text-center">Inactivated Polio Vaccine (IPV)</h5>
                            <p class="card-text text-center">Inactivated Polio Vaccine (IPV) is a type of vaccine that is
                                used to protect against poliovirus, the
                                virus that causes polio. IPV is made using a virus that has been killed, or inactivated,
                                making it unable to
                                cause infection. When a person is vaccinated with IPV, their immune system recognizes the
                                inactivated
                                virus as a threat and produces antibodies to attack it.</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <img src="/images/pcv-v2.png" class="card-img-top" height="200px" width="200px"
                            alt="Fissure in Sandstone" />
                        <div class="card-body" style="height: 250px">
                            <h5 class="card-title text-center">Pneumococcal Conjugate Vaccine (PCV)</h5>
                            <p class="card-text text-center">Pneumococcal Conjugate Vaccine is a highly effective
                                immunization created using the conjugate
                                vaccine method. It is specifically designed to safeguard infants, young children, and adults
                                from
                                illnesses caused by the bacterium Streptococcus pneumoniae.</p>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-3">
                    <div class="card">
                        <img src="/images/mmr.png" class="card-img-top" height="200px" width="200px"
                            alt="Fissure in Sandstone" />
                        <div class="card-body" style="height: 250px">
                            <h5 class="card-title text-center">Measles, Mumps, Rubella (MMR)</h5>
                            <p class="card-text text-center">Measles, Mumps, Rubella (MMR) vaccine is a combination vaccine
                                that protects against three serious
                                and highly contagious viral diseases</p>

                        </div>
                    </div>
                </div>
                @foreach ($vaccines as $vaccine)
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <img src="/{{ $vaccine->dir }}" class="card-img-top" height="200px" width="200px"
                            alt="Fissure in Sandstone" />
                        <div class="card-body" style="height: 250px">
                            <h5 class="card-title text-center">{{ $vaccine->name }}</h5>
                            <p class="card-text text-center">{{ $vaccine->description }}</p>

                        </div>
                    </div>
                </div>
            @endforeach
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

    <!-- Move the modal code outside the content section -->
    <div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="privacyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="privacyModalLabel">Data Privacy Statement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your data privacy statement content goes here -->
                    <p>This is the data privacy statement of your website...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        window.onload = function() {
            $('#privacyModal').modal('show');
        };
    </script>
@endsection
