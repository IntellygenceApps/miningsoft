 <!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Bienvenido</h1>
                        <h3><?=$session['username']." ".$session['secondname'];?> {<?=$session['position'];?>}</h3>
                        <hr class="intro-divider">
                        
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->


<style>
h6 {
    font-family: "Lato","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-weight: 700;
}

.topnav {
    font-size: 14px; 
}

.lead {
    font-size: 18px;
    font-weight: 400;
}

.intro-header {
    padding-top: 50px; /* If you're making other pages, make sure there is 50px of padding to make sure the navbar doesn't overlap content! */
    padding-bottom: 50px;
    text-align: center;
    color: #f8f8f8;
    background: url(public/images/intro-bg.jpg) no-repeat center center;
    background-size: cover;
}

.intro-message {
    position: relative;
    padding-top: 20%;
    padding-bottom: 20%;
}

.intro-message > h1 {
    margin: 0;
    text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
    font-size: 5em;
}

.intro-divider {
    width: 400px;
    border-top: 1px solid #f8f8f8;
    border-bottom: 1px solid rgba(0,0,0,0.2);
}

.intro-message > h3 {
    text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
}

@media(max-width:767px) {
    .intro-message {
        padding-bottom: 15%;
    }

    .intro-message > h1 {
        font-size: 3em;
    }

    ul.intro-social-buttons > li {
        display: block;
        margin-bottom: 20px;
        padding: 0;
    }

    ul.intro-social-buttons > li:last-child {
        margin-bottom: 0;
    }

    .intro-divider {
        width: 100%;
    }
}

.network-name {
    text-transform: uppercase;
    font-size: 14px;
    font-weight: 400;
    letter-spacing: 2px;
}

.content-section-a {
    padding: 50px 0;
    background-color: #f8f8f8;
}

.content-section-b {
    padding: 50px 0;
    border-top: 1px solid #e7e7e7;
    border-bottom: 1px solid #e7e7e7;
}

.section-heading {
    margin-bottom: 30px;
}

.section-heading-spacer {
    float: left;
    width: 200px;
    border-top: 3px solid #e7e7e7;
}

.banner {
    padding: 100px 0;
    color: #f8f8f8;
    background: url(../img/banner-bg.jpg) no-repeat center center;
    background-size: cover;
}

.banner h2 {
    margin: 0;
    text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
    font-size: 3em;
}

.banner ul {
    margin-bottom: 0;
}

.banner-social-buttons {
    float: right;
    margin-top: 0;
}

</style>