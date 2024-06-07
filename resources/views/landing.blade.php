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


                @foreach ($a as $vaccine)
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <img src="/{{ $vaccine->dir }}" class="card-img-top" height="200px" width="200px"
                            alt="Fissure in Sandstone" />
                        <div class="card-body" style="height: 250px">
                            <h5 class="card-title text-center">{{ str_replace(range(0, 9), '', $vaccine->name) }}</h5>
                            <p class="card-text text-center">{{ $vaccine->description }}</p>

                        </div>
                    </div>
                </div>
                @endforeach
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
                    <h5 class="modal-title" id="privacyModalLabel">BakunAko Data Privacy Statement</h5>

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                 <div>
                    The right to privacy is a fundamental human right. Acknowledging this, the BakunAko, endeavors to safeguard its users’ data privacy by adhering to data privacy principles and employing standard safety measures in the collection, processing, disclosure and retention of personal data in accordance with the Data Privacy Act of 2012 (R.A. 10173), its Implementing Rules and Regulations (IRR) and to issuances of the National Privacy Commission.
                 </div>

                 <div class="mt-2">
                    At BakunAko, we are committed to protecting your privacy and ensuring the security of your personal information. This Data Privacy Statement outlines how we collect, use, disclose, and protect your data when you use the BakunAko system.
                 </div>

                 <div class="mt-2">
                    1. We collect personal information directly from you when you use the BakunAko system. This information includes but is not limited to your name, contact details, and any other information necessary to provide you with our services.
                 </div>

                 <div class="mt-2">
                    2. We use the personal information we collect to provide you with the services offered by the BakunAko system. This may include scheduling vaccination appointments, sending reminders, and facilitating communication between you and healthcare providers. We may also use your information for internal purposes such as improving our services and conducting research.
                 </div>

                 <div class="mt-2">3. Utmost care and due diligence are practiced by the BakunAko system in handling personal data. The BakunAko shall never share or disclose data to third-parties without prior consent from the data subjects. Whenever disclosure of data is necessary and permitted, the University conscientiously reviews the privacy and security policies of the authorized third-party service providers or external partners. The BakunAko may also be required to disclose data in compliance with legal or regulatory obligations.</div>

                 <div class="mt-2">4. We take the security of your personal information seriously and have implemented appropriate technical and organizational measures to protect it from unauthorized access, disclosure, alteration, or destruction. </div>

                 <div class="mt-2">5. We will retain your personal information for as long as necessary to fulfill the purposes outlined in this Data Privacy Statement, unless a longer retention period is required or permitted by law. </div>

                 <div class="mt-2">6. You have the right to access, and update, your personal information held by BakunAko. You may also have other rights depending on your jurisdiction, such as the right to restrict processing or data portability.</div>

                 <div class="mt-2">7. We may update this Data Privacy Statement from time to time to reflect changes in our practices or legal requirements. We will notify you of any material changes by posting the updated Privacy Statement on our website or through other appropriate channels. </div>

                 <div class="mt-2">8. If you have any questions or concerns about the BakunAko Data Privacy Statement or our privacy practices, please don’t hesitate to contact us through this email: bakunakodpo@gmail.com.</div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Agree</button>
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
