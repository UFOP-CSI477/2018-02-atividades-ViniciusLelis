@extends('app')
  
@section('titulo')
Manutenções - Administração
@stop

@section('navbarconteudo')
<a class="navbar-brand d-flex flex-row py-3" href="#top">
    <i class="fas fa-cogs fa-2x d-inline-block my-auto ml-1 mr-3" style="color:e76c21;"></i>
    <h3 class="text-uppercase my-auto text-white font-family-julius">Administração</h3>
</a>

<div class="justify-content-end" id="navbarCollapse">
    <ul class="navbar-nav d-flex flex-row">
      <li class="nav-item active">
        <a class="text-uppercase my-auto text-white font-family-julius h5 mr-4" href="/" style="text-decoration: none">Inicial</a>
      </li>
      <li class="nav-item">
        <a class="text-uppercase my-auto text-white font-family-julius h5" href="/relatorios" style="text-decoration: none">Relatórios</a>
      </li>
    </ul>
  </div>
</div>
@stop

@section('conteudo')
    <div class="wrapper">
        <aside class="main_sidebar bg-dark">
            <ul>
                <li <?php if($sidebar_selected == 0) : ?>class="active"<?php endif; ?>><a href="equipamentos">Cadastrar equipamentos</a></li>
                <li <?php if($sidebar_selected == 1) : ?>class="active"<?php endif; ?>><a href="listar_equipamentos">Listar equipamentos</a></li>
                <li <?php if($sidebar_selected == 2) : ?>class="active"<?php endif; ?>><a href="manutencoes">Cadastrar manutenções</a></li>
                <li <?php if($sidebar_selected == 3) : ?>class="active"<?php endif; ?>><a href="pesquisar">Pesquisar manutenções</a></li>
            </ul>
        </aside>
    </div>

    <div class="main" style="padding-top: 13.2vh">
        <div style="padding-left: 20%; padding-top: 1%">

            <?php if($sidebar_selected == 0) : ?>
                <div id="cadastrar-equipamentos">
                    <form name="form-equipamentos" class="mb-5" method="post" action="{{ route('equipamentos.store') }}">
                        @csrf
                        <p>Utilize o campo abaixo para inserir novos equipamentos no sistema.</p>
                        <div class="form-group d-flex flex-row">
                            <label for="nome" id="label-name" style="width: 175px" class="my-auto">Nome do equipamento</label>
                            <input type="text" name="nome" value="" class="form-control w-25 mr-2" placeholder="Ex.: computador, mouse, ...">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Adicionar</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

            <?php if($sidebar_selected == 1) : ?>
                <div id="listar-equipamentos">
                    <p>Visualize abaixo os equipamentos já cadastrados no sistema.</p>
                    <table class="table table-striped table-dark w-50 mx-auto">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nome</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($equipamentos as $equip): ?>
                                <tr>
                                    <td><?=$equip->id?></td>
                                    <td><?=$equip->nome?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <?php if($sidebar_selected == 2) : ?>
                <div id="cadastrar-manutencoes">
                    <form name="form-manutencoes" class="mb-5" method="post" action="{{ route('manutencoes.store') }}">
                        @csrf
                        <p>Utilize o campo abaixo para inserir novos registros de manutenções no sistema.</p>

                        <div class="form-group">

                            <div class="d-flex mb-3">
                                <label for="equipamento_id" id="label-eq-id" class="my-auto mr-4">Id do equipamento</label>
                                <input type="text" name="equipamento_id" value="" class="form-control w-25 mr-5" placeholder="1, 2, 3, ...">
                                <label for="descricao" id="label-descricao" class="my-auto mr-4">Descrição</label>
                                <input type="text" name="descricao" value="" class="form-control w-25 mr-2" placeholder="Ex.: Defeito no equipamento...">
                            </div>

                            <div class="d-flex mb-4">
                                <label for="tipo" id="label-tipo" class="my-auto mr-4">Tipo</label>
                                <select name="tipo" class="custom-select mr-5" style="min-width:12rem; max-width:12rem; ">
                                    <option selected value="1">Preventiva</option>
                                    <option value="2">Corretiva</option>
                                    <option value="3">Urgente</option>
                                </select>
                                <label for="datalimite" id="label-datalimite" class="my-auto mr-4">Data limite</label>
                                <input type="datetime-local" name="datalimite" value="" class="form-control w-25 mr-2">
                            </div>

                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Adicionar</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

            <?php if($sidebar_selected == 3) : ?>
                <div id="pesquisar-manutencoes">
                    <form name="form-pesquisar-manutencoes" class="mb-5" method="get" url="manutencoes.search">
                        <p>Utilize o formulário abaixo para pesquisar manutenções para um determinado equipamento.</p>

                        <div class="form-group d-flex flex-row">
                            <label for="search_equipamento_id" id="label-name" style="width: 175px" class="my-auto">ID do equipamento</label>
                            <input type="text" name="search_equipamento_id" value="" class="form-control w-25 mr-2" placeholder="1, 2, 3, ...">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                        </div>
                    </form>

                    <?php if(isset($registros)) : ?>
                        <?php if(count($registros) == 0) : ?>
                            <p>Não foi possível encontrar nenhum registro de manutenção cadastrado para este equipamento.</p>
                        <?php endif; ?>
                        <?php if(count($registros) > 0) : ?>
                            <p>Estes são os registros de manutenções cadastrados para o equipamento:</p>

                            <table class="table table-striped table-dark w-75 mx-auto">
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

                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <script>
        $(function () {
            $('#datetimepicker1').datetimepicker();
        });
    </script>
@stop