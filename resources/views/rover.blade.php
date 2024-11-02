@include('partials.header')

<section id="about" class="about section"  style="background-color: #252627;">

      <div class="container section-title" data-aos="fade-up">
        <h2>Rover details</h2>
        <p>O rover Curiosity, um laboratório científico móvel da NASA, é uma obra-prima da engenharia espacial, projetado para explorar e analisar a superfície marciana em busca de sinais de habitabilidade passada. Pesando quase uma tonelada e equipado com 17 câmeras e diversos instrumentos científicos de ponta, o Curiosity investiga a geologia e o clima de Marte, perfurando rochas e analisando amostras com precisão. Alimentado por um gerador nuclear, ele percorre o terreno marciano a uma velocidade lenta, mas constante, enviando dados cruciais que ajudam a decifrar os mistérios de um planeta que, em um passado distante, pode ter abrigado condições propícias à vida.</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center mb-5" style="color: white;">
          <div class="col-lg-4">
            <img src="https://conteudo.imguol.com.br/c/noticias/7b/2020/03/05/proximo-veiculo-da-nasa-a-explorar-marte-se-chamara-perseverance-1583456051062_v2_3x4.jpg" class="img-fluid rounded-5" alt="">
          </div>
          <div class="col-lg-8 content">
            <h2>Rover Curiosity</h2>
            <p class="fst-italic py-3">
                O Curiosity não apenas explorou Marte; ele revelou que mesmo em um mundo distante e desolado, há traços de um passado onde a vida poderia ter florescido, desafiando nossa compreensão sobre o que significa estar vivo no cosmos.
            </p>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Data de Lançamento:</strong> <span>26 de novembro de 2011</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Data de Pouso:</strong> <span>6 de agosto de 2012</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Distância Percorrida:</strong> <span>Aproximadamente 30 km percorridos na superfície de Marte.</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Custo do Projeto:</strong> <span>Estimado em cerca de 2,5 bilhões de dólares.</span></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Local:</strong> <span>Cratera Gale, um local escolhido por ter sinais de possíveis condições habitáveis passadas.</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Velocidade:</strong> <span>Aproximadamente 0,14 km/h em terreno plano.</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Fonte de Energia:</strong> <span>Gerador termoelétrico de radioisótopos (RTG), que converte o calor do decaimento radioativo em eletricidade</span></li>
                </ul>
              </div>
            </div>
            <p class="py-3">
                Curiosity não é apenas um explorador em Marte; é uma embaixadora da curiosidade humana, equipada com os olhos de um cientista e o coração de um aventureiro. Sua missão transcende a coleta de dados e imagens; ela busca respostas para questões que temos feito por gerações: 'Marte já foi um lar?'. Cada rocha analisada, cada imagem capturada e cada dado enviado de volta à Terra é um passo em direção a entender se o planeta vermelho já foi, em um passado remoto, um mundo onde a vida poderia ter emergido. Com o Curiosity, a humanidade alcança um pedaço do universo que, por muito tempo, foi apenas um ponto de luz em nosso céu noturno, transformando sonhos em descobertas tangíveis.
            </p>
          </div>
        </div>

        <div class="container section-title" data-aos="fade-up">
            <h2>Imagens enviadas pelo rover</h2>
            <p>As imagens enviadas pelo rover Curiosity oferecem um vislumbre fascinante da superfície de Marte, revelando terrenos acidentados, formações rochosas e indícios de um passado potencialmente habitável. Capturadas em dias marcianos chamados sols, essas fotos vêm com detalhes como a data e a câmera usada. Os usuários podem inserir um número de sol específico para visualizar imagens daquele dia, permitindo uma exploração personalizada e interativa do planeta vermelho.</p>
        </div><!-- End Section Title -->

        @if(isset($info_fotos_sol) && count($info_fotos_sol) > 0)
            <div id="roverCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($info_fotos_sol as $index => $photo)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ $photo['img_src'] }}" class="d-block w-100" alt="Imagem do Rover em Marte">
                            <div class="carousel-caption d-none d-md-block">
                                <p>Foto tirada em {{ $photo['earth_date'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#roverCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roverCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @else
            <p class="mt-4">Nenhuma imagem encontrada para o sol especificado.</p>
        @endif
            

            <div class="mb-3 mt-3">
                <label for="basic-url" class="form-label" style="color: white;">Pesquise por um sol dentro dessa janela  ({{ $info_rover->max_sol }}):</label>
                <form action="{{ route('rover.photos') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">Sol atual ({{ $info_rover->max_sol }}):</span>
                        <input type="text" name="sol" placeholder="Total de fotos tiradas Marte: {{$info_rover->total_photos}}" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                        <button type="submit" class="btn button_search_color"><i class="bi bi-search" style="color: white;"></i></button>
                    </div>
                </form>
            </div>

        </div>

      </div>


    </section>