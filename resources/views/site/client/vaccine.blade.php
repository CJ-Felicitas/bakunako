@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div style="background-color: #FDEDD4; font-size: 25px" class="alert text-center alert-primary font-weight-bold text-dark">
               Vaccine Description and Information
            </div>
        </div>
    </div>


    {{-- rule -> first entry first --}}
    @php
    $uniqueVaccines = collect($vaccines)->groupBy(function ($item) {
        // Extract the class name by splitting at the first space and taking the first part
        return explode(' ', $item->name)[0];
    })->map(function ($group) {
        // Return the first item of each group
        return $group->first();
    });
@endphp

@foreach ($uniqueVaccines as $vaccine)
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-3">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="/{{$vaccine->dir}}" style="max-width: 100%; max-height:100%" alt="">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="mt-3">{{ str_replace(range(0, 9), '', $vaccine->name) }}</div>
                                        <div>
                                            Protection from: {{$vaccine->protection_from}}
                                        </div>
                                        <div>
                                            When to give: {{$vaccine->when_to_give}}
                                        </div>

                                        <div class="mt-3">
                                            <button data-toggle="modal"
                                                    data-target="#{{ str_replace(' ', '', $vaccine->name) }}" id="#modalScroll" class="btn text-white" style="background-color: #C8A796">More Details</button>
                                        </div>
                                    </div>
                                    <div class="col-md-5 mt-3 d-flex justify-content-center">
                                        <img src="/images/2.png" class="mx-auto" style="max-width: 50%;" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Scrollable -->
    <div class="modal fade" id="{{ str_replace(' ', '', $vaccine->name) }}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{ str_replace(range(0, 9), '', $vaccine->name) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-bold">Vaccine: {{ str_replace(range(0, 9), '', $vaccine->name) }}</h5>
                    <p>{{$vaccine->description}}</p>

                    <div class="mt-3"><span class="font-weight-bold">Protection From :</span> {{$vaccine->protection_from}}</div>
                    <div>
                        <span class="font-weight-bold">When to give:</span> {{$vaccine->when_to_give}}
                    </div>
                    <div class="mt-3 text-align-justify">
                        {{$vaccine->protection_from_details}}
                    </div>
                    <div class="mt-3">
                        <div class="font-weight-bold">Sources: </div>
                        @if ($vaccine->source !=null)
                            <div class="mt-2">{{$vaccine->source}}</div>
                        @endif

                        @if ($vaccine->source_one !=null)
                            <div class="mt-2">{{$vaccine->source_one}}</div>
                        @endif

                        @if ($vaccine->source_two !=null)
                            <div class="mt-2">{{$vaccine->source_two}}</div>
                        @endif

                        @if ($vaccine->source_three !=null)
                            <div class="mt-2">{{$vaccine->source_three}}</div>
                        @endif

                        @if ($vaccine->source_four !=null)
                            <div class="mt-2">{{$vaccine->source_four}}</div>
                        @endif

                        @if ($vaccine->source_five !=null)
                            <div class="mt-2">{{$vaccine->source_five}}</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-white" style="background-color: #C8A796" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

    {{-- @foreach ($vaccines as $vaccine)
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-3">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="/{{$vaccine->dir}}" style="max-width: 100%; max-height:100%" alt="">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="mt-3">{{$vaccine->name}}</div>
                                        <div>
                                            Protection from:{{$vaccine->protection_from}}
                                        </div>
                                        <div>
                                            When to give: {{$vaccine->when_to_give}}
                                        </div>

                                        <div class="mt-3">
                                            <button data-toggle="modal"
                                            data-target="#{{ str_replace(' ', '', $vaccine->name) }}" id="#modalScroll" class="btn text-white" style="background-color: #C8A796">More Details</button>
                                        </div>
                                    </div>
                                    <div class="col-md-5 mt-3 d-flex justify-content-center">
                                        <img src="/images/2.png" class="mx-auto" style="max-width: 50%;" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




      <!-- Modal Scrollable -->
      <div class="modal fade" id="{{ str_replace(' ', '', $vaccine->name) }}" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">{{$vaccine->name}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="font-weight-bold">Vaccine: {{$vaccine->name}}</h5>
            <p>{{$vaccine->description}}</p>

                <div class="mt-3"><span class="font-weight-bold">Protection From :</span> {{$vaccine->protection_from}}</div>
                <div>
                    <span class="font-weight-bold">When to give:</span> {{$vaccine->when_to_give}}
                </div>
                <div class="mt-3 text-align-justify">
                    {{$vaccine->protection_from_details}}
                </div>
                <div>
                    Source:
                    @if ($vaccine->source !=null)
                    <div class="mt-2">{{$vaccine->source}}</div>
                    @endif

                    @if ($vaccine->source_one !=null)
                    <div class="mt-2">{{$vaccine->source_one}}</div>
                    @endif

                    @if ($vaccine->source_two !=null)
                    <div class="mt-2">{{$vaccine->source_two}}</div>
                    @endif

                    @if ($vaccine->source_three !=null)
                    <div class="mt-2">{{$vaccine->source_three}}</div>
                    @endif

                    @if ($vaccine->source_four !=null)
                    <div class="mt-2">{{$vaccine->source_four}}</div>
                    @endif

                    @if ($vaccine->source_five !=null)
                    <div class="mt-2">{{$vaccine->source_five}}</div>
                    @endif
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn text-white" style="background-color: #C8A796" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach --}}



      <!-- Modal Scrollable -->
      <div class="modal fade" id="bcg" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">BCG</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="font-weight-bold">Vaccine: Bacillus Calmette–Guérin (BCG)</h5>
            <p>Bacillus Calmette–Guérin (BCG) vaccine - is a live attenuated vaccine derived from a strain of
                Mycobacterium bovis that has been cultured and modified in such a way that it is safe for human use</p>

                <div class="mt-3"><span class="font-weight-bold">Protection From :</span> Tuberculosis</div>
                <div>
                   <span class="font-weight-bold">When to give:</span> At birth
                </div>
                <div class="mt-3 text-align-justify">
                    Tuberculosis (TB) is a contagious infection that primarily targets the lungs, although in infants
                    and young children, it can also affect other parts of the body such as the brain, bones, joints, and internal
                    organs (known as extrapulmonary or miliary tuberculosis). Severe cases of TB can lead to serious
                    complications. Fortunately, the BCG vaccine has been shown to provide protection against meningitis and
                    disseminated TB in children.
                    Tuberculosis (TB) is a challenging disease to treat once contracted, with treatment often being
                    lengthy and not always successful. The 2020 World Health Organization global TB report revealed that
                    the Philippines has the highest TB incidence rate in Asia, with 554 cases per 100,000 Filipinos.
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn text-white" style="background-color: #C8A796" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>



      <!-- Modal Scrollable -->
      <div class="modal fade" id="hepb" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Hepatitis B</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="font-weight-bold">Hepatitis B</h5>
            <p>Hepatitis B vaccine is a highly effective prevention measure that can protect individuals from
                contracting the virus. The vaccine works by helping the immune system build antibodies to fight off the
                virus if exposed in the future.</p>

                <div class="mt-3"><span class="font-weight-bold">Protection From :</span> Hepatitis B</div>
                <div>
                   <span class="font-weight-bold">When to give:</span> At birth
                </div>
                <div class="mt-3 text-align-justify">
                    Hepatitis B virus is a serious liver infection that, when contracted in infancy, often remains
asymptomatic for many years. However, if left untreated, it can progress to cirrhosis and liver cancer in
adulthood. Children under the age of 6 who contract the hepatitis B virus are at the highest risk of
developing chronic infections. Hepatitis B virus is a serious liver infection that, when contracted in
infancy, often remains asymptomatic for many years. However, if left untreated, it can progress to cirrhosis
and liver cancer in adulthood. Children under the age of 6 who contract the hepatitis B virus are at the
highest risk of developing chronic infections.
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" style="background-color: #C8A796" class="btn text-white" data-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>

      <!-- Modal Scrollable -->
      <div class="modal fade" id="penta" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Pentavalent Vaccine</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="font-weight-bold">Pentavalent Vaccine</h5>
            <p>Pentavalent vaccine is a combination vaccine that protects against five different diseases. This vaccine
                is administered to infants and young children to provide immunity against these potentially dangerous
                infections</p>

                <div class="mt-3"><span class="font-weight-bold">Protection From :</span> iphtheria, Pertussis, Tetanus, Haemophilus Influenzae type
                    b and Hepatitis B</div>
                <div>
                   <span class="font-weight-bold">When to give:</span> 6, 10 and 14 weeks from Birth
                </div>
                <div class="mt-3 text-align-justify">
                    Diphtheria is a bacterial infection that primarily affects the nose, throat, tonsils, and skin. The
diphtheria toxin produced by the bacteria can lead to the formation of obstructive pseudo-membranes in
the upper respiratory tract, which can result in difficulty breathing and swallowing, particularly in children.
In severe cases, diphtheria can cause paralysis, heart failure, kidney failure, and in some instances, death.
It is crucial to seek medical attention promptly if diphtheria is suspected, as early treatment can
significantly improve outcomes.
                </div>
                <div class="mt-3">
                    Pertussis, commonly known as whooping cough, is a highly contagious respiratory disease that
can result in prolonged coughing spells lasting for weeks. In severe cases, it can lead to difficulty
breathing, pneumonia, and other serious complications
                </div>
                <div class="mt-3">
                    Tetanus is a serious medical condition that results in excruciating muscle contractions. In children,
                    it can lead to the locking of neck and jaw muscles, a condition commonly known as lockjaw. This can
                    make it extremely difficult for children to perform basic functions such as opening their mouth,
                    swallowing, breastfeeding, or even breathing. Unfortunately, even with proper treatment, tetanus can often
                    prove to be fatal.
                </div>
                <div class="mt-3">
                    Haemophilus influenzae type b is a bacterium that can cause serious diseases such as meningitis
and pneumonia in infants and young children. These bacteria are commonly found in the human
nasopharynx and can be transmitted to others through droplets from nasopharyngeal secretions.
                </div>
                <div class="mt-3">
                    80-90% of infants infected with Hepatitis B within their first year of life are at a high risk of
                    developing chronic infections.
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn text-white" style="background-color: #C8A796" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

   <!-- Modal Scrollable -->
   <div class="modal fade" id="opv" tabindex="-1" role="dialog"
   aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalScrollableTitle">Oral Polio Vaccine (OPV)</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <h5 class="font-weight-bold">Oral Polio Vaccine (OPV)</h5>
         <p>Oral Polio Vaccine (OPV) is a live attenuated vaccine that is administered orally to provide immunity
            against the poliovirus. Developed by Dr. Albert Sabin in the 1960s, OPV has played a crucial role in the
            global effort to eradicate polio.</p>

             <div class="mt-3"><span class="font-weight-bold">Protection From :</span> Poliovirus</div>
             <div>
                <span class="font-weight-bold">When to give:</span> 6, 10 and 14 weeks from Birth
             </div>
             <div class="mt-3 text-align-justify">
                Polio is a highly contagious virus that affects approximately 1 in 200 individuals who become
                infected. Tragically, 5 to 10 percent of those cases result in death due to paralysis of the respiratory
                muscles. Once paralysis occurs, there is currently no known cure for polio.
             </div>
       </div>
       <div class="modal-footer">
         <button type="button" style="background-color: #C8A796" class="btn text-white" data-dismiss="modal">Close</button>

       </div>
     </div>
   </div>
 </div>

      <!-- Modal Scrollable -->
      <div class="modal fade" id="ipv" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Inactivated Polio Vaccine (IPV)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="font-weight-bold">Inactivated Polio Vaccine (IPV)</h5>
            <p> Inactivated Polio Vaccine (IPV) is a type of vaccine that is used to protect against poliovirus, the
                virus that causes polio. IPV is made using a virus that has been killed, or inactivated, making it unable to
                cause infection. When a person is vaccinated with IPV, their immune system recognizes the inactivated
                virus as a threat and produces antibodies to attack it.</p>

                <div class="mt-3"><span class="font-weight-bold">Protection From :</span> Poliovirus</div>
                <div>
                   <span class="font-weight-bold">When to give:</span> 14 weeks from Birth
                </div>
                <div class="mt-3 text-align-justify">
                    Polio is a highly contagious virus that affects approximately 1 in 200 individuals who become
                    infected. Tragically, 5 to 10 percent of those cases result in death due to paralysis of the respiratory
                    muscles. Once paralysis occurs, there is currently no known cure for polio.
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" style="background-color: #C8A796" class="btn text-white" data-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>

      <!-- Modal Scrollable -->
      <div class="modal fade" id="pcv" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Pneumococcal Conjugate Vaccine (PCV)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="font-weight-bold">Pneumococcal Conjugate Vaccine (PCV)</h5>
            <p> IPneumococcal Conjugate Vaccine is a highly effective immunization created using the conjugate
                vaccine method. It is specifically designed to safeguard infants, young children, and adults from
                illnesses caused by the bacterium Streptococcus pneumoniae.</p>

                <div class="mt-3"><span class="font-weight-bold">Protection From :</span> Poliovirus</div>
                <div>
                   <span class="font-weight-bold">When to give:</span> 14 weeks from Birth
                </div>
                <div class="mt-3 text-align-justify">
                    Pneumococcal diseases, such as pneumonia and meningitis, are prevalent worldwide, particularly
                    among children under 2 years old. These illnesses are a significant source of sickness and can have serious
                    consequences if left untreated.
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" style="background-color: #C8A796" class="btn text-white" data-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>

     <!-- Modal Scrollable -->
     <div class="modal fade" id="mmr" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-scrollable" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalScrollableTitle">Measles, Mumps, Rubella (MMR)</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <h5 class="font-weight-bold">Measles, Mumps, Rubella (MMR)</h5>
           <p> IPneumococcal Conjugate Vaccine is a highly effective immunization created using the conjugate
               vaccine method. It is specifically designed to safeguard infants, young children, and adults from
               illnesses caused by the bacterium Streptococcus pneumoniae.</p>

               <div class="mt-3"><span class="font-weight-bold">Protection From :</span> Measles, Mumps and Rubella</div>
               <div>
                  <span class="font-weight-bold">When to give:</span> 9 months and 1 year old from Birth
               </div>
               <div class="mt-3 text-align-justify">
                Measles is an extremely contagious disease characterized by symptoms such as fever, runny nose,
                white spots in the back of the mouth, and a rash. The most common complications associated with measles
                include ear infections, diarrhea, and pneumonia. In severe cases, measles can lead to blindness, brain
                swelling, and other serious health issues.
               </div>
         </div>
         <div class="modal-footer">
           <button type="button" style="background-color: #C8A796" class="btn text-white" data-dismiss="modal">Close</button>

         </div>
       </div>
     </div>
   </div>
@endsection
