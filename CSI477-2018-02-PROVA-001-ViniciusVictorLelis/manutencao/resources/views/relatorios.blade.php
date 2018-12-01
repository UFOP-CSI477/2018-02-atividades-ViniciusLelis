@extends('app')
  
@section('titulo')
Manutenções - Relatórios
@stop

@section('navbarconteudo')
<a class="navbar-brand d-flex flex-row py-3" href="#top">
    <i class="fas fa-file-alt fa-2x d-inline-block my-auto ml-1 mr-3" style="color:e76c21;"></i>
    <h3 class="text-uppercase my-auto text-white font-family-julius">Relatórios</h3>
</a>

<div class="justify-content-end" id="navbarCollapse">
    <ul class="navbar-nav d-flex flex-row">
      <li class="nav-item active">
        <a class="text-uppercase my-auto text-white font-family-julius h5 mr-4" href="/" style="text-decoration: none">Inicial</a>
      </li>
      <li class="nav-item">
        <a class="text-uppercase my-auto text-white font-family-julius h5" href="/administracao/equipamentos" style="text-decoration: none">Administração</a>
      </li>
    </ul>
  </div>
</div>
@stop

@section('conteudo')
<div class="w-50 mx-auto" style="padding-top: 150px">

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Equipamento</th>
                <th scope="col">Descrição</th>
                <th scope="col">Tipo</th>
                <th scope="col">Data Limite</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach($registros as $reg): ?>
                <tr>
                    <td><?=$reg->getNomeEquipamento()?></td>
                    <td><?=$reg->descricao?></td>
                    <td><?=$reg->getTipoRegistro()?></td>
                    <td><?=$reg->datalimite?></td>
                </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>

</div>
@stop