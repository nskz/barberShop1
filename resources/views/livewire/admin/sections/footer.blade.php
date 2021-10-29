<div>
    <footer class="main-footer">
        <strong>Copyright &copy; 2021-2031 <a href="https://rayax.ir">Rayax.ir</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            {{--                <b>Version</b> 3.1.0--}}
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @livewireScripts
    @stack('scripts')

    {{--    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>--}}

    <script>
        //for useGroup
        window.livewire.on('showDeleteAlert',function (id) {
            swal({
                title:'Are You Sure ?',
                text: 'Selected row will be deleted!',
                icon: 'warning',
                type:'warning',
                buttons: ["NO", "YES!"],
            }).then(function(value) {
                if (value) {
                    window.livewire.emit('deleteGroup',id);
                }
            });
        })
        //for users
        window.livewire.on('showDeleteUserAlert',function (id) {
            swal({
                title:'Are You Sure ?',
                text: 'Selected row will be deleted!',
                icon: 'warning',
                type:'warning',
                buttons: ["NO", "YES!"],
            }).then(function(value) {
                if (value) {
                    window.livewire.emit('deleteUser',id);
                }
            });
        })
        //for texts
        window.livewire.on('showDeleteTextAlert',function (id) {
            swal({
                title:'Are You Sure ?',
                text: 'Selected row will be deleted!',
                icon: 'warning',
                type:'warning',
                buttons: ["NO", "YES!"],
            }).then(function(value) {
                if (value) {
                    window.livewire.emit('deleteText',id);
                }
            });
        })
        //for slider
        window.livewire.on('showDeleteSliderAlert',function (id) {
            swal({
                title:'Are You Sure ?',
                text: 'Selected row will be deleted!',
                icon: 'warning',
                type:'warning',
                buttons: ["NO", "YES!"],
            }).then(function(value) {
                if (value) {
                    window.livewire.emit('deleteSlider',id);
                }
            });
        })
        //for status
        window.livewire.on('showDeleteStatusAlert',function (id) {
            swal({
                title:'Are You Sure ?',
                text: 'Selected row will be deleted!',
                icon: 'warning',
                type:'warning',
                buttons: ["NO", "YES!"],
            }).then(function(value) {
                if (value) {
                    window.livewire.emit('deleteStatus',id);
                }
            });
        })
        //for barber
        window.livewire.on('showDeleteBarberAlert',function (id) {
            swal({
                title:'Are You Sure ?',
                text: 'Selected row will be deleted!',
                icon: 'warning',
                type:'warning',
                buttons: ["NO", "YES!"],
            }).then(function(value) {
                if (value) {
                    window.livewire.emit('deleteBarber',id);
                }
            });
        })
        //for contactUs
        window.livewire.on('showDeleteContactAlert',function (id) {
            swal({
                title:'Are You Sure ?',
                text: 'Selected row will be deleted!',
                icon: 'warning',
                type:'warning',
                buttons: ["NO", "YES!"],
            }).then(function(value) {
                if (value) {
                    window.livewire.emit('deleteContact',id);
                }
            });
        })
        //for ReturnPrepayment
        window.livewire.on('showReturnPrepaymentAlert',function (id) {
            swal({
                title:'Are You Sure ?',
                text: 'Prepayment will be returned!',
                icon: 'warning',
                type:'warning',
                buttons: ["NO", "YES!"],
            }).then(function(value) {
                if (value) {
                    window.livewire.emit('returnPrepayment',id);
                }
            });
        })

        window.livewire.on('showSuccessAlert',function (message) {
            swal({
                position:'top-text',
                title: "SUCCESSFUL!",
                text: message,
                icon: "success",
                showConfirmButton: false,
                timer:3000
            });
        })

        //for update reservation status
        window.livewire.on('showSuccessChangeStatusAlert',function (message) {
            swal({
                position:'top-text',
                title: "SUCCESSFUL!",
                text: message,
                icon: "success",
                showConfirmButton: false,
                timer:3000
            });
        })

    </script>

</div>
