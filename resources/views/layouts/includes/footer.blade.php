<footer class='main-footer sticky footer-type-1'>
    <div class='footer-inner'>
        <div class='footer-text'>
            © 2017 <strong>Energy Buyers Network</strong>
        </div>
        <div class='go-up'>
            <a class='fa-angle-up' href='#' rel='go-top' style='font-style: italic'></a>
        </div>
    </div>
</footer>

</div>

<div class="fixed" id="chat">
    <div class="chat-inner ps-container" style="max-height: 1087px;">
        <h2 class="chat-header"><a class="chat-close" id="closChat_button"><i
                        class="fa-plus-circle rotate-45deg"></i></a> Notifications <span
                    class="badge badge-success is-hidden">0</span></h2>

        <div class="chat-group">
            @if (session()->has('flash_notification.message'))
                <div class="alert alert-{{ session('flash_notification.level') }}">
                    {!! session('flash_notification.message') !!}
                </div>
            @endif
        </div>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
            <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; right: 2px;">
            <div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div>
        </div>
    </div>
</div>

</div>

<script src='{{url("js/app.js")}}'></script>
<script src='{{url("js/ajax.js")}}'></script>
<script src="//cdn.ckeditor.com/4.7.1/basic/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src='{{url("js/datetime_picker.js")}}'></script>
<script src='{{url("js/nouislider.js")}}'></script>
<script src='{{url("js/pace.js")}}'></script>
<script src='{{url("js/jquery.sticky.js")}}'></script>
<script>
    CKEDITOR.replace('supplier_and_product_info');
    CKEDITOR.replace('customer_service_and_billing');
    CKEDITOR.replace('renewal_cycle');
    CKEDITOR.replace('credit_and_restrictions');

    var snapSlider1 = document.getElementById('ced-end');
    var snapSlider2 = document.getElementById('ced-begin');

    noUiSlider.create(snapSlider1, {
        start: [4],
        step: 1,
        connect: [false, true],
        range: {
            'min': [1],
            'max': [12]
        },
        pips: {
            mode: 'values',
            values: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
            density: 3
        },
        tooltips: true,
    });

    snapSlider1.noUiSlider.on('change', function (values, handle) {
        if (values[handle] > 4) {
            snapSlider1.noUiSlider.set(5);
        }
    });

    noUiSlider.create(snapSlider2, {
        start: [8],
        step: 1,
        connect: [true, false],
        range: {
            'min': [12],
            'max': [24]
        },
        pips: {
            mode: 'values',
            values: [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
            density: 3
        },
        tooltips: true,
    });

</script>

<script type="text/javascript">
    $(function () {
        @if(isset($beginDate))
        if (document.getElementById("callbackBeginDate")) {
            $('#callbackBeginDate').datetimepicker({
                format: 'DD/MM/YYYY',
                defaultDate: new Date("{!!Carbon\Carbon::createFromFormat('Y-m-d', $beginDate)!!}")
            });

            $('#callbackBeginDate').on("dp.change", function (e) {
                window.location.href = '?beginDate=' + $('#callbackBeginDate').val() + '&endDate=' + $('#callbackEndDate').val();
            });
        }
        @endif
                @if(isset($beginDate))
        if (document.getElementById("callbackEndDate")) {
            $('#callbackEndDate').datetimepicker({
                format: 'DD/MM/YYYY',
                defaultDate: new Date("{!! Carbon\Carbon::createFromFormat('Y-m-d', $endDate) !!}")
            });

            $('#callbackEndDate').on("dp.change", function (e) {
                console.log($('#callbackEndDate').val());
                window.location.href = '?beginDate=' + $('#callbackBeginDate').val() + '&endDate=' + $('#callbackEndDate').val();
            });
        }
        @endif

        if (document.getElementById("verbalCED")) {
            $('#verbalCED').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        }

        if (document.getElementById("loaSent")) {
            $('#loaSent').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        }
    });
</script>
</body>
</html>
