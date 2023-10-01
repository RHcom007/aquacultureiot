@extends('layouts.app')
@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js">
    </script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>
@endsection
@section('main-content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah TImer</h4>
                        <p class="card-description">
                            Basic form layout
                        </p>
                        <form class="forms-sample" method="post" action="/dashboard/timer-setting">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Timer</label>
                                <input type="text" class="form-control" id="nama" name="name">
                            </div>
                            <div class="form-group">
                                <label for="time">Waktu</label>
                                <input type="time" class="form-control timepicker" id="time" name="timer">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
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
            <script type="text/javascript">
                var defaults = {
                    calendarWeeks: true,
                    showClear: true,
                    showClose: true,
                    allowInputToggle: true,
                    useCurrent: false,
                    ignoreReadonly: true,
                    minDate: new Date(),
                    toolbarPlacement: 'top',
                    icons: {
                        time: 'fa fa-clock-o',
                        date: 'fa fa-calendar',
                        up: 'fa fa-angle-up',
                        down: 'fa fa-angle-down',
                        previous: 'fa fa-angle-left',
                        next: 'fa fa-angle-right',
                        today: 'fa fa-dot-circle-o',
                        clear: 'fa fa-trash',
                        close: 'fa fa-times'
                    }
                };

                var optionsTime = $.extend({}, defaults, {
                    format: 'HH:mm'
                });
                $(document).ready(function(){
                    var optionsTime = $.extend({}, defaults, {
                        format: 'HH:mm'
                    });
                    $('.timepicker').datetimepicker(optionsTime);
                });
            </script>
        @endsection
