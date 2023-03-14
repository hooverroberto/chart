@extends('layouts.app', ['pageSlug' => 'charts'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Reporte del día 13.03.2023</h5>
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
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="charts-reportes" style="display: block; width: 100%; max-height:550px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
            const cData = JSON.parse(`<?php echo $data; ?>`)

            const ctx = document.getElementById('charts-reportes').getContext('2d');

            const myChart = new Chart(ctx, {
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
    </script>
@endpush
