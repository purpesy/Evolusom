<section class="agendamento-rapido">
        <div class="container">
            <h2 class="titulo-secao">Agende seu Horário</h2>
            <form class="formulario-agendamento">
                <div class="campo-formulario">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="campo-formulario">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" required>
                </div>
                <div class="campo-formulario">
                    <label for="servico">Serviço Desejado</label>
                    <select id="servico" name="servico" required>
                        <option value="">Selecione um serviço</option>
                        <option value="pelicula">Película Automotiva</option>
                        <option value="bloqueador">Bloqueador/Vidro Elétrico</option>
                        <option value="chave">Chaves e Controles</option>
                        <option value="multimidia">Multimídia</option>
                        <option value="iluminacao">Iluminação</option>
                        <option value="som">Som Automotivo</option>
                    </select>
                </div>
                <div class="campo-formulario">
                    <label for="data">Data Preferencial</label>
                    <input type="date" id="data" name="data" required>
                </div>
                <div class="campo-formulario">
                    <label for="horario">Horário Preferencial</label>
                    <input type="time" id="horario" name="horario" required>
                </div>
                <div class="campo-formulario">
                    <label for="mensagem">Observações</label>
                    <textarea id="mensagem" name="mensagem" rows="3"></textarea>
                </div>
                <button type="submit" class="botao-enviar">Enviar Agendamento</button>
            </form>
        </div>
    </section>