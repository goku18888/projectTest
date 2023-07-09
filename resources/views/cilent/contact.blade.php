<!DOCTYPE HTML>
<html>
    @include('cilent.layouts.header')
    <body>
		
        <div class="fh5co-loader"></div>
        
        <div id="page">
            @include('cilent.layouts.topbar')
    
        <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url('/storage/img/cilent/5.jpg');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <div class="display-t">
                            <div class="display-tc animate-box" data-animate-effect="fadeIn">
                                <h1>Contact Us</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <div id="fh5co-contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-md-push-1 animate-box">
                        
                        <div class="contact-info">
                            <h3>Contact Information</h3>
                            <ul>
                                <li class="fa-solid fa-location-dot"> 158 Pho Hue, <br> Hai Ba Trung, Ha Noi </li> <br>
                                <li class="fa-solid fa-phone"><a href="tel://0373362692"> +84 373362692</a></li><br>
                                <li class="fa-solid fa-envelope"><a href="mailto:hoctap438@gmail.com" target="_blank"> hoctap438@gmail.com</a></li>
                            </ul>
                        </div>
    
                    </div>
                    <div class="col-md-6 animate-box">
                        <h3>Liên Hệ</h3>
                        <form action="{{ route('us.storefeedback') }}" method="POST">
                            @csrf
                            {{-- <div class="row form-group">
                                <div class="col-md-6">
                                    <!-- <label for="fname">First Name</label> -->
                                    <input type="text" id="fname" class="form-control" placeholder="Your firstname">
                                </div>
                                <div class="col-md-6">
                                    <!-- <label for="lname">Last Name</label> -->
                                    <input type="text" id="lname" class="form-control" placeholder="Your lastname">
                                </div>
                            </div> --}}
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <!-- <label for="email">Email</label> -->
                                    <input type="text" id="email" class="form-control" placeholder="Email của bạn...">
                                </div>
                            </div>
    
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <!-- <label for="subject">Subject</label> -->
                                    <input type="text" id="subject" class="form-control" placeholder="Tiêu đề email của bạn..." name="subject">
                                </div>
                            </div>
    
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <!-- <label for="message">Message</label> -->
                                    <textarea name="something" id="message" cols="30" rows="10" class="form-control" placeholder="Hãy miêu tả vấn đề bạn đang gặp..."></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Gửi mail" class="btn btn-primary">
                            </div>
    
                        </form>		
                    </div>
                </div>
                
            </div>
        </div>
    
        <div id="map" class="animate-box" data-animate-effect="fadeIn">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.3928997986204!2d105.84938631478427!3d21.01695949355729!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab8d39861fbf%3A0x2ea8ea1e4014c6a7!2zQ2jhu6MgSMO0bSAtIMSQ4bupYyBWacOqbg!5e0!3m2!1svi!2s!4v1661828642357!5m2!1svi!2s" width="1900" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    
        @include('cilent.layouts.footer')
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="fa-solid fa-arrow-up"></i></a>
	</div>
	
	@include('cilent.layouts.jqueryBoostrap')
</html>