<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{asset('build/assets/app.css')}}">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css')}}">
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>signin-signup</title>
</head>

<body>
    <div class="container">
        <div class="signin-signup">
            
            <form action="{{ route('handlelogin') }}" class="sign-in-form" method="POST">
                @method('post')
                    @csrf
                    @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{session()->get('error')}}
                    </div>
                @endif
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
                @endif

                <h2 class="title">Connexion</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="email"  name="email" placeholder="email de l'utilisateur" value="{{ old('email')}}" required>

                </div>     
                        @error('email')
                        <div class="text text-danger">
                            {{$message}}
                        </div>
                        @enderror

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Entrer votre mot de passe" required>
                
                </div>

                 @error('password')
                        <div class="text text-danger mt-1">
                            {{$message}}
                        </div>
                    @enderror


                <input type="submit" value="Login" class="btn">
                {{-- <p class="social-text fs-4 me-2">Vous êtes pharmacien ? <a href="#" class="text-success fs-4" style="text-decoration: none;">Cliquez ici !</a> </p> --}}
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                 <p class="account-text">Vous n’avez pas de compte ? <a href="{{route('registration')}}" id="sign-up-btn2">S’</a></p> 
            </form>
            <!-- registre -->
            <form action="{{ route('handleregistration') }}" class="sign-up-form" method="POST">
                
                <h2 class="title">S’inscrire</h2>

                <div class="input-field">
                    @method('post')
                    @csrf 
                    <i class="fas fa-user"></i>
                    <input type="text" name="name"  pattern="[A-Za-z]{3-6}" placeholder="Entrer votre nom" value="{{ old('name')}}" required>

                    @error('name')
                        <div class="text text-danger">
                            {{$message}}
                        </div>
                        @enderror

                </div>

                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text"  pattern="[A-Za-z]{3-6}" name="prenom" placeholder="Entrer Votre prénom" value="{{ old('prenom')}}" required>

                    @error('prenom')
                        <div class="text text-danger">
                            {{$message}}
                        </div>
                        @enderror

                </div>

                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email')}}" required>

                    @error('email')
                        <div class="text text-danger">
                            {{$message}}
                        </div>
                        @enderror

                </div>

                <div class="input-field">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <input type="number" minlength="9"  min="1" name="telephone" placeholder="Entrer Votre numéro de téléphone" value="{{ old('telephone')}}" required/>

                    @error('telephone')
                        <div class="text text-danger">
                            {{$message}}
                        </div>
                        @enderror

                </div>

                <div class="input-field">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <input type="text" name="adresse" placeholder="Entrer Votre adresse" value="{{ old('adress')}}" required>

                    @error('adresse')
                        <div class="text text-danger">
                            {{$message}}
                        </div>
                        @enderror

                </div>

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Entrer mot de passe" required>

                    @error('password')
                        <div class="text text-danger mt-1">
                            {{$message}}
                        </div>
                        @enderror

                </div>

                <input type="submit" value="S’inscrire" class="btn">
                <p class="social-text">Or Sign in with social platform</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
               <p class="account-text">Vous avez déjà un compte ? <a href="{{route('login')}}" id="sign-in-btn2">Connexion</a></p>
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Vous avez un compte Connectez-vous !</h3>
                    <p>Connectez-vous pour bénéficier de tous nos services de mise en relation avec votre pharmacien.</p>
                    <button class="btn" id="sign-in-btn">Connexion</button>
                </div>
                <img src="{{ asset('image/photo.jpg')}}" alt="" class="image" style="width: 100%;">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Nouveau chez SEN PHARMACIE?</h3>
                    <p>Connectez-vous pour bénéficier de tous nos services de mise en relation avec votre pharmacien.</p>
                    <button class="btn" id="sign-up-btn">S'inscrire</button>
                </div>
                <img src="{{ asset('image/photo.jpg')}}" alt="" class="image" style="width: 100%;">
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>