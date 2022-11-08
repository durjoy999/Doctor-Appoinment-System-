
     {{-- make an appointment start --}}
        <section id="appointment" data-stellar-background-ratio="3">
           <div class="container">
                    <div class="row">

                        <div class="col-md-6 col-sm-6">
                         @if (Session::has('MakeAppointment_create_success'))
                             <div class="alert alert-success">
                                 {{ Session::get('MakeAppointment_create_success') }}
                             </div>
                         @endif
                            <!-- CONTACT FORM HERE -->
                            <form action="{{ route('frontend.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- SECTION TITLE -->
                                <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                    <h2>Make an appointment</h2>
                                </div>

                                <div class="wow fadeInUp" data-wow-delay="0.8s">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Full Name">
                                                <label for="floatingInput">Full Name</label>
                                                @error('name')
                                                 <span class="text text-danger">{{$message}}</span>
                                                 @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone">
                                                <label for="floatingInput">Phone Number</label>
                                                @error('phone')
                                                 <span class="text text-danger">{{$message}}</span>
                                                 @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Full Your Email">
                                                <label for="floatingInput">Email address</label>
                                                 @error('email')
                                                 <span class="text text-danger">{{$message}}</span>
                                                 @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input type="dateTime-local" name="date" value="" class="form-control">
                                                <label for="floatingInput">Select Date</label>
                                                @error('date')
                                                 <span class="text text-danger">{{$message}}</span>
                                                 @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-floating mb-3">
                                                <select name="hospital" class="form-select">
                                                    <option value="">--Selete Hospital--</option>
                                                @foreach (WhichHospital() as $WhichHospital)
                                                    <option value={{ $WhichHospital->location }}>{{ $WhichHospital->location }}</option>
                                                @endforeach
                                                </select>
                                                @error('hospital')
                                                 <span class="text text-danger">{{$message}}</span>
                                                 @enderror
                                                <label for="floatingInput">Select Hospital</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12">

                                        <div class="form-floating">
                                            <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2" value="{{ old('description') }}" style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Additional Message</label>
                                            @error('description')
                                                 <span class="text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                            <button type="submit" class="form-control" id="cf-submit">Make an appointment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                         @if ($doctorPhotos !==  null)
                         <div class="col-md-6 col-sm-6">
                                <div class="avatar-xxl me-3">

                                    <img src="{{ asset('photo') }}/{{ $doctorPhotos->image }}" alt="" class="img-fluid rounded-circle d-block img-thumbnail">


                                </div>
                         </div>
                         @endif
                        </div>
           </div>
        </section>
     {{-- make an appointment end --}}
