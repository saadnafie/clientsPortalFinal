<!DOCTYPE html>
<html lang="en">
<head>
  <title>Clients Portal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    .error{
      color:red;
      font-size:11px;
    }
    </style>

  <style>
  *{
      /*margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Nunito', sans-serif;*/

  }

  :root{
      --primary-color:white;
      --secondery-color:#25CC88;
      --shadow-color:gray;
  }

  body{
     /*display: flex;
     align-items: center;
     justify-content: center;*/

  }


  .form__container{
      margin-top: 1rem;
      background-color: var(--primary-color);
      border-radius: 2rem;
      padding: 1rem;
  }

  .title__container{
      width: 100%;
      height: 4.5rem;
      padding: 0.6rem 1.5rem;
      padding-bottom: 2rem;
      border-bottom: 1px solid #42434e;
  }

  .title__container h1{
      letter-spacing: 2px;
      color: black;
      font-size: 1.25rem;
      margin-bottom: 0.4rem;
  }

  .title__container p{
      color: var(--shadow-color);
      font-size: 0.75rem;
  }
  .body__container{
      display: flex;

  }

  .left__container{
      width: 25%;
      display: flex;
      /* flex-direction: column; */
      /* align-items: center; */
      justify-content: center;
      border-right: 1px solid #42434e;
      padding: 1.25rem 0 ;
      margin-right: 2rem;
      padding-right: 1.8rem;
  }

  .side__titles{
      /* display: flex; */
      flex-direction: column;
      align-items: center;
      justify-content: center;
      /* margin-right: 0.6rem; */
  }

  .title__name{
      padding: 0.6rem 0.1rem;
      margin-bottom: 0.25rem;
  }

  .title__name h3{
      margin-bottom: 0.20rem;
      text-align: right;
      color: black;
      font-size: 0.8rem;
      letter-spacing: 1px;
  }
  .title__name p{
      text-align: right;
      color: var(--shadow-color);
      font-size: 0.75rem;
  }

  .progress__bar__container{
      padding-top:0.6rem ;
      /* height: 100%; */
  }
  .progress__bar__container ul .active{
      background-color: var(--secondery-color);

  }

  .progress__bar__container ul li{
      display: flex;
      align-items:center ;
      justify-content: center;
      list-style: none;
      background: var(--shadow-color);
      padding: 0.5rem 0.6rem;
      margin-bottom: 2.2rem;
      border-radius: 50%;
      font-size: 1.4rem;
      color: black;
      margin-left:2rem ;
  }

  .progress__bar__container ul li::before{
      content: '';
      width: 1px;
      height: 11vh;
      position: absolute;
      background-color: var(--shadow-color);

  }

  .progress__bar__container ul .active::before{
      content: '';
      width: 1px;
      height: 11vh;
      position: absolute;
      background-color: var(--secondery-color);
      /* z-index: -1; */
  }

  .right__container{
      width: 75%;
      display: flex;
      padding: 1.5rem 1.5rem;
  }
  .right__container fieldset{
      border: none;
  }
  .sub__title__container{
      padding: 1rem 0 1.2rem 0;
      border-bottom: 1px solid #42434e;
  }

  .sub__title__container h2{
      letter-spacing: 2px;

      color: black;
      margin: 0.4rem 0;
  }

  .sub__title__container p{
      font-size: 0.75rem;
      color: var(--shadow-color);
  }

  .active__form{
      display: none;
  }

  .input__container{
      width: 100%;
      display: flex;
      flex-direction: column;
      margin-top: 1.25rem;
  }

  .input__container label{
      color: #ffffff;
      font-size: 0.75rem;
      margin-bottom: 0.4rem;
  }
  .input__container input{

      padding: 0.5rem;
      font-size: 1.4rem;
      border-radius: 0.75rem;
      background: none;
      border: 1px solid var(--secondery-color);
      margin-bottom: 1.2rem;
      outline: none;
      color: black;
  }

  .nxt__btn{
      width: 25%;
      display: flex;
      align-items: center;
      justify-content: center;
      /* float: right; */
      /* width: 30%; */
      padding: 0.75rem 0;
      font-size: 1.1rem;
      font-weight: bold;
      border-radius: 2rem;
      background: var(--secondery-color);
      color: black;
      /* border: none; */
      /* outline: none; */
      /* margin-left: 20em; */
      /* margin-top: 0.55em;     */
  }

  .nxt__btn:hover{
      transform: scale(1.03);
      background:#1cd68c ;
      cursor: pointer;
  }
  .buttons{
      display: flex;
      align-items: center;
      justify-content: space-between;
      /* float: right; */
      margin:0;
      padding: 0;
      /* justify-content:space-evenly; */
  }

  .prev__btn{
      margin: 0;
      /* padding: 0.5rem 1.5rem 0.7rem 1.5rem  ; */
      /* background-color: #857373; */
      display: flex;
      align-items: center;
      justify-content: center;
      background: none;
      border: none;
      color: black;
      font-size: 18px;
      /* margin-right: 20px; */
      /* margin-left: 15rem; */
      cursor: pointer;
  }

  /*------------------------------- form-2 design --------------------*/

  .selection{
      display: flex;
      align-items: center;
      border: 1px solid var(--shadow-color);
      padding: 0.5rem 0.5rem;
      margin-bottom: 1rem;
      border-radius: 0.5rem;
      width: 100%;
  }

  .selection:hover{
      border: 1px solid var(--secondery-color);
      background-color: var(--primary-color);
      cursor: pointer;
  }

  .imoji{
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0.4rem 0.4rem;
      margin:0  0.2rem ;
      margin-right: 0.4rem;
      font-size: 2rem;
      font-weight: 900;
      color: yellow;
      border-radius: 50%;
      background: var(--shadow-color);
  }


  .descriptionTitle h3{
      color: black;
      margin-bottom: 4px;
  }
  .descriptionTitle p{
      font-size: 0.75rem;
      color: var(--shadow-color);
  }


  /*-------------------------------------- form-4 design----------------------------------------- */
  .slider{
      display: flex;
      align-items: center;
      /* justify-content: center; */
      -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 0.75rem;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
    position: relative;
    margin-top: 3rem;
    /* margin-right:5rem ; */
  }



  .slider:hover {
      opacity: 1;
  }

  .slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background: var(--secondery-color);
      cursor: pointer;
      position: relative;
  }

  .slider::-webkit-range-thumb {
      width: 50px;
      height: 50px;
      background: var(--secondery-color);
      cursor: pointer;
      position: relative;
  }

  .output__value{

      display: flex;
      align-items: center;
      justify-content: center;
      color:black;
      border-radius: 2em;
      padding: 0.8rem 0.8rem;
      position: absolute;
      background-color:var(--secondery-color);
  }

  .output__value::after{
      content: '';
      width: 1.5rem;
      height: 1.5rem;
      background-color: black;
      transform: rotate(45deg);
      position: absolute;
      margin-top:40px;
      background-color: var(--secondery-color);
  }


  @media only screen and (max-width: 600px) {
      body{
          background-color: var(--primary-color);
      }
      .form__container{
          margin: 0;
          padding: 0;
      }

      .body__container{
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          margin: 0;
          padding: 0;
      }

      .right__container{
          width: 90%;
          margin: 0;
      }
      .title__container{
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          padding: 0.5rem;

      }

      .left__container{
          display: flex;
          flex-direction: column;
          margin: 0;
          padding: 0;
          border: none;
      }

      .buttons{
          justify-content: space-between;
      }

      .descriptionTitle h3{
          font-size: 1rem;
      }
      .descriptionTitle p{
          font-size: 0.6rem;

      }


      .side__titles{
          display: none;
          flex-direction: row;
          /* align-items: center;  */
          justify-content: space-evenly;
      }
      .title__name h3{
          font-size: 0.75rem;

      }
      .title__name p{
          font-size: 0.5rem;

      }

      .progress__bar__container{
          margin-bottom: 0;

      }
      .progress__bar__container ul{
          display: flex;
          flex-direction: row;
          align-items: center;
          justify-content: center;
          margin-bottom: 0;
          /* width: 50%; */
          padding: 0 2rem;

      }

      .progress__bar__container ul::before{
          height: 5vh;
      }
      .progress__bar__container ul li{
          margin: 10px;
          padding: 10px ;
          /* transform: rotate(90deg); */
      }
      .progress__bar__container ul .active::before{
          transform: rotate(90deg);
      }

  }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="#">Clients Portal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('customer/profile') }}">Profile</a>
        </li>
      </ul>
    </div>
  </nav>

@yield('content')




</body>
</html>
