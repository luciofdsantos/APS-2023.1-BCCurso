@extends('layouts.main')
@section('title', 'Sobre')
@section('content')

  <style>


    .bloco1{
      text-align:left;
      margin:40px;
      padding-bottom:20px;
    }
    /*bloco principal*/
    .bloco2{
        padding:0px 10% 0px 10%;
    }
/*
    .bloco3{
      text-align:center;
      border-bottom:1px solid #d3d3d3;
      padding-top:17px;
      padding-bottom:17px;
      margin-bottom:17px;
    }

    .bloco4{
      display:flex;
      flex-direction:column;
      justify-content:center;
      align-items:left;
      margin:0px 40px;

      color:white;
      font-size:120%;
      text-shadow:0.3px 0.3px;
    }
    .bloco41{
      flex:1 1 0;
      border-radius:3px;
      border:1px solid gray;
    }
*/
    .title{
      font-weight:bold;
      font-size:20px;
    }
    .title2{
      font-size:24px;
    }
    .title3{
      font-size:22px;
      font-weight:bold;
    }


    .bloco_principal{
      display:flex;
      flex-direction:column;

      border-left: 4px solid #d3d3d3;
      border-right:4px solid #d3d3d3;


      border-radius:5px;
      margin:0px;

    }

    .button{
        display:block;
        text-align:center;
        color:white;
        font-weight:bold;
        text-decoration:none;
        border-radius:30px;
        margin:0px 40px 0px 0px;
        width:30%;
        min-width:200px;
        height:100%;
        padding:16px;
        background-color:green;
        font-size:110%;
    }

    .button:hover{
        background-color:#198754;
    }

    .borda{
      padding-left:8px;
      padding-right:8px;
      margin-bottom:2px;
      border:1px solid gray;
      border-radius:6px;
    }
    .borda2{
      display:block;
      border-bottom:0.5px solid #d3d3d3;
    }


    .bloco10{
      margin:0px 40px 0px 40px;
      position:relative;
      display:flex;
      flex-direction:row;
      align-content:stretch;
      min-height:80px;
      justify-content:space-evenly;
    }
        .blocos_pra_linha{
          display:flex;
          flex-direction:column;
          flex-wrap:wrap;
          flex:1;
        }
            .blocos_pra_linha1{
              border-bottom:1px solid gray;
              background-color:white;
              height:50%;
              flex:1;
            }
            .blocos_pra_linha2{
              background-color:white;
              height:50%;
              flex:1;
            }
        .bloco101{
          position:absolute;
          top:20px;
          display:inline-block;
          padding:0px 5px 0px 5px;
          background-color:white;
          overflow:hidden;
        }

    .nav{
      position:absolute;
      padding-bottom:80px;
      left:0;
      right:0;
      top:0;
      display:flex;
      height:auto;
      align-items:stretch;
    }
    .bloco_menu{
      flex:1;
      font-size:110%;
      text-align:center;
      font-weight:bold;
      min-height:100%;
      border:2px solid #d3d3d3;
      /*color:#325290;*/
      color:#1c2c4c;
      text-decoration:none;
    }
    .bloco_menu:hover{
      color: #324c81;
    }

    .space{
      margin-bottom:40px;
    }





