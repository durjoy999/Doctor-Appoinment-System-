   {{-- make Which Hospital start --}}
        <div class="container-fluid pt-5">
                <div class="container mb-4">
                    <div class="">
                        <h1 class="">Which Hospital</h1>
                        <div class="divider mb-4"></div>
                    </div>
                    <div class="row">
                        @forelse ($WhichHospitals as $WhichHospital )
                        <div class="col-lg-4 mb-2">
                            <div class="card border-0 bg-light shadow-sm pb-2">
                                <img class="card-img-top mb-2" src="{{ asset('photo') }}/{{ $WhichHospital->image }}" alt={{ $WhichHospital->image }} />
                                <div class="card-body text-center">
                                    <div class="col-12 text-center mt-auto">
                                       <h4 class="card-title ">Hospital : {{ $WhichHospital->location }}</h4>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="card-title"><i class="fas fa-map-marker-alt px-2"> </i>{{ $WhichHospital->hospital_Location }}</h4>
                                    </div>

                                </div>
                                <div class="card-footer bg-transparent py-4 px-5">
                                    @forelse ($WhichHospital->hospitalSchedule as $hospitalSchedule)
                                       <div class="row border-bottom">
                                           <div class="col-6 py-1 text-right border-right">
                                               <strong>{{$hospitalSchedule->day}}</strong>
                                           </div>
                                           <div class="col-6 py-1 px-0" >{{$hospitalSchedule->time}}</div>
                                       </div>
                                    @empty
                                      no data
                                    @endforelse

                                    <div class="row border-bottom">
                                        <div class="col-6 py-1 text-right border-right">
                                            <strong>Total Seats</strong>
                                        </div>
                                        <div class="col-6 py-1 px-0">{{ $WhichHospital->seat }}Seats</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 py-1 text-right border-right">
                                            <strong>Doctor Fee</strong>
                                        </div>
                                        <div class="col-6 py-1 px-0">TK{{ $WhichHospital->fee}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            No data found
                        @endforelse

                    </div>
                    <div class="row">
                        <div class="col-12 text-center">

                            <a href="{{ route('frontend.WhichHospital') }}" class="btn btn-main-2 btn-round-full mt-3">Another Hospitals<i class="icofont-simple-right ml-2 "></i></a>
                        </div>
                    </div>
                </div>
        </div>
   {{-- make an Which Hospital start --}}
