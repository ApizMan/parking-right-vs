<div class="container-fluid px-4">
    <h1 class="pt-4">Parking Right</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4" style="background-color: rgb(24, 147, 248)">
                <div class="card-body">
                    <h4>Total Parking</h4>
                    <h1 class="px-3 pb-3 pt-3" style="float: right">{{ $parkingCount }}</h1>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="card text-white mb-4" style="background-color: rgb(115, 188, 249)">
                <div class="card-body">
                    <h4>Total Parking Today</h4>
                    <h1 class="px-3 pb-3 pt-3" style="float: right">{{ $parkingCountToday }}</h1>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="card text-white mb-4" style="background-color: rgb(117, 249, 115)">
                <div class="card-body">
                    <h4>Total Using App</h4>
                    <h1 class="px-3 pb-3 pt-3" style="float: right">{{ $appCount }}</h1>
                </div>
            </div>
        </div>

        {{-- <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Danger Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div> --}}
    </div>
    {{-- <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Area Chart Example
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Bar Chart Example
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div> --}}
    <!-- =======  Data-Table  = Start  ========================== -->
    {{-- <div class="container"> --}}
        <div class="row pb-4">
            <div class="col-12">
                <div class="data_table table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Plate</th>
                                <th>Start Date</th>
                                <th>Start Time</th>
                                <th>End Date</th>
                                <th>End Time</th>
                                <th>Paid (RM)</th>
                                <th>Creation Date</th>
                                <th>Creation Time</th>
                                <th>Zone</th>
                                <th>Terminal</th>
                                <th>Transaction No</th>
                                <th>Server Call Date</th>
                                <th>Server Call Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($datas) > 0)
                            @foreach ($datas as $data)
                            <tr>
                                <td>{{ $data->plate_number }}</td>
                                <td>{{ $data->start_date }}</td>
                                <td>{{ $data->start_time }}</td>
                                <td>{{ $data->end_date }}</td>
                                <td>{{ $data->end_time }}</td>
                                <td>{{ number_format($data->paid_amount, 2) }}</td>
                                <td>{{ $data->creation_date }}</td>
                                <td>{{ $data->creation_time }}</td>
                                <td>{{ $data->zone }}</td>
                                <td>{{ $data->terminal }}</td>
                                <td>{{ $data->transaction_no }}</td>
                                <td>{{ $data->getServerDateAttribute() }}</td>
                                <td>{{ $data->getServerTimeAttribute() }}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="13" style="text-align: center;">Data Not Found</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{--
    </div> --}}
    <!-- =======  Data-Table  = End  ===================== -->
</div>