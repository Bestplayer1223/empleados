<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('alertify/css/themes/default.min.css') }}" />
    <title>Empleados</title>
</head>
<body class="bg-white-light">
    @include('loadingScreen')
    <div class="container-full p-5 h-100">
        <div class="row">
            <div class="col-12 rounded p-5 ">
                <div class="card">
                    <div class="card-header p-4 ">
                        <h1 class="fw-bold mt-4">Lista de Empleados</h1>
                    </div>
                    <div class="card-body bg-light p-5">

                        <div class="d-flex flex-row-reverse">
                            <button type="button" class="btn btn-success fs-4" data-bs-toggle="modal"
                                data-bs-target="#createModal" onclick="openModal('create')">
                                <i class="bi bi-person-fill-add"></i> Crear
                            </button>
                        </div>

                        <div class="input-group input-group-lg mt-4 ">
                            <span class="input-group-text bg-success text-white" id="inputGroup-sizing-lg"><i class="bi bi-search"></i></span>
                            <input type="text" placeholder="Buscar" id="searchFilter" oninput="filterContent(this.id, 'selectedFilter')" class="form-control rounded search" aria-describedby="inputGroup-sizing-lg">
                            <select class="form-select rounded" id="selectedFilter" onchange="filterContent('searchFilter', this.id)" aria-label="Default select example">
                                <option selected value="-1">Filtro</option>
                                <option value="nombre">Nombre</option>
                                <option value="email">Email</option>
                                <option value="sexo">Sexo</option>
                                <option value="area">Área</option>
                                <option value="boletin">Boletin</option>
                              </select>
                          </div>
                        <table id="workersTable" class="mt-4 table table-striped table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th class="fs-5 text-center" scope="col"><i
                                            class="bi bi-person-fill"></i>&nbsp;&nbsp;Nombre</th>
                                    <th class="fs-5 text-center" scope="col">@&nbsp;&nbsp;Email</th>
                                    <th class="fs-5 text-center" scope="col"><i
                                            class="bi bi-gender-ambiguous"></i>&nbsp;&nbsp;Sexo</th>
                                    <th class="fs-5 text-center" scope="col"><i
                                            class="bi bi-briefcase-fill"></i>&nbsp;&nbsp;Área</th>
                                    <th class="fs-5 text-center" scope="col"><i
                                            class="bi bi-envelope-fill"></i>&nbsp;&nbsp;Boletin</th>
                                    <th class="fs-5 text-center" scope="col" title="Modificar"><i
                                            class="bi bi-pencil-square"></i>&nbsp;&nbsp;</th>
                                    <th class="fs-5 text-center" scope="col" title="Eliminar"><i
                                            class="bi bi-trash-fill"></i>&nbsp;&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="workersRows">
                                @foreach($data as $dat)
                                <tr id="{{ $dat->id }}">
                                    <th class="text-center" scope="row">{{ $dat->nombre }}</th>
                                    <td class="text-center">{{ $dat->email }}</td>
                                    <td class="text-center">{{ $dat->sexo }}</td>
                                    <td class="text-center">{{ $dat->foreignArea->nombre }}</td>
                                    <td class="text-center">{{ (($dat->boletin == 1)? 'Si' : 'No') }}</td>
                                    <td class="fs-5 text-center" scope="col" title="Modificar" >
                                        <i data-bs-toggle="modal" onclick="openModal('modify', {{ json_encode($dat) }})" data-bs-target="#createModal" class="bi bi-pencil-square cursor-pointer"></i>&nbsp;&nbsp;</td>
                                    <td class="fs-5 text-center" scope="col" title="Eliminar"><i class="bi bi-trash-fill cursor-pointer"
                                        onclick="deleteRecord({{ $dat->id }})"></i>&nbsp;&nbsp;</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <nav id="paginator" class="d-flex flex-row-reverse"></nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modalCreate')
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('alertify/alertify.min.js') }}"></script>
</body>
</html>
