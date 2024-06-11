{{-- GAMES INSTRUTIONS MODALS --}}

@if (Request::route()->getName() == "double")

<div class="md-modal md-result-instrution-double md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-double').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('DoubleInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('DoubleInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="DoubleInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/double1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/double1.jpg">
                            <p class="instrution__game--text mt-3">Selecione uma cor, selecione o valor que deseja apostar e clique na aposta.</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/double2.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/double2.jpg">
                            <p class="instrution__game--text mt-3">A cor selecionada na tela é a cor vencedora, vermelho e preto lhe dará 2× e branco lhe dará 14×</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-double').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="DoubleInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

@if (Request::route()->getName() == "crash")

<div class="md-modal md-result-instrution-crash md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-crash').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('CrashInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('CrashInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="CrashInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/crash1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/crash1.jpg">
                            <p class="instrution__game--text mt-3">Antes que a contagem regressiva termine Pressione "Apostar" e siga o vôo do foguete.</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/crash2.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/crash2.jpg">
                            <p class="instrution__game--text mt-3">Retirar seu dinheiro antes da explosão do foguete no espaço para não perder a aposta.（Foguetes podem explodir a 1.0x）</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-crash').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="CrashInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

@if (Request::route()->getName() == "mines")

<div class="md-modal md-result-instrution-mines md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-mines').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('MinesInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('MinesInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="MinesInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/mines1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/mines1.jpg">
                            <p class="instrution__game--text mt-3">Antes de fazer uma aposta, escolha a quantidade de bombas e clique em 'Jogar'.</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/mines2.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/mines2.jpg">
                            <p class="instrution__game--text mt-3">Procure esmeraldas, mas cuidado com as bombas!</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>

                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/mines4.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/mines4.jpg">
                            <p class="instrution__game--text mt-3">Quanto maior o número de bombas no campo de jogo, maior é a razão vencedora.</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/mines3.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/mines3.jpg">
                            <p class="instrution__game--text mt-3">Resgate os seus ganhos antes de explodir uma bomba e perder a sua aposta!</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-mines').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="MinesInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

@if (Request::route()->getName() == "dice")

<div class="md-modal md-result-instrution-dice md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-dice').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('DiceInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('DiceInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="DiceInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/dice2.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/dice2.jpg">
                            <p class="instrution__game--text mt-3">Fazer uma aposta e prever um número Lucky controlando o deslizador Escolher " Rodar sobre" ou " Rodar por baixo" o número escolhido.</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/dice1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/dice1.jpg">
                            <p class="instrution__game--text mt-3">O gerador de números aleatórios escolherá o número vencedor de 0 a 99. Se o número da sorte for o intervalo escolhido, você ganha! (o número da sorte igual ao intervalo selecionado é considerado um perdedor)</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-dice').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="DiceInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

@if (Request::route()->getName() == "tower")

<div class="md-modal md-result-instrution-tower md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-tower').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('TowerInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('TowerInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="TowerInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/tower1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/tower1.jpg">
                            <p class="instrution__game--text mt-3">Faça uma aposta, escolha o número de moedas quebradas, e pressione "Apostar"</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/tower3.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/tower3.jpg">
                            <p class="instrution__game--text mt-3">Revele as moedas começando de baixo. Cuidado com as moedas quebradas!</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/tower2.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/tower2.jpg">
                            <p class="instrution__game--text mt-3">Tente completar o percusso da torre. Retire a vitória antes de encontrar uma moeda quebrada.</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-tower').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="TowerInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

@if (Request::route()->getName() == "roulette")

<div class="md-modal md-result-instrution-roulette md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-roulette').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('RouletteInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('RouletteInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="RouletteInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/roulette1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/roulette1.jpg">
                            <p class="instrution__game--text mt-3">Coloque uma ficha em qualquer resultado do jogo e pressione "Jogar".</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/roulette2.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/roulette2.jpg">
                            <p class="instrution__game--text mt-3">Se você certar o resultado da Roleta, seu valor apostado se multiplicará!</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-blackjack').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="RouletteInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

@if (Request::route()->getName() == "stairs")

<div class="md-modal md-result-instrution-stairs md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-stairs').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('StairsInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('StairsInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="StairsInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/stairs2.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/stairs2.jpg">
                            <p class="instrution__game--text mt-3">Para jogar, faça sua aposta e escolha o número de armadilhas por linha e clique em 'Jogar'.
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/stairs3.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/stairs3.jpg">
                            <p class="instrution__game--text mt-3">Suba as escadas e tome cuidado com a queda de pedras! Quanto mais alto você sobe, mais você recebe</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/stairs1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/stairs1.jpg">
                            <p class="instrution__game--text mt-3">A quantidade de seus ganhos, é escolha sua: você pode ganhar a qualquer momento ou dar os 13 passos para obter a maior recompensa".</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-stairs').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="StairsInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

@if (Request::route()->getName() == "coinflip")

