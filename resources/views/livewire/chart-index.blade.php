<div class="row">
    <?php
    // var_dump($data)
    ?>
    <div class="col-12">
        <div class="card card-chart">
            <div class="card-header ">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="col-12">
                    <label for="fecha" class="form-label">Selecciona una fecha:</label>
                    <select name="fecha" id="fecha" class="form-select mb-3" wire:model="search">
                        <option value="#" selected>Selecciona una fecha:</option>
                        @foreach ($fechas as $fecha)
                            <option value={{ $fecha->id }}>{{ $fecha->fecha }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- @if (isset($search) && $search !== 'qweqwe') --}}
            <div class="card-body">
                <div class="d-flex">
                    <div class="col-sm-6 text-left">
                        {{-- <h5 class="h5">Reporte del día {{ $empleadosFiltrado[0]->fecha }}</h5> --}}
                        <h2 class="card-title">Rendimiento de los empleados</h2>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <!-- Button modal -->
                        <div>
                            <button type="button" class="btn btn-primary d-flex align-items-start gap-1"
                                data-bs-toggle="modal" data-bs-target="#form-add">
                                </span><i class="tim-icons icon-simple-add"></i><span>Agregar empleado
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="form-add" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="background-color: #27293d">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close p-2" data-bs-dismiss="modal"
                                            aria-label="Close" style="background-color: white"></button>
                                    </div>
                                    <div class="modal-body pt-0 mt-5">
                                        <form method="POST" action="{{ route('add_value') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name" class="form-label fs-6 fw-semibold">Nombre del
                                                    empleado:</label>
                                                <input type="text" class="form-control fs-6" id="name"
                                                    name="name" placeholder="Ingresa un nombre" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="performance" class="form-label fs-6 fw-semibold">Rendimiento
                                                    del empleado:</label>
                                                <input type="number" class="form-control fs-6" id="performance"
                                                    name="performance" placeholder="Ingresa el rendimiento" required>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Agregar</button>
                                        </form>
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
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon">
                                        <i class="tim-icons icon-single-02"></i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                        <i class="tim-icons icon-settings"></i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                                        <i class="tim-icons icon-simple-remove"></i>
                                    </button>
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
    @push('js')
        <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
        {{-- <script>
            $(document).ready(function() {
                let cData = JSON.parse(`<?php echo $data['data']; ?>`)
                console.log(cData);

                let ctx = document.getElementById('charts-reportes').getContext('2d');

                let myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: cData.label,
                        datasets: [{
                            label: 'Rendimiento',
                            data: cData.data,
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

            });
        </script> --}}
        <script>
            window.addEventListener("change", () => {
                let cData = JSON.parse(`<?php echo $data['data']; ?>`)
                console.log(cData);
                // let labels = ``

                let ctx = document.getElementById('charts-reportes').getContext('2d');

                let myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: cData.label,
                        datasets: [{
                            label: 'Rendimiento',
                            data: cData.data,
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
</div>