</style>

    <div class="custom-container">
        <div>
            <div>
                <h3 class="title2">Sobre o curso </h3>
            </div>
        </div>
    </div>

    <div class = "bloco2">

        <div class = "bloco_principal" style = "position:relative;">

          <nav class = "nav">
            <a href = "#o_que_e_o_curso" class = "bloco_menu">Conheça o curso</a>
            <a href = "#dados" class = "bloco_menu">Dados gerais</a>
            <a href = "#inscrever" class = "bloco_menu">Estude no IF</a>
          </nav>

          <div class = "space"></div>

          <div class = "bloco10">
              <div class = "bloco101">
                  <div style = "text-align:center; width:100%; margin-top:50px;">
                        <span class = "title3">Conheça o curso de {{$curso->nome}}, do Instituto Federal do Norte de Minas</span>
                  </div>
              </div>
          </div>



            <div id="o_que_e_o_curso" class = "bloco1" style= "margin-top:150px;">

                <div style = "text-align:center;">
                    <span class = "title">O que é o curso de {{$curso->nome}} ( {{$curso->sigla}} )</span>
                </div>

                <br>

                <p>{{$curso->descricao}}</p>
                <br>
                <span> Nas últimas avaliações realizadas pelo MEC os resultados obtidos foram: </span>

                <ul>
                    <li> {{$curso->nota_in_loco_SINAES}} na avaliação in loco –SINAES </li>
                    <li> {{$curso->nota_enade}} no ENADE </li>
                </ul>

            </div>



            <div id = "dados" class = "bloco10">

                <div class = "blocos_pra_linha">
                    <div class = "blocos_pra_linha1"></div>
                    <div class = "blocos_pra_linha2"></div>
                </div>

                <div class = "bloco101">
                        <span class = "title3">Dados gerais do curso</span>
                </div>

                <div class = "blocos_pra_linha">
                    <div class = "blocos_pra_linha1"></div>
                    <div class = "blocos_pra_linha2"></div>
                </div>

            </div>




            <div class = "bloco1">

                <div class="borda">
                  <span class = "title borda2">Tempo para integração do curso</span>
                  <p>O tempo mínimo necessário para concluir o curso é de {{$curso->tempo_min_conclusao}} anos e o tempo máximo é de {{$curso->tempo_max_conclusao}} anos. </p>
                </div>

                <div class = "borda">
                  <span class = "title borda2">Ano de implementação do curso</span>
                  <p>{{$curso->ano_implementacao}}.</p>
                </div>

                <div class = "borda">
                  <span class = "title borda2">Modalidade</span>
                  <p>{{$curso->modalidade}}.</p>
                </div>

                <div class = "borda">
                  <span class = "title borda2">Turno</span>
                  <p>{{$curso->turno}}.</p>
                </div>

                <div class = "borda">
                  <span class = "title borda2">Tipo</span>
                  <p>{{$curso->tipo}}.</p>
                </div>

                <div class = "borda">
                  <span class = "title borda2">Habilitação</span>
                  <p>{{$curso->habilitacao}}.</p>
                </div>

                <div class = "borda">
                  <span class = "title borda2">Carga horária do curso</span>
                  <p>{{$curso->carga_horaria}} horas .</p>
                </div>

                <div class = "borda">
                  <span class = "title borda2">Matriz curricular</span>
                    <p>
                      <a href = "#">link para o documento sobre a matriz curricular</a>
                    </p>
                </div>

                <div class = "borda">
                  <span class = "title borda2">Calendário acadêmico</span>
                    <p>
                        <a href = "{{$curso->calendario}}"> link para o calendário acadêmico</a>
                    </p>
                </div>

                <br>
                <br>

                <span class = "title">Mais informações</span>
                <br>
                <a href = "{{$curso->analytics}}">analytics</a>
            </div>



            <!--
            <div class = "bloco1">
              <span class = "title">Matriz curricular</span>
                <p>O curso de Ciências da Computação do IFNMG contém em sua grade matérias voltadas para o desenvolvimento profissionalizante...</p>
                <a href = "#">link para o documento sobre a matriz curricular</a>
                <br>
                <br>
                <br>
                <span class = "title">Calendário acadêmico</span>
                <p>Veja o calendário acadêmico no link</p>
                <a href = "#">calendário acadêmico</a>
            </div>
            -->





            <div id = "inscrever" class = "bloco10">

                <div class = "blocos_pra_linha">
                    <div class = "blocos_pra_linha1"></div>
                    <div class = "blocos_pra_linha2"></div>
                </div>


                <div class = "bloco101">
                        <div style = "text-align:center; width:100%; ">
                            <span class = "title3">Deseja se matricular no curso?</span>
                        </div>
                </div>


                <div class = "blocos_pra_linha">
                    <div class = "blocos_pra_linha1"></div>
                    <div class = "blocos_pra_linha2"></div>
                </div>

            </div>







            <div class = "bloco1" style="flex:1;">

                <span class = "title">Total de vagas ofertadas anualmente</span>
                <p>São ofertadas {{$curso->vagas_ofertadas_anualmente}} vagas anualmente.</p>


                <span class = "title">Total de vagas ofertadas por turma</span>
                <p>São ofertadas {{$curso->vagas_ofertadas_turma}}  vagas por turma.</p>


                <span class = "title">Periodicidade de ingresso</span>
                <p>O ingresso no curso ocorre de forma {{$curso->periodicidade_ingresso}}</p>

                <span class = "title">Formas de acesso</span>
                <ul>
                  @foreach($curso->formasAcesso as $formaAcesso)

                    <li>{{$formaAcesso->forma_acesso}}, {{$formaAcesso->porcentagem_vagas}}% das vagas.</li>

                  @endforeach

                </ul>

                <span><a href = "{{$curso->horario}}"> Veja os horários das disciplinas</a></span>

                <br>
                <br>


                <a href = "https://www.ifnmg.edu.br/estude-no-ifnmg" class = "button">Estude no IFNMG</a>

            </div>

        </div>

    </div>

    <div class="text-center mt-4">
        <a href="{{ url()->previous() }}" class="btn custom-button custom-button-castastrar-tcc btn-default">Voltar</a>
    </div>
