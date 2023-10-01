@extends('layouts.app')
@section('main-content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                            <div class="row">
                                <div class="col-lg-8 d-flex flex-column">
                                    <div class="row flex-grow">
                                        <div class="col-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="d-sm-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h4 class="card-title card-title-dash">Turbidity Statistic</h4>
                                                            <p class="card-subtitle card-subtitle-dash">Statistic data
                                                                turbidity kolam dalam hari ini</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                        <div
                                                            class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                            <h2 class="me-2 fw-bold">{{ $turbidity->data }}</h2>
                                                            <h4 class="me-2">( {{$turbiditystatus}} )</h4>
                                                        </div>
                                                        {{-- <div class="me-3"><div id="marketing-overview-legend"></div></div> --}}
                                                    </div>
                                                    <div class="chartjs-bar-wrapper mt-3">
                                                        <canvas id="marketingOverview"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex-grow">
                                        <div class="col-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="d-sm-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h4 class="card-title card-title-dash">Turbidity Treshold</h4>
                                                            <p class="card-subtitle card-subtitle-dash">Kestabilan kekeruhan Air</p>
                                                            <h3 class="fw-xl mb-5">{{ $tturbidity->ttreshold }}</h3>
                                                            <button type="button" class="btn btn-primary btn-lg" style="color:white;">Set Kekeruhan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 d-flex flex-column">
                                    <div class="row flex-grow">
                                        <div class="col-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <h4 class="card-title card-title-dash">Daftar Waktu</h4>
                                                                <div class="add-items d-flex mb-0">
                                                                    <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                                                                    <a class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"
                                                                        href="/dashboard/timer-setting"><i
                                                                            class="mdi mdi-plus"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="list align-items-center border-bottom py-2">
                                                                @forelse ($timer as $time)
                                                                    <div class="wrapper w-100">
                                                                        <p class="mb-2 font-weight-medium">
                                                                            {{ $time->name }}
                                                                        </p>
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center">
                                                                            <div class="d-flex align-items-center">
                                                                                <i
                                                                                    class="mdi mdi-alarm text-muted me-1 mt-1"></i>
                                                                                <p class="mb-0 text-small text-muted">
                                                                                    {{ $time->time }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="wrapper w-100">
                                                                        <p class="mb-2 font-weight-medium">
                                                                            Timer Kosong :(
                                                                        </p>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex-grow">
                                        <div class="col-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-3">
                                                                <h4 class="card-title card-title-dash">Rata rata kekeruhan</h4>
                                                            </div>
                                                            <canvas class="my-auto" id="doughnutChart"
                                                                height="200"></canvas>
                                                            <div id="doughnut-chart-legend" class="mt-5 text-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                    href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
                BootstrapDash.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights
                reserved.</span>
        </div>
    </footer>
    <!-- partial -->
@endsection
@section('script-inject')
    <script>
        $("#setTurbidityButton").click(function() {
            // Data yang akan dikirim dalam permintaan POST
            var dataToSend = {
                setTurbidity: true
            };

            // Mengirim permintaan POST menggunakan jQuery
            $.post('/dashboard/set-turbidity', dataToSend, function(response) {
                // Tindakan yang akan dilakukan setelah permintaan POST berhasil
                console.log('Permintaan POST berhasil!');
            }).fail(function() {
                // Tindakan yang akan dilakukan jika permintaan POST gagal
                console.log('Permintaan POST gagal.');
            });
        });
    </script>
@endsection