<div class="md-modal md-result-instrution-coinflip md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-coinflip').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('CoinflipInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('CoinflipInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="CoinflipInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/coinflip2.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/coinflip2.jpg">
                            <p class="instrution__game--text mt-3">Faça uma aposta e pressione "Apostar" Adivinhe o que vai sair: vermelho ou preto</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/coinflip1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/coinflip1.jpg">
                            <p class="instrution__game--text mt-3">Você pode adivinhar a moeda um número ilimitado de vezes por jogo. Todas as probabilidades serão somadas</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-stairs').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="CoinflipInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

@if (Request::route()->getName() == "hilo")

<div class="md-modal md-result-instrution-hilo md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-hilo').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('HiloInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('HiloInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="HiloInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/hilo1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/hilo1.jpg">
                            <p class="instrution__game--text mt-3">Adivinhe se a próxima carta será maior ou menor que a anterior no ranking.</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/hilo2.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/hilo2.jpg">
                            <p class="instrution__game--text mt-3">Abra um número ilimitado de cartas, as probabilidades são resumidas. Você pode parar a qualquer momento e coletar seus ganhos.</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-hilo').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="HiloInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

@if (Request::route()->getName() == "blackjack")

<div class="md-modal md-result-instrution-blackjack md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-blackjack').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('BlackjackInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('BlackjackInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="BlackjackInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/blackjack1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/blackjack1.jpg">
                            <p class="instrution__game--text mt-3">Pressione "Dobrar" para dobrar a aposta e receber a última carta.</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/blackjack4.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/blackjack4.jpg">
                            <p class="instrution__game--text mt-3">O seguro só está disponível quando a primeira carta do dealer for um Ás. Ele assegura você caso o dealer consiga 21.</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/blackjack3.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/blackjack3.jpg">
                            <p class="instrution__game--text mt-3">Quem chegar mais perto de 21 vence. Se você e o dealer tiverem o mesmo número de pontos, ocorrerá um empate.</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-blackjack').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="BlackjackInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

@if (Request::route()->getName() == "plinko")

<div class="md-modal md-result-instrution-plinko md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-plinko').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('PlinkoInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('PlinkoInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="PlinkoInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/plinko1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/plinko1.jpg">
                            <p class="instrution__game--text mt-3">Escolher a complexidade do jogo (de acordo com a numero) e Fazer uma aposta. O nível de complexidade determina a quantidade de coeficiente de ganho máximo e mínimo.</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/plinko2.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/plinko2.jpg">
                            <p class="instrution__game--text mt-3">A sua recompensa é determinada de acordo com o coeficiente em que a cela vencedora a bola cai.</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-plinko').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="PlinkoInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

@if (Request::route()->getName() == "keno")

<div class="md-modal md-result-instrution-keno md-s-height md-effect-1 max-400">
    <div class="md-content shadow-blue h-100">
        <i class="fal fa-times md-close" onclick="$('.md-result-instrution-keno').toggleClass('md-show', false);"></i>
        <div class="instrution__game mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="tab-instrution-game active" onclick="showTabInstrutionGame('KenoInstrutionImages')">Regras do jogo</div>
                <div class="tab-instrution-game" onclick="showTabInstrutionGame('KenoInstrutionMoney')">Limites</div>
            </div>
            <div class="mt-4">
                <div class="content-instrution-game active" id="KenoInstrutionImages" >
                    <div class="slider-game-instrution pb-4 px-0">
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/keno1.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/keno1.jpg">
                            <p class="instrution__game--text mt-3">Das 40 células com números, selecione 10 números e clique em [APOSTA]</p>
                            <button class="instrution__game--btn instrution__game--prev">Proximo</button>
                        </div>
                        <div class="text-center">
                            <img class="w-100 instrution__game--img" src="https://cdn.29bet.com/assets/img/all/components/instrution-game/keno2.jpg" alt="https://cdn.29bet.com/assets/img/all/components/instrution-game/keno2.jpg">
                            <p class="instrution__game--text mt-3">O sistema selecionará aleatoriamente 10 números vencedores. Quanto mais números você escolher correspondentes ao número vencedor, maior será o multiplicador do bônus.</p>
                            <button class="instrution__game--btn" onclick="$('.md-result-instrution-keno').toggleClass('md-show', false);">Comece o jogo</button>
                        </div>
                    </div>
                </div>
                <div class="content-instrution-game" id="KenoInstrutionMoney">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="my-3 text-center">
                            <p class="mb-1">Aposta maxima</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                        <div class="my-3 text-center">
                            <p class="mb-1">Pagamento maximo</p>
                            <h3 class="instrution__game--maxvalue">R$: 100,00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endif

<script>

     function showTabInstrutionGame(tabId) {
        const tabContents = document.getElementsByClassName('content-instrution-game');
        for (let i = 0; i < tabContents.length; i++) {
            tabContents[i].classList.remove('active');
        }

        const tabContent = document.getElementById(tabId);
        if (tabContent) {
            tabContent.classList.add('active');

        }
   }
   $(".tab-instrution-game").on('click', function () {
        $(".tab-instrution-game").removeClass("active");
        $(this).addClass("active");
    });

    $(".slider-game-instrution").slick({
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        infinite: false,
    });
    $('.instrution__game--prev').click(function(){
      $('.slider-game-instrution').slick('slickNext');
    });

</script>