<!--
    - Nome do curso: Ciência da Computação
    - Modalidade: Presencial
    - Tipo: Bacharelado
    - Habilitação: Bacharel em Ciência da Computação
    - Ano de implantação: 2013
    - Ato de autorização: Portaria Nº 521-Reitor/2012
    - Total de vagas ofertadas anualmente: 40
    - Número de vagas ofertadas por turma: 40
    - Formas de acesso: Vestibular/SISU
    - Número de vagas disponibilizadas: 50%Vestibular e 50%SISU
    - Periodicidade de ingresso: Anual
    - Turno de funcionamento: Integral
    - Tempo para integralização do curso: Mínimo de cinco anos (10 semestres) e máximo de sete anos e meio (15 semestres)
    - Resultados obtidos nas últimas avaliações realizadas pelo MEC: ( Quatro (4) na avaliação in loco –SINAES; Nota quatro (4) no ENADE)
-->

<script>



  //alterações feitas quando o tamanho da página muda, e quando a página carrega
  function size_changed(){

    let a;

    a = window.innerWidth;

    const elementos_bloco10 = document.getElementsByClassName("bloco10");

    const elementos_bloco101 = document.getElementsByClassName("bloco101");

    const elementos_title3 =  document.getElementsByClassName("title3");

    const elementos_bloco2 = document.getElementsByClassName("bloco2");

    const elementos_bloco1 = document.getElementsByClassName("bloco1");

    const elementos_title = document.getElementsByClassName("title");

    const button = document.querySelector(".button");

    if(a < 600){




        for (let i = 0; i < elementos_bloco10.length; i++) {
          elementos_bloco10[i].style.height = (window.innerWidth*1.6 - 3000) +"px";
        }

        for (let i = 0; i < elementos_title3.length; i++) {
          elementos_title3[i].style.fontSize = (window.innerWidth*0.032 + 5.5) +"px";
        }

        for (let i = 0; i < elementos_bloco2.length; i++) {
          elementos_bloco2[i].style.padding = "0px 1% 0px 1%";
        }

        for (let i = 0; i < elementos_bloco1.length; i++) {
          elementos_bloco1[i].style.margin = "40px 3% 40px 3%";
        }

        for (let i = 0; i < elementos_bloco10.length; i++) {
          elementos_bloco10[i].style.margin = "0px 3% 0px 3%";
        }

        for (let i = 0; i < elementos_title.length; i++) {
          elementos_title[i].style.fontSize = "16px";
        }

        let space = window.document.getElementsByClassName("space");
        space[0].style.marginBottom = "80px";

        for (let i = 0; i < elementos_bloco101.length; i++) {
          elementos_bloco101[i].style.top = (elementos_bloco10[i].offsetHeight)/3 +"px";
        }

        button.style.fontSize = (window.innerWidth)/8 +50 + "%";

    }

    else{

      button.style.fontSize = (window.innerWidth)/15 +50 + "%";

      for (let i = 0; i < elementos_bloco101.length; i++) {
        elementos_bloco101[i].style.top = (elementos_bloco10[i].offsetHeight)/3.75 +"px";
      }

      for (let i = 0; i < elementos_bloco2.length; i++) {
        elementos_bloco2[i].style.padding = "0px 10% 0px 10%";
      }

      for (let i = 0; i < elementos_bloco1.length; i++) {
        elementos_bloco1[i].style.margin = "40px";
      }

      for (let i = 0; i < elementos_title.length; i++) {
        elementos_title[i].style.fontSize = "20px";
      }

    }

    window.document.getElementById("o_que_e_o_curso").style.marginTop = elementos_bloco10[0].offsetHeight + (20000/(window.innerWidth)) + "px";

  }



  window.onload = size_changed;
  window.onresize = size_changed;



</script>

@endsection
