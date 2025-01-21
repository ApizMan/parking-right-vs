<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h1 class="pt-4">Historical Event</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
        <a class="btn btn-warning px-3 py-2" href="{{ route('auth.historical_event.create_event') }}"
            role="button">Create
            New
            Event</a>
    </div>
    {{-- <div class="row">
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
        {{--
    </div> --}}
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
                                <th>Date</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Department Involve</th>
                                <th>Staff Involve</th>
                                <th>Area</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($datas) > 0)
                            @foreach ($datas as $data)
                            <tr>
                                <td>{{ $data->event_date }}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->description }}</td>
                                <td>{{ $data->department_involve }}</td>
                                <td>{{ $data->staff_involve }}</td>
                                <td>{{ $data->zone_area }}</td>
                                <td>
                                    <div class="d-flex mx-3 " style="gap: 10px;">
                                        <a class="btn btn-primary" {{--
                                            href="{{ route('parking.parking_edit', $data['id']) }}" --}}
                                            role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                                        {{-- <form action="{{ route('parking.parking_delete', $data['id']) }}"
                                            method="POST" style="display: inline;" onsubmit="return confirmDelete();">
                                            @csrf
                                            @method('DELETE') --}}
                                            <button type="submit" class="btn btn-danger" role="button">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            {{--
                                        </form> --}}

                                        <script>
                                            function confirmDelete() {
                                                return confirm("Are you sure you want to delete this item?");
                                            }
                                        </script>
                                    </div>
                                </td>
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
