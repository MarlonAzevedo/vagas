<main>
    <section>
        
    </section>
    <h2 class="mt-3">Excluir Vaga</h2>

    <form method="POST">
        <div class="form-group">
            <p>Você tem certeza que quer excluir a vaga <strong><?=$objVaga->titulo?>?</strong></p>
        </div>
        <div class="form-group" >
            <a href="index.php">
                <button type="button" class="btn btn-success">Cancelar</button>
            </a>
            <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
        </div>
    </form>
</main>