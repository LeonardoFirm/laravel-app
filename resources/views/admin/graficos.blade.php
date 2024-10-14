@section('content')
    <div class="col-lg 6 col-md-6 col-12">
        <div id="piechart" class="graficos" style="width: 100%; height: 400px;"></div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Status', 'Valor'],
                    ['Não Iniciadas', {{ $valorPorServico['nao_iniciadas'] }}],
                    ['Em Execução', {{ $valorPorServico['iniciadas'] }}],
                    ['Avisar Cliente', {{ $valorPorServico['avisar'] }}],
                    ['Finalizadas', {{ $valorPorServico['finalizadas'] }}]
                ]);

                var options = {
                    title: 'Percentual dos Serviços por Status',
                    pieHole: 0.4,
                    backgroundColor: 'transparent',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>
    </div>

    <div class="col-lg-6 col-md-6 col-12">
        <div id="columnchart_values" class="graficos" style="width: 100%; height: 400px;"></div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Status', 'Valor'],
                    ['Não Iniciadas', {{ $valorPorServico['nao_iniciadas'] }}],
                    ['Em Execução', {{ $valorPorServico['iniciadas'] }}],
                    ['Avisar Cliente', {{ $valorPorServico['avisar'] }}],
                    ['Finalizadas', {{ $valorPorServico['finalizadas'] }}]
                ]);

                var options = {
                    title: 'Valores dos Serviços por Status',
                    backgroundColor: "transparent",
                    bar: {
                        groupWidth: "70%"
                    },
                    annotations: {
                        textStyle: {
                            fontSize: 12,
                            color: '#fff',
                        },
                        alwaysOutside: true
                    },
                    hAxis: {
                        title: 'Valores',
                        minValue: 0
                    },
                    vAxis: {
                        title: 'Status'
                    },
                };

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1, {
                    calc: function(dt, row) {
                        return 'R$ ' + dt.getValue(row, 1).toFixed(2).replace('.', ',');
                    },
                    type: 'string',
                    role: 'annotation'
                }]);

                var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_values'));
                chart.draw(view, options);
            }
        </script>
    </div>

    <div class="col-12">
        <div id="calendar_basic" style="width: 100%; height: auto"></div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {
                packages: ["calendar"]
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn({
                    type: 'date',
                    id: 'Date'
                });
                dataTable.addColumn({
                    type: 'number',
                    id: 'Valor'
                });

                var groupedData = {};

                @foreach ($clientesRecemCadastrados as $cliente)
                    var dateKey = new Date({{ $cliente->created_at->year }}, {{ $cliente->created_at->month - 1 }},
                        {{ $cliente->created_at->day }}).toISOString().split('T')[0];
                    groupedData[dateKey] = (groupedData[dateKey] || 0) + 1;
                @endforeach

                for (var date in groupedData) {
                    var parts = date.split('-');
                    dataTable.addRow([new Date(parts[0], parts[1] - 1, parts[2]), groupedData[date]]);
                }

                var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

                var options = {
                    title: "Fluxo Diário de Cadastro de Clientes",
                    //height: auto,
                    backgroundColor: 'transparent',
                    calendar: {
                        cellColor: {
                            stroke: '#ccc',
                            strokeOpacity: 0.5,
                            background: {
                                0: {
                                    'color': '#e7f7d1'
                                },
                                1: {
                                    'color': '#a4d65e'
                                },
                                2: {
                                    'color': '#ffcc00'
                                },
                                3: {
                                    'color': '#ff9900'
                                },
                                4: {
                                    'color': '#ff3300'
                                },
                            }
                        }
                    }
                };

                chart.draw(dataTable, options);
            }
        </script>
    </div>
@endsection
