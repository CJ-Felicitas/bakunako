@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div style="background-color: #FDEDD4;" class="alert alert-primary font-weight-bold text-dark">
                Recommended Vaccines and Schedules
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 text-justify">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="font-weight-bold text-dark">Vaccines play a crucial role in safeguarding infants from
                            life-threatening
                            diseases, ultimately preserving millions of lives annually.
                        </h5>
                        <p class="text-dark">For routine vaccines to be effective, it is crucial that infants receive the
                            required doses according to
                            the recommended schedule from birth until their first birthday. Additionally, infants should
                            also
                            receive any
                            necessary additional doses during supplementary vaccination campaigns or outbreak responses as
                            directed
                            by
                            the Department of Health. </p>
                            <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="font-weight-bold text-dark">Types of Vaccine</h5>
                        <div class="row">
                            <div class="col-md-12 text-dark">
                                <p><b>1. Vaccine: Bacillus Calmette–Guérin (BCG)</b> - is a live attenuated vaccine derived from a strain of
                                    Mycobacterium bovis that has been cultured and modified in such a way that it is safe for human use.</p>

                                       <div><b class="text-dark">When to Give: </b> <span class="text-dark">At Birth</span></div>
                                       <div><b class="text-dark">Protection From: </b> <span class="text-dark">Tuberculosis</span></div>
                                       <img src="/images/BCG.png" class="img-fluid" width="100%" alt="Responsive image">
                            </div>
                        </div>



                        <div class="row mt-5">
                            <div class="col-md-12 text-dark">
                                <hr>
                                <p><b class="text-dark">2. Hepatitis B</b> - Hepatitis B vaccine is a highly effective prevention measure that can protect individuals from
                                    contracting the virus. The vaccine works by helping the immune system build antibodies to fight off the
                                    virus if exposed in the future.</p>

                                       <div><b class="text-dark">When to Give: </b> <span class="text-dark">At Birth</span></div>
                                       <div class="text-dark"><b>Protection From: </b> <span>Hepatitis B</span></div>
                                       <img src="/images/HepatitisB.png" class="img-fluid" width="100%" alt="Responsive image">
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <hr>
                                <p><b>3. Pentavalent Vaccine</b> - Pentavalent vaccine is a combination vaccine that protects against five different diseases. This vaccine
                                    is administered to infants and young children to provide immunity against these potentially dangerous
                                    infections.</p>

                                       <div><b>When to Give: </b> <span>6, 10 and 14 weeks from Birth</span></div>
                                       <div><b>Protection From: </b> <span>Diphtheria, Pertussis, Tetanus, Haemophilus Influenzae type
                                        b and Hepatitis B</span></div>
                                       <img src="/images/pentavalent-vaccine.png" class="img-fluid" width="100%" alt="Responsive image">
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <hr>
                                <p><b>4. Oral Polio Vaccine (OPV)</b> - a live attenuated vaccine that is administered orally to provide immunity
                                    against the poliovirus. Developed by Dr. Albert Sabin in the 1960s, OPV has played a crucial role in the
                                    global effort to eradicate polio.</p>

                                       <div><b>When to Give: </b> <span>6, 10 and 14 weeks from Birth</span></div>
                                       <div><b>Protection From: </b> <span>Poliovirus</span></div>
                                       <img src="/images/opv.png" class="img-fluid" width="100%" alt="Responsive image">
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <hr>
                                <p><b>5. Inactivated Polio Vaccine (IPV)</b> - a type of vaccine that is used to protect against poliovirus, the
                                    virus that causes polio. IPV is made using a virus that has been killed, or inactivated, making it unable to
                                    cause infection. When a person is vaccinated with IPV, their immune system recognizes the inactivated
                                    virus as a threat and produces antibodies to attack it.</p>

                                       <div><b>When to Give: </b> <span>14 weeks from Birth</span></div>
                                       <div><b>Protection From: </b> <span>Poliovirus</span></div>
                                       <img src="/images/ipv.png" class="img-fluid" width="100%" alt="Responsive image">
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <hr>
                                <p><b>6. Pneumococcal Conjugate Vaccine (PCV)</b> -a highly effective immunization created using the conjugate
                                    vaccine method. It is specifically designed to safeguard infants, young children, and adults from
                                    illnesses caused by the bacterium Streptococcus pneumoniae.</p>

                                       <div><b>When to Give: </b> <span>6, 10 and 14 weeks from Birth</span></div>
                                       <div><b>Protection From: </b> <span>Pneumonia and Meningitis</span></div>
                                       <img src="/images/pcv-v2.png" class="img-fluid" width="100%" alt="Responsive image">
                            </div>
                        </div>

                        <div class="row mt-5 mb-5">
                            <div class="col-md-12">
                                <hr>
                                <p><b>7. Measles, Mumps, Rubella (MMR)</b> - vaccine is a combination vaccine that protects against three serious
                                    and highly contagious viral diseases</p>

                                       <div><b>When to Give: </b> <span>  1 year old and 9 months from Birth</span></div>
                                       <div><b>Protection From: </b> <span>Measles, Mumps and Rubella</span></div>
                                       <img src="/images/mmr.png" class="img-fluid" width="100%" alt="Responsive image">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>





    {{-- <div id="carouselExampleIndicators" class="carousel slide mt-3 mb-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href=""><img width="588px" height="700px" class="d-block w-100" src="/images/BCG.png"
                        alt="First slide"></a>
            </div>
            <div class="carousel-item">
                <a href=""><img width="588px" height="700px" class="d-block w-100" src="/images/HepatitisB.png"
                        alt="Second slide"></a>
            </div>
            <div class="carousel-item">
                <a href=""><img width="588px" height="700px" class="d-block w-100" src="/images/ipv.png"
                        alt="Third slide"></a>
            </div>
            <div class="carousel-item">
                <a href=""><img width="588px" height="700px" class="d-block w-100" src="/images/mmr.png"
                        alt="Fourth slide"></a>
            </div>
            <div class="carousel-item">
                <a href=""><img width="588px" height="700px" class="d-block w-100" src="/images/opv.png"
                        alt="Fifth slide"></a>
            </div>
            <div class="carousel-item">
                <a href=""><img width="588px" height="700px" class="d-block w-100" src="/images/pcv.png"
                        alt="Sixth slide"></a>
            </div>
            <div class="carousel-item">
                <a href=""><img width="588px" height="700px" class="d-block w-100" src="/images/pentavalent.png"
                        alt="Seventh slide"></a>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> --}}
@endsection
