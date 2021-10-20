<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Supawat's App</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/aos.css?ver=1.1.0" rel="stylesheet">
    <link href="css/bootstrap.min.css?ver=1.1.0" rel="stylesheet">
    <link href="css/main.css?ver=1.1.0" rel="stylesheet">
    <noscript>
        <style type="text/css">
            [data-aos] {
                opacity: 1 !important;
                transform: translate(0) scale(1) !important;
            }
        </style>
    </noscript>

</head>

<body id="top">
    <header>
        <div class="profile-page sidebar-collapse">
            <nav class="navbar navbar-expand-lg fixed-top navbar-transparent bg-primary" color-on-scroll="400">
                <div class="container">
                    <div class="navbar-translate">
                        {{-- <a class="navbar-brand" href="#" rel="tooltip">Creative CV</a> --}}
                        <a class="btn btn-primary" href="{{ url('/home') }}" data-aos="zoom-in" data-aos-anchor="data-aos-anchor">Sample Code 
                            <i class="fa fa-cogs"
                            aria-hidden="true"></i></a>
                        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navigation" aria-controls="navigation" aria-expanded="false"
                            aria-label="Toggle navigation"><span class="navbar-toggler-bar bar1"></span><span
                                class="navbar-toggler-bar bar2"></span><span
                                class="navbar-toggler-bar bar3"></span></button>
                    </div>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link smooth-scroll" href="#about" >About</a></li>
                            <li class="nav-item"><a class="nav-link smooth-scroll" href="#skill">Skills</a></li>
                            {{-- <li class="nav-item"><a class="nav-link smooth-scroll" href="#portfolio">Portfolio</a></li> --}}
                            <li class="nav-item"><a class="nav-link smooth-scroll" href="#experience">Experience</a>
                            {{-- <li class="nav-item"><a class="nav-link smooth-scroll" href="#contact">Contact</a></li>
                            --}}
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div class="page-content">
        <div>
            <div class="profile-page">
                <div class="wrapper">
                    <div class="page-header page-header-small" filter-color="green">
                        <div class="page-header-image" data-parallax="true"
                            style="background-image: url('images/cc-bg-1.jpg')"></div>
                        <div class="container">
                            <div class="content-center">
                                <div class="cc-profile-image"><a style="cursor: default;"><img src="images/supawat.jpg"
                                            alt="Image" /></a></div>
                                <div class="h2 title">Supawat Pothisomphop</div>
                                <p class="category text-white">Web Developer, IT Consultant</p>
                                {{-- <a
                                    class="btn btn-primary smooth-scroll mr-2" href="#contact" data-aos="zoom-in"
                                    data-aos-anchor="data-aos-anchor">Hire Me</a> --}}
                                <a class="btn btn-primary" href="files/Supawat_resume_skillset.pdf"
                                    data-aos="zoom-in" data-aos-anchor="data-aos-anchor">Download Full CV</a>
                            </div>
                        </div>
                        <div class="section">
                            <div class="container">
                                <div class="button-container">
                                    <a class="btn btn-default btn-round btn-lg btn-icon" href="https://www.facebook.com/Zloctear" target="_blank" rel="tooltip" ><i
                                            class="fa fa-facebook"></i></a>
                                    {{-- <a class="btn btn-default btn-round btn-lg btn-icon" href="#" rel="tooltip"
                                        title="Follow me on Twitter"><i class="fa fa-twitter"></i></a>
                                    <a class="btn btn-default btn-round btn-lg btn-icon" href="#" rel="tooltip"
                                        title="Follow me on Google+"><i class="fa fa-google-plus"></i></a> --}}
                                    <a class="btn btn-default btn-round btn-lg btn-icon" href="https://www.instagram.com/park_lightyear/" target="_blank" rel="tooltip"
                                        ><i class="fa fa-instagram"></i></a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="about">
                <div class="container">
                    <div class="card" data-aos="fade-up" data-aos-offset="10">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card-body">
                                    <div class="h4 mt-0 title">About</div>
                                    <p>Hello. I am Supawat Pothisomphop [Park].
                                    </p>
                                    <p>I graduated with a major multimedia technology. because first I interested in graphic and multimedia platform but after studying I think I'm not suitable in this way. then I become a developer and i can do it. I can self learning about programming language, framework and many tools.
                                        {{-- <a href="https://templateflip.com/templates/creative-cv/" target="_blank">Learn
                                            More</a> --}}
                                        </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card-body">
                                    <div class="h4 mt-0 title">Basic Information</div>
                                    <div class="row">
                                        <div class="col-sm-4"><strong class="text-uppercase">Age:</strong></div>
                                        <div class="col-sm-8">28</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-4"><strong class="text-uppercase">Email:</strong></div>
                                        <div class="col-sm-8">supawat@pothisomphop.com</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-4"><strong class="text-uppercase">Phone:</strong></div>
                                        <div class="col-sm-8">0837060457</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-4"><strong class="text-uppercase">Address:</strong></div>
                                        <div class="col-sm-8">111/309 Soi Lasalle 32,  Sukhumvit 105 Road, Bangna, Bangkok 10260</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="skill">
                <div class="container">
                    <div class="h4 text-center mb-4 title">Main Professional Skills</div>
                    <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="progress-container progress-primary"><span
                                            class="progress-badge">HTML / CSS / JS</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                                data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 100%;"></div><span class="progress-value">Experienced</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="progress-container progress-primary"><span
                                            class="progress-badge">UI / UX </span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                                data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 75%;"></div><span class="progress-value">Intermediate</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="progress-container progress-primary"><span
                                            class="progress-badge">PHP [Laravel]</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                                data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 75%;"></div><span class="progress-value">Intermediate</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="progress-container progress-primary"><span
                                            class="progress-badge">SQL</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                                data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 75%;"></div><span class="progress-value">Intermediate</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="progress-container progress-primary"><span
                                            class="progress-badge">Git</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                                data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 75%;"></div><span class="progress-value">Intermediate</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="progress-container progress-primary"><span
                                            class="progress-badge">Apache</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                                data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 50%;"></div><span class="progress-value">Basic</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="progress-container progress-primary"><span
                                            class="progress-badge">Agile / Scrum</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                                data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 25%;"></div><span class="progress-value">Concept</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="progress-container progress-primary"><span
                                            class="progress-badge">Apache</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                                data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 50%;"></div><span class="progress-value">Basic</span>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="section" id="portfolio">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 ml-auto mr-auto">
                            <div class="h4 text-center mb-4 title">Portfolio</div>
                            <div class="nav-align-center">
                                <ul class="nav nav-pills nav-pills-primary" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                            href="#web-development" role="tablist"><i class="fa fa-laptop"
                                                aria-hidden="true"></i></a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#graphic-design"
                                            role="tablist"><i class="fa fa-picture-o" aria-hidden="true"></i></a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Photography"
                                            role="tablist"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content gallery mt-5">
                        <div class="tab-pane active" id="web-development">
                            <div class="ml-auto mr-auto">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#web-development">
                                                <figure class="cc-effect"><img src="images/project-1.jpg" alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Recent Project</div>
                                                        <p>Web Development</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#web-development">
                                                <figure class="cc-effect"><img src="images/project-2.jpg" alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Startup Project</div>
                                                        <p>Web Development</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#web-development">
                                                <figure class="cc-effect"><img src="images/project-3.jpg" alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Food Order Project</div>
                                                        <p>Web Development</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#web-development">
                                                <figure class="cc-effect"><img src="images/project-4.jpg" alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Web Advertising Project</div>
                                                        <p>Web Development</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="graphic-design" role="tabpanel">
                            <div class="ml-auto mr-auto">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#graphic-design">
                                                <figure class="cc-effect"><img src="images/graphic-design-1.jpg"
                                                        alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Triangle Pattern</div>
                                                        <p>Graphic Design</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#graphic-design">
                                                <figure class="cc-effect"><img src="images/graphic-design-2.jpg"
                                                        alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Abstract Umbrella</div>
                                                        <p>Graphic Design</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#graphic-design">
                                                <figure class="cc-effect"><img src="images/graphic-design-3.jpg"
                                                        alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Cube Surface Texture</div>
                                                        <p>Graphic Design</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#graphic-design">
                                                <figure class="cc-effect"><img src="images/graphic-design-4.jpg"
                                                        alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Abstract Line</div>
                                                        <p>Graphic Design</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="Photography" role="tabpanel">
                            <div class="ml-auto mr-auto">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#Photography">
                                                <figure class="cc-effect"><img src="images/photography-1.jpg"
                                                        alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Photoshoot</div>
                                                        <p>Photography</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#Photography">
                                                <figure class="cc-effect"><img src="images/photography-3.jpg"
                                                        alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Wedding Photoshoot</div>
                                                        <p>Photography</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#Photography">
                                                <figure class="cc-effect"><img src="images/photography-2.jpg"
                                                        alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Beach Photoshoot</div>
                                                        <p>Photography</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                        <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                            data-aos-anchor-placement="top-bottom"><a href="#Photography">
                                                <figure class="cc-effect"><img src="images/photography-4.jpg"
                                                        alt="Image" />
                                                    <figcaption>
                                                        <div class="h4">Nature Photoshoot</div>
                                                        <p>Photography</p>
                                                    </figcaption>
                                                </figure>
                                            </a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="section" id="experience">
                <div class="container cc-experience">
                    <div class="h4 text-center mb-4 title">Work Experience</div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50"
                                data-aos-duration="500">
                                <div class="card-body cc-experience-header">
                                    <p>June 2016 - June 2017</p>
                                    <div class="h5">A-HOST Company</div>
                                </div>
                            </div>
                            <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                                <div class="card-body">
                                    <div class="h5">Programmer</div>
                                    <p>
                                        <li>Development 'Hybrid Application' with IONIC Framework [IONIC v.1 with AngularJS and IONIC v.2/3 with TypeScript].
                                        </li>
                                        <li>Use Magento framework to build e-commerce web from customer requirement.
                                        </li>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50"
                                data-aos-duration="500">
                                <div class="card-body cc-experience-header">
                                    <p>June 2017 - June 2018</p>
                                    <div class="h5">A-HOST Company</div>
                                </div>
                            </div>
                            <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                                <div class="card-body">
                                    <div class="h5">Assistant Consultant</div>
                                    <p>
                                        <li>Development web application with .NET Framework in C# language [Internal E-customs web system for paperless flow].
                                        </li>
                                        <li>Development web application with .NET Framework in C# language [Government funding project].
                                        </li>
                                        <li>Work more about project management and development model performance [Waterfall, Agile, Scrum].
                                        </li>
                                        <li>Trained, coached, and supervised new staff members and co-op students.
                                        </li>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50"
                                data-aos-duration="500">
                                <div class="card-body cc-experience-header">
                                    <p>June 2018 - July 2021</p>
                                    <div class="h5">A-HOST Company</div>
                                </div>
                            </div>
                            <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                                <div class="card-body">
                                    <div class="h5">Consultant</div>
                                    <p>
                                        <li>Development web application with 'Laravel Framework' and VueJS in two project.
                                            <ol type="1">
                                                <li>Web admin for Image upload and tracking maintenance ATM service / Cash refill in machine progress.</li>
                                                <li>Web enhancement for paperless reimbursement, budget control approved and interface data with oracle ERP.</li>
                                            </ol>  
                                        </li>
                                        <li>Proof of concept microsoft platform service such as Power Apps, Power Flow and Power BI.
                                        </li>
                                        <li>Proof of concept microsoft DevOps.
                                        </li>
                                        <li>Use Oracle E-bussiness suite for investigate ERP Process and interface data [via text/CSV file] to another process.
                                        </li>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="container cc-education">
                    <div class="h4 text-center mb-4 title">Education</div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50"
                                data-aos-duration="500">
                                <div class="card-body cc-education-header">
                                    <p>2012 - 2016</p>
                                    <div class="h5">Bachelor's Degree</div>
                                </div>
                            </div>
                            <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                                <div class="card-body">
                                    <div class="h5">Bachelor of Science Program in multimedia technology</div>
                                    <p class="category">Thai-Nichi institute of technology</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        {{-- <div class="container text-center"><a class="cc-facebook btn btn-link" href="#"><i class="fa fa-facebook fa-2x "
                    aria-hidden="true"></i></a><a class="cc-twitter btn btn-link " href="#"><i
                    class="fa fa-twitter fa-2x " aria-hidden="true"></i></a><a class="cc-google-plus btn btn-link"
                href="#"><i class="fa fa-google-plus fa-2x" aria-hidden="true"></i></a><a
                class="cc-instagram btn btn-link" href="#"><i class="fa fa-instagram fa-2x " aria-hidden="true"></i></a>
        </div> --}}
        <div class="text-center text-muted">
            <p>&copy; Creative CV. All rights reserved.<br>Design - <a class="credit" href="https://templateflip.com"
                    target="_blank">TemplateFlip</a></p>
        </div>
    </footer>
    <script src="js/core/jquery.3.2.1.min.js?ver=1.1.0"></script>
    <script src="js/core/popper.min.js?ver=1.1.0"></script>
    <script src="js/core/bootstrap.min.js?ver=1.1.0"></script>
    <script src="js/now-ui-kit.js?ver=1.1.0"></script>
    <script src="js/aos.js?ver=1.1.0"></script>
    <script src="scripts/main.js?ver=1.1.0"></script>
</body>

</html>