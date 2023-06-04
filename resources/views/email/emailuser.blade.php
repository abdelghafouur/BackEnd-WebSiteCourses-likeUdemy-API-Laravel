<!DOCTYPE html>
<html>
<head>
  <title>Bienvenue sur notre site !</title>
  <style>
    /* CSS styles for email content */
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }
    h1 {
      color: #333;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Bienvenue sur notre site !</h1>
    <p>Cher <strong>{{$mailData['firstname']}} {{$mailData['lastname']}}</strong>,</p>
    <p>Bienvenue sur notre site ! Nous sommes ravis de vous accueillir parmi notre communauté d'apprenants. Votre compte a été créé avec succès et vous avez maintenant accès à une multitude de cours en ligne passionnants.</p>
    <p>Nous sommes là pour vous aider à développer vos compétences, élargir vos connaissances et atteindre vos objectifs d'apprentissage. Que vous souhaitiez acquérir de nouvelles compétences professionnelles, explorer des domaines d'intérêt ou renforcer votre expertise actuelle, notre plateforme de formation est là pour vous accompagner.</p>
    <h2>Voici vos informations de connexion :</h2>
    <p><strong>Nom d'utilisateur</strong>: <strong>{{$mailData['firstname']}} {{$mailData['lastname']}}</strong></p>
    <p><strong>Adresse e-mail</strong>: <strong>{{$mailData['email']}} </strong></p>
    <p>N'hésitez pas à contacter notre équipe d'assistance si vous avez des questions, des préoccupations ou si vous avez besoin d'une quelconque aide. Nous sommes là pour vous accompagner tout au long de votre parcours d'apprentissage.</p>
    <p>Nous vous souhaitons une expérience enrichissante sur notre site et nous espérons que vous atteindrez tous vos objectifs d'apprentissage. Nous sommes impatients de vous voir progresser et réussir.</p>
    <p>Bienvenue à bord !</p>
    <p>L'équipe de NEW GENERATION</p>
  </div>
</body>
</html>



