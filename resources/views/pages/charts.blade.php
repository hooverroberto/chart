@extends('layouts.app', ['pageSlug' => 'charts'])

@section('content')
    <script>
        function submit_form(event) {
            const myForm = document.getElementById("fechaForm");
            myForm.submit();
        }
    </script>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif


                    @if (session('deleted'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('deleted') }}
                        </div>
                    @endif

                    @if (session('successChart'))
                        <div class="alert alert-success" role="alert">
                            {{ session('successChart') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <form id="fechaForm" action="{{ route('pages.charts') }}" method="GET" onchange="submit_form()">
                            @csrf
                            <label for="fecha" class="form-label">Selecciona una fecha:</label>
                            <select name="fecha" id="fecha" class="form-select mb-3">
                                <option value="#" @disabled(true)>Selecciona una fecha:</option>
                                @foreach ($fechas as $fecha)
                                    @if ($fecha->id == $empleadosFiltrado[0]->fecha_id)
                                        <option value={{ $fecha->id }} @selected(true)>{{ $fecha->fecha }}
                                        </option>
                                    @else
                                        <option value={{ $fecha->id }}>{{ $fecha->fecha }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                {{-- @if (isset($search) && $search !== 'qweqwe') --}}
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-sm-6 text-left">
                            <h5 class="h5">Reporte del día {{ $empleadosFiltrado[0]->fecha }}</h5>
                            <h2 class="card-title">Rendimiento de los empleados</h2>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end gap-2">
                            <!-- Button modal -->
                            <div>
                                <button type="button" class="btn btn-primary d-flex align-items-start gap-1"
                                    data-bs-toggle="modal" data-bs-target="#form-add">
                                    </span><i class="tim-icons icon-simple-add"></i><span>Agregar empleado
                                </button>
                            </div>

                            <div>
                                <button type="button" class="btn btn-primary d-flex align-items-start gap-1"
                                    data-bs-toggle="modal" data-bs-target="#form-add-record">
                                    </span><i class="tim-icons icon-simple-add"></i><span>Agregar registro diario
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="form-add" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="background-color: #27293d">
                                        <div class="modal-header mb-3">
                                            <button type="button" class="btn-close p-2" data-bs-dismiss="modal"
                                                aria-label="Close" style="background-color: white"></button>
                                        </div>
                                        <div class="modal-body mb-2">
                                            <form method="POST" action="{{ route('add_value') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name" class="form-label fs-6 fw-semibold">Nombre del
                                                        empleado:</label>
                                                    <input type="text" class="form-control fs-6" id="name"
                                                        name="name" placeholder="Ingresa un nombre" required>
                                                </div>
                                                <div class="col-12 d-flex justify-content-center">
                                                    <button type="submit"
                                                        class="btn btn-primary col-6 text-center">Agregar</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="form-add-record" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="background-color: #27293d">
                                        <div class="modal-header mb-3">
                                            <button type="button" class="btn-close p-2" data-bs-dismiss="modal"
                                                aria-label="Close" style="background-color: white"></button>
                                        </div>
                                        <div class="modal-body mb-2">
                                            <form method="POST" action="{{ route('add_chart') }}">
                                                @csrf
                                                <small>Si utilizará números decimales, solo se permiten con dos
                                                    números después del punto. <strong>Ej: 90.20</strong></small>
                                                <div class="form-group">
                                                    <label for="fecha" class="form-label fs-6 fw-semibold">Fecha:</label>
                                                    <input type="date" class="form-control fs-6" id="fecha"
                                                        name="fecha" placeholder="Ingresa un nombre" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label fs-6 fw-semibold">Ingrese el
                                                        rendimiento:</label>
                                                    @for ($i = 0; $i < count($empleados); $i++)
                                                        <div class="input-group col-12">
                                                            <span
                                                                class="input-group-text col-8">{{ $empleados[$i]->nombre }}</span>
                                                            <input type="number" class="form-control" placeholder="Número"
                                                                name="empleados[{{ $i }}][ID]"
                                                                value="{{ $empleados[$i]->id }}" hidden>
                                                            <input type="number" class="form-control"
                                                                placeholder="Número"
                                                                name="empleados[{{ $i }}][rendimiento]">
                                                        </div>
                                                    @endfor

                                                </div>

                                                <div class="col-12 d-flex justify-content-center">
                                                    <button type="submit"
                                                        class="btn btn-primary col-6 text-center">Registrar</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nombre</th>
                            <th class="text-center">Rendimiento</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($empleadosFiltrado as $empleado)
                            <tr>
                                <td class="text-center">{{ $empleado->empleado_id }}</td>
                                <td>{{ $empleado->nombre }}</td>
                                <td class="text-center">{{ $empleado->rendimiento }}</td>
                                <td>
                                    <form action="{{ route('delete_employee', ['id' => $empleado->empleado_id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm btn-icon">
                                            <i class="tim-icons icon-simple-remove"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <div>
                    <canvas id="charts-reportes" style="display: block; width: 100%; max-height:600px;"></canvas>
                </div>
            </div>
            {{-- @endif --}}
        </div>
    </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const chartData = JSON.parse(`<?php echo $dataJson; ?>`)

            let ctx = document.getElementById('charts-reportes').getContext('2d');

            let myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.label,
                    datasets: [{
                        label: 'Rendimiento',
                        data: chartData.data,
                        backgroundColor: [
                            '#e1bee7',
                            '#ce93d8',
                            '#ba68c8',
                            '#ab47bd',
                            '#9c27b0',
                            '#8e24ee',
                            '#c5cae9',
                            '#9fa8da',
                            '#7986cb',
                            '#5c6bc0',
                            '#3f51b5',
                            '#3949ab'
                        ],
                        borderWidth: 1
                    }]

                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        })
    </script>
@endpush
