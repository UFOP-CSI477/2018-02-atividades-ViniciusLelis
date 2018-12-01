@extends('app')
  
@section('titulo')
Manutenções - Página Inicial
@stop

@section('navbarconteudo')
<a class="navbar-brand d-flex flex-row py-3" href="#top">
    <i class="fas fa-home fa-2x d-inline-block my-auto ml-1 mr-3" style="color:e76c21;"></i>
    <h3 class="text-uppercase my-auto text-white font-family-julius">Inicial</h3>
</a>
@stop

@section('conteudo')
<div class="card-deck w-100 d-flex justify-content-center" style="padding-top: 150px">

    <a href="relatorios" style="text-decoration: none">
        <div class="card bg-info" style="min-width: 18rem; max-width: 18rem; min-height: 18rem; max-height: 18rem;">
            <div class="card-body d-flex flex-column">
                <i class="fas fa-file-alt fa-10x mx-auto my-auto" style="color:white; stroke: black; stroke-width: 2;"></i>
                <h5 class="card-title text-white mx-auto my-auto">Relatórios</h5>
            </div>
        </div>
    </a>

    <a href="administracao/equipamentos" style="text-decoration: none">
        <div class="card bg-warning" style="min-width: 18rem; max-width: 18rem; min-height: 18rem; max-height: 18rem;">
            <div class="card-body d-flex flex-column">
                <i class="fas fa-cogs fa-10x mx-auto my-auto" style="color:white; stroke: black; stroke-width: 2;"></i>
                <h5 class="card-title text-white mx-auto my-auto">Administração</h5>
            </div>
        </div>
    </a>

</div>
@stop