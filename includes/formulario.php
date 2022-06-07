<main>
    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="post">

        <div class="md-3">
            <label>Titulo</label>
            <input type="text" class="form-control" name="titulo" value="<?=$obVaga->titulo?>">
        </div>

        <div class="md-3">
            <label>Descrição</label>
            <textarea class="form-control" name="descricao" rows="5"><?=$obVaga->descricao?></textarea>
        </div>

        <div class="md-3">
            <label>Status</label>

            <div>
                <div class="form-check form-check-inline">                    
                    <input class="form-label-input" type="radio" name="ativo" value="s" checked> 
                    <label class="form-label">Ativo</label>
                </div>
            </div>

            <div>
                <div class="form-check form-check-inline">
                    <input  type="radio" name="ativo" value="n" <?=$obVaga->ativo == 'n' ? 'checked' : ' '?> > 
                    <label class="form-label">Inativo</label>
                </div>
            </div>

            <div class="md-3">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
        </div>
    </form>
</main>