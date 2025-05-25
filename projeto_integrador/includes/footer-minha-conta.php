<!--Fim Minha Conta-->

        <!--Rodapé-->
        <footer class="rodape" id="contato">
            <div class="container">
                <div class="linha">
                    <div class="rodape-colunm1">
                        <h3>App Disponível</h3>
                        <p>Baixe o nosso aplicativo nas plataformas:</p>
                        <div class="logo-app">
                            <img src="loja_dona_lurdes/projeto/arquivos-loja-v-1/img/google.png" alt="">
                            <img src="loja_dona_lurdes/projeto/arquivos-loja-v-1/img/apple.png" alt="">
                        </div>
                    </div>

                    <div class="rodape-colunm2">
                        <img src="loja_dona_lurdes/projeto/arquivos-loja-v-1/img/logo-2.png" alt="">
                         <p>Aproveite e adquira nossos produtos fresquinhos, entregues com comodidade diretamente na sua casa!</p>
                    </div>

                    <div class="rodape-colunm3">
                        <h3>Mais informações</h3>
                      <ul>
                        <li>Cupons</li>
                        <li>Blog</li>
                        <li>Politíca de Privacidade</li>
                        <li>Contatos</li>
                      </ul>
                    </div>

                    <div class="rodape-colunm4">
                        <h3>Redes Sociais</h3>
                      <ul>
                        <li>Facebook</li>
                        <li>Instagram</li>
                        <li>LinkedIn</li>
                      </ul>

                    </div>
                </div>
            </div>
            <hr>
            <p class="direitos">
                &#169; Todos os direitos reservados
            </p>
        </footer>
        <!--Fim-Rodapé-->


    <!--Fim-->

    <script  type = "módulo"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"> </script> 
    <script  nomodule  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js" ></script>
    <script  src="html/loja_dona_lurdes/js/login.js"></script>
    <script>
function gerarSenha() {
    const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=';
    let senha = '';
    for (let i = 0; i < 12; i++) {
        senha += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    const campoSenha = document.getElementById('senhaCadastro');
    campoSenha.value = senha;
    alert("Senha sugerida: " + senha);
}
</script>

</body>
</html>