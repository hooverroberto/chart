@extends('layouts.app', ['pageSlug' => 'charts'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Reporte del día 13.03.2023</h5>
                            <h2 class="card-title">Rendimiento de los empleados</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                            <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                <input type="radio" name="options" checked>
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Accounts</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-single-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="1">
                                <input type="radio" class="d-none d-sm-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-gift-2"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="2">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-tap-02"></i>
                                </span>
                            </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div >
                        <canvas id="charts-reportes" style="display: block; width: 100%; height:600px;" ></canvas>
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

            const myChart = new Chart(ctx,{
                type:'bar',
                data: {
                    labels:cData.label,
                    datasets:[{
                        label:'Rendimineto de los empleados',
                        data:cData.data,
                        backgroundColor:[
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
                        borderWidth:1
                    }]                    
                    
                },
                options:{
                    scales:{
                        yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

        });
    </script>
@endpush