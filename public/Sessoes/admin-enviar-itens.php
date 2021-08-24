
<div class="panel-heading">
   <h3>Enviar itens</h3>


    </div>
    <div class="panel-body">
    <form action="Scripts/Adm/enviar-itens.php" method="post">
            <label>ID da conta</label>
            <input type="text" name="id" class="form-control"  ></input>
            <label>Codigo do item</label>
            <input type="text" name="cod_item" class="form-control"  ></input>
            <label>tipo do item</label>
            <input type="text" name="tipo_item" class="form-control"  ></input>
            <label>quantidade</label>
            <input type="text" name="quant" class="form-control"  ></input>
            <label>Novo ou nao (1 ou 0)</label>
            <input type="text" name="novo" class="form-control"  ></input>
            <label>okok (colocar 0)</label>
            <input type="text" name="okok" class="form-control"  ></input>
            <button  class="btn btn-success">Enviar</button>
</div>